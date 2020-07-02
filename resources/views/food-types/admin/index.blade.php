@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="pull-left">
                    <h6 class="m-0 font-weight-bold text-primary">Food Types Management</h6>
                </div>
                <div class="pull-right">
                    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('admin.food-type.create') }}"><i class="fas fa-plus fa-sm text-white-50"></i> Add New Food Type </a>
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
                            <th>Identyfication</th>
                            <th>Food Type</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($foodTypes as $foodType)
                            <tr>
                                <td>{{ $foodType->food_type_id }}</td>
                                <td>{{ $foodType->food_type_name }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.food-type.edit', $foodType->food_type_id) }}"><i class="fas fa-pen"></i> Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {!! $foodTypes->render() !!}
    </div>
@endsection
