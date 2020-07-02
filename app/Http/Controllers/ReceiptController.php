<?php

namespace App\Http\Controllers;

use App\Client;
use App\FoodType;
use App\Receipt;
use App\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ReceiptController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function adminIndex(Request $request)
    {
        $receipts = DB::table('receipts')
                    ->join('clients', 'receipts.receipt_client_id', '=', 'clients.client_id')
                    ->join('tables', 'receipts.receipt_table_id', '=', 'tables.table_id')
                    ->select([
                        'receipts.receipt_id',
                        'receipts.receipt_closed',
                        'receipts.receipt_opened_date',
                        'clients.client_name',
                        'tables.table_name',
                    ])
                    ->orderBy('receipt_id', 'DESC')
                    ->paginate(5);
        return view('receipts.admin.index', compact('receipts'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function adminCreate()
    {
        $tables = Table::all()->pluck('table_name','table_id');
        $clients = Client::all()->pluck('client_name','client_id');
        return view('receipts.admin.create', compact('tables', 'clients'));
    }

    public function adminStore()
    {
        Receipt::create($this->validateRequest());
        return redirect(route('admin.receipt.index'));
    }

    private function validateRequest(): array
    {
        return request()->validate([
            'receipt_table_id'    => ['required', 'sometimes',],
            'receipt_client_id'   => ['required', 'sometimes',],
            'receipt_opened_date' => ['required', 'sometimes',],
        ]);
    }

    public function adminEdit(int $receiptId)
    {
        $receipt = Receipt::where('receipt_id', '=', $receiptId)->firstOrFail();
        $tables = Table::all()->pluck('table_name','table_id');
        $clients = Client::all()->pluck('client_name','client_id');
        return view('receipts.admin.edit', compact('receipt', 'tables', 'clients'));
    }

    public function adminUpdate(Request $request, int $receiptId)
    {
        $receipt = Receipt::where('receipt_id', '=', $receiptId)->firstOrFail();
        $receipt->update($this->validateRequest());
        return redirect(route('admin.receipt.index'));
    }

    public function employeeIndex(Request $request)
    {
        $receipts = DB::table('receipts')
                      ->join('clients', 'receipts.receipt_client_id', '=', 'clients.client_id')
                      ->join('tables', 'receipts.receipt_table_id', '=', 'tables.table_id')
                      ->select([
                          'receipts.receipt_id',
                          'receipts.receipt_opened_date',
                          'clients.client_name',
                          'tables.table_name',
                      ])
                      ->where('receipts.receipt_closed', '=', '0')
                      ->orderBy('receipt_id', 'DESC')
                      ->paginate(5);
        return view('receipts.employee.index', compact('receipts'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function employeeCloseReceipt(int $receiptId)
    {
        $receipt = Receipt::where('receipt_id', '=', $receiptId)->firstOrFail();
        $receipt->update(['receipt_closed' => true]);

        return redirect(route('employee.receipt.index'));
    }

    public function clientShow(int $receiptId)
    {
        $receipt = Receipt::where('receipt_id', '=', $receiptId)->firstOrFail();
        $orders = DB::table('orders')
                      ->join('menus', 'orders.order_menu_id', '=', 'menus.menu_id')
                      ->select([
                          'menus.menu_name',
                          'menus.menu_price',
                      ])
                      ->where('orders.order_receipt_id', '=', $receipt->receipt_id)
                      ->where('orders.order_delivered','=', true)->get();
        $finalPrice = 0;
        foreach ($orders as $order) {
            $finalPrice += $order->menu_price;
        }

        return view('receipts.client.show', compact( 'orders', 'finalPrice', 'receipt'));
    }

    public function clientCloseReceipt(int $receiptId)
    {
        $receipt = Receipt::where('receipt_id', '=', $receiptId)->firstOrFail();

        $orders = DB::table('orders')
                    ->join('menus', 'orders.order_menu_id', '=', 'menus.menu_id')
                    ->select([
                        'menus.menu_name',
                        'menus.menu_price',
                    ])
                    ->where('orders.order_receipt_id', '=', $receipt->receipt_id)
                    ->where('orders.order_delivered','=', false)->get();

        if(sizeof($orders) > 0)
            throw ValidationException::withMessages(['Zamówienie musi być w pełni dostarczone.']);

        $receipt->update(['receipt_closed' => true]);

        Cookie::queue(Cookie::forget('tableId', 'receiptId', 'clientId'));

        return redirect(route('client.table.index'));
    }
}
