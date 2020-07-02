
<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Table: </strong>

            {{ Form::select('receipt_table_id', $tables, null, array('class' => 'form-control')) }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Client: </strong>

            {{ Form::select('receipt_client_id', $clients, null, array('class' => 'form-control')) }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Receipt opened date:</strong>

            {!! Form::date('receipt_opened_date', null, array('class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Send</button>

    </div>

</div>
