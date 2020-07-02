@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="pull-left">
                    <h6 class="m-0 font-weight-bold text-primary">Opened Receipts</h6>
                </div>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))

                    <div class="alert alert-success">

                        <p>{{ $message }}</p>

                    </div>

                @endif
                <div class="receipt-responsive">
                    <table class="receipt receipt-bordered" id="datareceipt" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Table </th>
                            <th>Client name</th>
                            <th>Opened date</th>
                            <th>Close table</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($receipts as $receipt)
                            <tr>
                                <td>{{ $receipt->table_name }}</td>
                                <td>{{ $receipt->client_name }}</td>
                                <td>{{ $receipt->receipt_opened_date }}</td>
                                <td>
                                    {!! Form::open(['method' => 'PATCH','route' => ['employee.receipt.close', $receipt->receipt_id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Zamknij', ['class' => 'btn btn-success']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {!! $receipts->render() !!}
    </div>
@endsection
