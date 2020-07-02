
<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Name:</strong>

            {!! Form::text('client_name', null, array('placeholder' => 'John Keys','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Credit card number:</strong>

            {!! Form::text('client_card_number', null, array('placeholder' => '1234 1234 1234','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Credit card expiry date:</strong>

            {!! Form::text('client_card_expiry_date', null, array('placeholder' => '07/20','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>CCV:</strong>

            {!! Form::text('client_card_ccv_code', null, array('placeholder' => '333','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Send</button>

    </div>

</div>
