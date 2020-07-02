
<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name: </strong>
            {!! Form::text('employee_name', null, array('placeholder' => 'John','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Surname: </strong>
            {!! Form::text('employee_surname', null, array('placeholder' => 'Keys','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Birthday: </strong>
            {!! Form::date('employee_birthday', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Adress: </strong>
            {!! Form::text('employee_address', null, array('placeholder' => '601 Abbot Road E14 0DD London','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Phone Number: </strong>
            {!! Form::text('employee_phone_number', null, array('placeholder' => '+44 123 123 123','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Identification code:</strong>
            {!! Form::number('employee_identification_code', null, array('min' => '0', 'placeholder' => '1234','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Add</button>

    </div>

</div>
