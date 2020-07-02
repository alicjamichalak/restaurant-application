@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="pull-left">
                    <h6 class="m-0 font-weight-bold text-primary">Orders Management</h6>
                </div>
                <div class="pull-right">
                    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('admin.order.create') }}"><i class="fas fa-plus fa-sm text-white-50"></i>Add New Order</a>
                </div>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))

                    <div class="alert alert-success">

                        <p>{{ $message }}</p>

                    </div>

                @endif
                <div class="order-responsive">
                    <table class="table table-bordered" id="dataorder" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Dish name</th>
                            <th>Food type</th>
                            <th>Delivery time</th>
                            <th>Starting preparation time</th>
                            <th>Table number</th>
                            <th>Delivered</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->menu_name }}</td>
                                <td>{{ $order->food_type_name }}</td>
                                <td>{{ $order->preparation_time }}</td>
                                <td>{{ $order->delayed_time }}</td>
                                <td>{{ $order->table_name }}</td>
                                @if($order->order_delivered == 0)
                                    <td>no</td>
                                @elseif($order->order_delivered == 1)
                                    <td>yes</td>
                                @endif
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.order.edit', $order->order_id) }}"><i class="fas fa-pen"></i> Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {!! $orders->render() !!}
    </div>
@endsection
