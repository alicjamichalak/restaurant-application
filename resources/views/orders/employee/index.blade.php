@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="pull-left">
                    <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
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
                @if ($message = Session::get('success'))

                    <div class="alert alert-success">

                        <p>{{ $message }}</p>

                    </div>

                @endif
                <div class="order-responsive">
                    <table class="order order-bordered" id="dataorder" width="100%" cellspacing="5">
                        <thead>
                        <tr>
                            <th>Identyfikation</th>
                            <th>Dish name</th>
                            <th>Food type</th>
                            <th>Delivery time</th>
                            <th>Start preparing at</th>
                            <th>Table number</th>
                            <th>Delivered?</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->order_id }}</td>
                                <td>{{ $order->menu_name }}</td>
                                <td>{{ $order->food_type_name }}</td>
                                <td>{{ $order->preparation_time }}</td>
                                <td>{{ $order->delayed_time }}</td>
                                <td>{{ $order->table_name }}</td>
                                <td>no</td>
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#employeePinModal" onclick="$('#tableName').html('{{ $order->table_name }}');$('#orderIdValue').val({{ $order->order_id }});$('#orderId').html('{{ $order->order_id }}')">Set as Delivered</button>
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

    <!-- Modal -->
    <div class="modal fade" id="employeePinModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tableName">Delivered?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'PATCH','route' => ['employee.order.setDelivered'],'style'=>'display:inline']) !!}
                    <div>To set order number <span id="orderId"></span> write emplyee identification code.</div>
                    <div><input type="text" id="orderIdValue" name="orderIdValue" hidden></div>
                    <div><input type="number" min="0" minlength="4" maxlength="4" id="employeeCode" name="employeeCode"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-arrow-left"></i> Back</button>
                    {!! Form::submit('Set Delivered', ['class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
