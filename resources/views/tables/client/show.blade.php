@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="pull-left">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $table->table_name }}</h6>
                </div>

                <div class="pull-right">
                    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('client.table.index') }}"><i class="fas fa-arrow-left"></i>Back</a>
                </div>
            </div>
            <div class="card-body">
                <div>Add credit card to start a tab</div>
                <a class="btn btn-primary" href="{{ route('client.client.create') }}">Choose</a>
            </div>
        </div>
    </div>
@endsection
