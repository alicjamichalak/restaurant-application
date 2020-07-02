@extends('layouts.app')

@section('content')



    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="pull-left">
                    <h6 class="m-0 font-weight-bold text-primary"> Menu Management </h6>
                </div>
                <div class="pull-right">
                    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('admin.menu.create') }}"><i class="fas fa-plus fa-sm text-white-50"></i>Add New Dish</a>
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
                            <th>Price</th>
                            <th>Preparation time</th>
                            <th>Food type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($dishes as $dish)
                            <tr>
                                <td>{{ $dish->menu_name }}</td>
                                <td>{{ $dish->menu_price }}</td>
                                <td>{{ $dish->menu_preparation_time }}</td>
                                <td>{{ $dish->food_type_name }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.menu.edit',$dish->menu_id) }}"><i class="fas fa-pen"></i> Edit</a>
                                @if($dish->menu_active == true)
                                    {!! Form::open(['method' => 'PATCH','route' => ['admin.menu.deactivate', $dish->menu_id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Deactivate', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                @else
                                    {!! Form::open(['method' => 'PATCH','route' => ['admin.menu.activate', $dish->menu_id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Activate', ['class' => 'btn btn-success']) !!}
                                    {!! Form::close() !!}
                                @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {!! $dishes->render() !!}
    </div>
@endsection
