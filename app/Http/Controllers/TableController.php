<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class TableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminIndex(Request $request)
    {
        $tables = DB::table('tables')->orderBy('table_id', 'DESC')->paginate(5);
        return view('tables.admin.index', compact('tables'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function adminCreate()
    {
        return view('tables.admin.create');
    }

    public function adminStore()
    {
        Table::create($this->validateRequest());
        return redirect(route('admin.table.index'));
    }

    private function validateRequest(): array
    {
        return request()->validate([
            'table_name' => ['required', 'sometimes', 'unique:tables,table_name,' . request()->id . ',table_id'],
        ]);
    }

    public function adminEdit(int $tableId)
    {
        $table = Table::where('table_id', '=', $tableId)->firstOrFail();
        return view('tables.admin.edit', compact('table'));
    }

    public function adminUpdate(Request $request, int $tableId)
    {
        $table = Table::where('table_id', '=', $tableId)->firstOrFail();
        $table->update($this->validateRequest());
        return redirect(route('admin.table.index'));
    }

    public function clientIndex()
    {
        $tables = DB::table('tables')
                    ->join('receipts', function ($join)
                    {
                        $join->on('tables.table_id', '=', 'receipts.receipt_table_id')->where('receipt_closed', '=', 0);
                    }, 'null', 'null', 'left outer')
                    ->where('receipt_closed', '=', '1')
                    ->orWhereNull('receipt_closed')
                    ->orderBy('table_id', 'DESC')
                    ->paginate(5);
        Cookie::queue(Cookie::make('tableId', null, 1440));
        return view('tables.client.index', compact('tables'));
    }

    public function clientShow(int $tableId)
    {
        $table = Table::where('table_id', '=', $tableId)->firstOrFail();
        Cookie::queue(Cookie::make('tableId', $tableId, 1440));
        return view('tables.client.show', compact('table'));

    }
}
