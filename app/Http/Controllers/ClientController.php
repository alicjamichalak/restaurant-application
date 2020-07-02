<?php

namespace App\Http\Controllers;

use App\Client;
use App\Receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function adminIndex(Request $request)
    {
        $clients = DB::Table('clients')->orderBy('client_id', 'DESC')->paginate(5);
        foreach ($clients as &$client) {
            $client->client_card_number = substr($client->client_card_number, 0,4).'-xxxx-xxxx-'.substr($client->client_card_number, 12,4);
            $client->client_card_expiry_date = 'xx/xx';
            $client->client_card_ccv_code = 'xxx';
        }
        return view('clients.admin.index', compact('clients'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function adminCreate()
    {
        return view('clients.admin.create');
    }

    public function adminStore()
    {
        Client::create($this->validateRequest());
        return redirect(route('admin.client.index'));
    }

    private function validateRequest(): array
    {
        return request()->validate([
            'client_name'             => ['required', 'sometimes',],
            'client_card_number'      => ['required', 'sometimes','gt:0','digits:16',],
            'client_card_expiry_date' => ['required', 'sometimes','date_format:m/y','after:today',],
            'client_card_ccv_code'    => ['required', 'sometimes','gt:0','digits:3'],
        ]);
    }

    public function adminEdit(int $clientId)
    {
        $client = Client::where('client_id', '=', $clientId)->firstOrFail();
        return view('clients.admin.edit', compact('client'));
    }

    public function adminUpdate(Request $request, int $clientId)
    {
        $client = Client::where('client_id', '=', $clientId)->firstOrFail();
        $client->update($this->validateRequest());
        return redirect(route('admin.client.index'));
    }

    public function clientCreate()
    {
        return view('clients.client.create');
    }


    public function clientStore()
    {
        $client = Client::create($this->validateRequest());
        Cookie::queue(Cookie::make('clientId', $client->client_id, 1440));

        $receipt = Receipt::create([
            'receipt_table_id' => Cookie::get('tableId'),
            'receipt_client_id' => $client->client_id,
            'receipt_opened_date' => Carbon::now()
        ]);


        Cookie::queue(Cookie::make('receiptId', $receipt->receipt_id, 1440));
        return redirect(route('client.menu.index'));
    }
}
