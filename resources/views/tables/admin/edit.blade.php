@extends('layouts.app')

@section('content')

    <div class="row">

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="pull-left">
                    <h6 class="m-0 font-weight-bold text-primary">Table Edit</h6>
                </div>
                <div class="pull-right">
                    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('admin.table.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
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

    {!! Form::model($table, ['method' => 'PATCH','route' => ['admin.table.update', $table->table_id]]) !!}

    @include('tables.admin.form')

    {!! Form::close() !!}


@endsection
