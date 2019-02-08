
<div class="form-group {{ $errors->has('test_date') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'วันที่ทดสอบ' }}</label>
    <input class="form-control" name="test_date" type="date" required id="test_date" value="{{ $sensorymaster->test_date or ''}}" >
    {!! $errors->first('test_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('test_time') ? 'has-error' : ''}}">
    <label for="desc" class="control-label">{{ 'ครั้งที่' }}</label>
    <input class="form-control" name="test_time" type="number" id="test_time" required value="{{ $sensorymaster->test_time or '1'}}" >
    {!! $errors->first('test_time', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sensory_name') ? 'has-error' : ''}}">
    <label for="desc" class="control-label">{{ 'ชื่อ' }}</label>
    <input class="form-control" name="sensory_name" type="text" id="sensory_name" required value="{{ $sensorymaster->sensory_name or ''}}" >
    {!! $errors->first('sensory_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
    <label for="desc" class="control-label">{{ 'Note' }}</label>
    <textarea class="form-control" name="note" type="textarea" id="note" >{{ $sensorymaster->note or ''}}</textarea>
    {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
