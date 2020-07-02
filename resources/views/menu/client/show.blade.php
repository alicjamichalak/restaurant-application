@extends('layouts.app')

@section('content')



    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="pull-left">
                    <h6 class="m-0 font-weight-bold text-primary">Menu</h6>
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
                @foreach($foodTypes as $foodType)
                    <a href="{{ route('client.menu.show', $foodType->food_type_id) }}">{{ $foodType->food_type_name }}</a>
                @endforeach
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Preparation time</th>
                            <th>Food Type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($dishes as $dish)
                            <tr>
                                <td>{{ $dish->menu_name }}</td>
                                <td>{{ $dish->menu_price }}&nbsp;zł</td>
                                <td>{{ $dish->menu_preparation_time }}</td>
                                <td>{{ $dish->food_type_name }}</td>
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#dishModal" onclick="$('#dishIdValue').val({{ $dish->menu_id }});$('#dishName').html('{{ $dish->menu_name }}')">Order Dish</button>
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

    <!-- Modal -->
    <div class="modal fade" id="dishModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tableName"><STRONG>Are you sure?</STRONG></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'POST','route' => ['client.order.store'],'style'=>'display:inline']) !!}
                    <div>Are you sure you want to add <STRONG><span id="dishName"></span></STRONG> to your order?</div>
                    <div>
                        <input type="text" id="dishIdValue" name="order_menu_id" hidden>
                    </div>
                    <div><label for="dish_delayed">Dish delayed: </label><input type="time" name="order_delayed_time"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    {!! Form::submit('Add Dish', ['class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
