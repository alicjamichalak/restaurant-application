@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="pull-left">
                    <h6 class="m-0 font-weight-bold text-primary">Clients Management</h6>
                </div>
                <div class="pull-right">
                    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('admin.client.create') }}"><i class="fas fa-plus fa-sm text-white-50"></i> Add New Client</a>
                </div>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))

                    <div class="alert alert-success">

                        <p>{{ $message }}</p>

                    </div>

                @endif
                <div class="client-responsive">
                    <table class="table table-bordered" id="dataclient" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Card number</th>
                            <th>Card expiry date</th>
                            <th>CCV</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->client_name }}</td>
                                <td>{{ $client->client_card_number }}</td>
                                <td>{{ $client->client_card_expiry_date }}</td>
                                <td>{{ $client->client_card_ccv_code }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.client.edit', $client->client_id) }}"><i class="fas fa-pen"></i> Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {!! $clients->render() !!}
    </div>
@endsection
