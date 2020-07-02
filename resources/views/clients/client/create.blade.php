@extends('layouts.app')

@section('content')



    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="pull-left">
                    <h6 class="m-0 font-weight-bold text-primary">Add your card details- {{ \App\Table::find(Cookie::get('tableId'))->table_name }}</h6>
                </div>
                <div class="pull-right">
                    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('client.table.show', Cookie::get('tableId')) }}"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                {!! Form::open(array('route' => 'client.client.store','method'=>'POST')) !!}
                @include('clients.client.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
