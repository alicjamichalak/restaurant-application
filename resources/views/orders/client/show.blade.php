@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="pull-left">
                    <h6 class="m-0 font-weight-bold text-primary">Receipt</h6>
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
                <div class="table-responsive">
                    <table class="table table-bordered" id="datareceipt" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Dish name</th>
                            <th>Price</th>
                            <th>Delivered ?</th>
                            <th>Ordered date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->menu_name }}</td>
                                <td>{{ $order->menu_price }}&nbsp;zł</td>
                                @if($order->order_delivered == 0)
                                    <td>no</td>
                                @elseif($order->order_delivered == 1)
                                    <td>yes</td>
                                @endif
                                <td>{{ $order->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
