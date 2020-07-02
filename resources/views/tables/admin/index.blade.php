@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="pull-left">
                    <h6 class="m-0 font-weight-bold text-primary">Tables Management</h6>
                </div>
                <div class="pull-right">
                    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('admin.table.create') }}"><i class="fas fa-plus fa-sm text-white-50"></i>Add New Table</a>
                </div>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))

                    <div class="alert alert-success">

                        <p>{{ $message }}</p>

                    </div>

                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Identyfikation</th>
                            <th>Table name</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($tables as $table)
                            <tr>
                                <td>{{ $table->table_id }}</td>
                                <td>{{ $table->table_name }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.table.edit', $table->table_id) }}"><i class="fas fa-pen"></i> Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {!! $tables->render() !!}
    </div>
@endsection
