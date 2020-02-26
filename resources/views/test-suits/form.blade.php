<div class="row">
    <div class="form-group col-md-4 {{ $errors->has('test_date') ? 'has-error' : ''}}">
        <label for="test_date" class="control-label">{{ 'วันที่ทดสอบ' }}</label>
        <input class="form-control" name="test_date" type="date" required id="test_date" value="{{ $testsuit->test_date or ''}}" >
        {!! $errors->first('test_date', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group  col-md-4 {{ $errors->has('test_set') ? 'has-error' : ''}}">
        <label for="test_set" class="control-label">{{ 'ประเภทการทดสอบ' }}</label>
        <input class="form-control" name="test_set" type="text" id="test_set" required value="{{ $testsuit->test_set or ''}}" >
        {!! $errors->first('test_set', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group  col-md-4 {{ $errors->has('name') ? 'has-error' : ''}}">
        <label for="name" class="control-label">{{ 'ชื่อการทดสอบ' }}</label>
        <input class="form-control" name="name" type="text" id="name" required value="{{ $testsuit->name or ''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group  col-md-12 {{ $errors->has('details') ? 'has-error' : ''}}">
        <label for="details" class="control-label">{{ 'รายละเอียด' }}</label>
        <input class="form-control" name="details" type="text" id="details" value="{{ $testsuit->details or ''}}" >
        {!! $errors->first('details', '<p class="help-block">:message</p>') !!}
    </div>
</div>

    @for ($i = 1; $i <= 10; $i++)
        <div class="row">
            <div class="col-md-1">
                <label for="codseqe{{$i}}" class="control-label">{{ 'ลำดับ' }}</label>
                <input class="form-control" name="seq{{$i}}" type="text" id="seq{{$i}}" readonly value="{{$i}}" >
            </div>
            <div class="col-md-3">
                <label for="code{{$i}}" class="control-label">{{ 'Code '.$i }}</label>
                @php
                    $code = "";
                    $desc = "";
                    $ans = "";
                    if(isset($testsuitds[$i])){
                        $code=$testsuitds[$i]->code;
                        $desc=$testsuitds[$i]->details;
                        $ans=$testsuitds[$i]->ans;
                    }
                @endphp
                <input class="form-control" name="code{{$i}}" type="text" id="code{{$i}}" value="{{ $code or '' }}" >
            </div>
            <div class="col-md-5">
                <label for="desc{{$i}}" class="control-label">{{ 'รายละเอียด '.$i }}</label>
                <input class="form-control" name="desc{{$i}}" type="text" id="desc{{$i}}" value="{{ $desc or ''}}" >
            </div>
            <div class="col-md-3">
                <label for="ans{{$i}}" class="control-label">{{ 'คำตอบ '.$i }}</label>
                <input class="form-control" name="ans{{$i}}" type="text" id="ans{{$i}}" value="{{ $ans or ''}}" >
            </div>
        </div>
    @endfor



<div class="col-md-12 form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
