<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Menu;
use App\Order;
use App\Receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminIndex(Request $request)
    {
        $orders = DB::table('orders')
                    ->join('receipts', 'orders.order_receipt_id', '=', 'receipts.receipt_id')
                    ->join('menus', 'orders.order_menu_id', '=', 'menus.menu_id')
                    ->leftJoin('employees', 'orders.order_employee_id', '=', 'employees.employee_id')
                    ->join('tables', 'receipts.receipt_table_id', '=', 'tables.table_id')
                    ->join('clients', 'receipts.receipt_client_id', '=', 'clients.client_id')
                    ->join('food_types', 'menus.menu_food_type_id', '=', 'food_types.food_type_id')
                    ->select([
                        'clients.client_name',
                        'tables.table_name',
                        'employees.employee_name',
                        'employees.employee_surname',
                        'receipts.receipt_closed',
                        'orders.order_delayed_time',
                        'orders.order_delivered',
                        'food_types.food_type_name',
                        'menus.menu_name',
                        'menus.menu_preparation_time',
                        'menus.menu_price',
                        'orders.created_at',
                        'orders.order_id',
                    ])
                    ->orderBy('order_id', 'DESC')
                    ->paginate(5);

        foreach ($orders as $order) {
            $createdAt = Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at);
            $delayedTimeInSeconds = strtotime($order->order_delayed_time) - strtotime('TODAY');
            $preparationTimeInSeconds = strtotime($order->menu_preparation_time) - strtotime('TODAY') ;
            $order->delayed_time = $createdAt->addSeconds($delayedTimeInSeconds)->toTimeString();
            $order->preparation_time = $createdAt->addSeconds($preparationTimeInSeconds)->toTimeString();
        }

        return view('orders.admin.index', compact('orders'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function adminCreate()
    {
        $receipts = Receipt::all()->pluck('receipt_id', 'receipt_id');
        $menus = Menu::all()->pluck('menu_name', 'menu_id');
        $employees = Employee::all()->pluck('employee_name', 'employee_id');
        return view('orders.admin.create', compact('receipts', 'menus', 'employees'));
    }

    public function adminStore()
    {
        Order::create($this->validateRequest());
        return redirect(route('admin.order.index'));
    }

    private function validateRequest(): array
    {
        return request()->validate([
            'order_receipt_id'  => ['required', 'sometimes','numeric', 'exists:receipts,receipt_id'],
            'order_menu_id'     => ['required', 'sometimes','numeric', 'exists:menus,menu_id'],
            'order_employee_id' => ['required', 'sometimes','numeric', 'exists:employees,employee_id'],
            'order_delayed_time' => ['required', 'sometimes', 'date_format:i:s'],
        ]);
    }

    public function adminEdit(int $orderId)
    {
        $order = Receipt::where('order_id', '=', $orderId)->firstOrFail();
        $receipts = Receipt::all()->pluck('receipt_id', 'receipt_id');
        $menus = Menu::all()->pluck('menu_name', 'menu_id');
        $employees = Employee::all()->pluck('employee_name', 'employee_id');
        return view('orders.admin.edit', compact('order', 'receipts', 'menus', 'employees'));
    }

    public function adminUpdate(Request $request, int $orderId)
    {
        $order = Receipt::where('order_id', '=', $orderId)->firstOrFail();
        $order->update($this->validateRequest());
        return redirect(route('admin.order.index'));
    }

    public function employeeIndex(Request $request)
    {
        $orders = DB::table('orders')
                    ->join('receipts', 'orders.order_receipt_id', '=', 'receipts.receipt_id')
                    ->join('menus', 'orders.order_menu_id', '=', 'menus.menu_id')
                    ->leftJoin('employees', 'orders.order_employee_id', '=', 'employees.employee_id')
                    ->join('tables', 'receipts.receipt_table_id', '=', 'tables.table_id')
                    ->join('clients', 'receipts.receipt_client_id', '=', 'clients.client_id')
                    ->join('food_types', 'menus.menu_food_type_id', '=', 'food_types.food_type_id')
                    ->select([
                        'clients.client_name',
                        'tables.table_name',
                        'employees.employee_name',
                        'employees.employee_surname',
                        'receipts.receipt_closed',
                        'orders.order_delayed_time',
                        'orders.order_delivered',
                        'food_types.food_type_name',
                        'menus.menu_name',
                        'menus.menu_preparation_time',
                        'menus.menu_price',
                        'orders.created_at',
                        'orders.order_id',
                    ])
                    ->where('order_delivered', '=', '0')
                    ->orderBy('order_id', 'DESC')
                    ->paginate(5);

        foreach ($orders as $order) {
            $createdAt = Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at);
            $delayedTimeInSeconds = strtotime($order->order_delayed_time) - strtotime('TODAY');
            $preparationTimeInSeconds = strtotime($order->menu_preparation_time) - strtotime('TODAY');
            $order->delayed_time = $createdAt->addSeconds($delayedTimeInSeconds)->toTimeString();
            $order->preparation_time = $createdAt->addSeconds($preparationTimeInSeconds)->toTimeString();
        }

        return view('orders.employee.index', compact('orders'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function employeeSetDelivered()
    {
        $request = request()->validate([
            'orderIdValue'  => ['required', 'sometimes','numeric', 'exists:orders,order_id'],
            'employeeCode'     => ['required', 'sometimes','numeric', 'exists:employees,employee_identification_code'],
        ]);


        $order = Order::where('order_id', '=', $request['orderIdValue'])->firstOrFail();
        $employee = Employee::where('employee_identification_code', '=', $request['employeeCode'])->firstOrFail();
        $order->update([
            'order_delivered' => true,
            'order_employee_id' => $employee->employee_id,
        ]);

        return redirect(route('employee.order.index'));
    }

    public function clientShow(int $receiptId)
    {
        $receipt = Receipt::where('receipt_id', '=', $receiptId)->firstOrFail();

        $orders = DB::table('orders')
                    ->join('menus', 'orders.order_menu_id', '=', 'menus.menu_id')
                    ->select([
                        'menus.menu_name',
                        'menus.menu_price',
                        'orders.order_delivered',
                        'orders.created_at',
                    ])
                    ->where('orders.order_receipt_id', '=', $receipt->receipt_id)
                    ->get();

        return view('orders.client.show', compact( 'orders'));
    }


    public function clientStore()
    {
        request()->request->add([
            'order_receipt_id' => Cookie::get('receiptId'),
        ]);

//        dd(request());
        Order::create($this->validateRequest());
        return redirect(route('client.menu.index'));
    }

}
