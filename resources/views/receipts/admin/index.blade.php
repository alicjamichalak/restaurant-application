@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="pull-left">
                    <h6 class="m-0 font-weight-bold text-primary">Receipts Management</h6>
                </div>
                <div class="pull-right">
                    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('admin.receipt.create') }}"><i class="fas fa-plus fa-sm text-white-50"></i> Add New Receipt</a>
                </div>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))

                    <div class="alert alert-success">

                        <p>{{ $message }}</p>

                    </div>

                @endif
                <div class="receipt-responsive">
                    <table class="table table-bordered" id="datareceipt" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Table</th>
                            <th>Client name</th>
                            <th>Closed?</th>
                            <th>Opened date</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($receipts as $receipt)
                            <tr>
                                <td>{{ $receipt->table_name }}</td>
                                <td>{{ $receipt->client_name }}</td>
                                <td>{{ $receipt->receipt_closed }}</td>
                                <td>{{ $receipt->receipt_opened_date }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.receipt.edit', $receipt->receipt_id) }}"><i class="fas fa-pen"></i> Edit</a>
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
