@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="pull-left">
                    <h6 class="m-0 font-weight-bold text-primary">Employees Management</h6>
                </div>
                <div class="pull-right">
                    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('admin.employee.create') }}"><i class="fas fa-plus fa-sm text-white-50"></i> Add New Employee </a>
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
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Birthday</th>
                            <th>Adress</th>
                            <th>Phone number</th>
                            <th>Identification code</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->employee_name }}</td>
                                <td>{{ $employee->employee_surname }}</td>
                                <td>{{ $employee->employee_birthday }}</td>
                                <td>{{ $employee->employee_address }}</td>
                                <td>{{ $employee->employee_phone_number }}</td>
                                <td>{{ $employee->employee_identification_code }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.employee.edit', $employee->employee_id) }}"><i class="fas fa-pen"></i> Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {!! $employees->render() !!}
    </div>
@endsection
