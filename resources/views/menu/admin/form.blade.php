<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('menu_name', null, array('placeholder' => 'Coca Cola','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Price: </strong>
            {!! Form::text('menu_price', null, array('placeholder' => '10.00','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Preparation time: </strong>
            {!! Form::time('menu_preparation_time', null, array('placeholder' => '00:05','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Food type: </strong>
            {{ Form::select('menu_food_type_id', $foodTypes, null, array('class' => 'form-control')) }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Send</button>
    </div>
</div>
