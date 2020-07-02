
<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Receipt: </strong>

            {{ Form::select('order_receipt_id', $receipts, null, array('class' => 'form-control')) }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Dish: </strong>

            {{ Form::select('order_menu_id', $menus, null, array('class' => 'form-control')) }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Employee: </strong>

            {{ Form::select('order_employee_id', $employees, null, array('class' => 'form-control')) }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Delayed time: </strong>

            {!! Form::time('order_delayed_time', null, array('placeholder' => '00:05:00','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Send</button>

    </div>

</div>
