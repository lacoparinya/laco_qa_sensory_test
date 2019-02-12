<div class="row">
<div class="form-group col-md-4 {{ $errors->has('test_date') ? 'has-error' : ''}}">
    <label for="test_date" class="control-label">{{ 'วันที่ทดสอบ' }}</label>
    <input class="form-control" name="test_date" type="date" required id="test_date" value="{{ $sensorymaster->test_date or ''}}" >
    {!! $errors->first('test_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group col-md-4  {{ $errors->has('test_time') ? 'has-error' : ''}}">
    <label for="test_time" class="control-label">{{ 'ครั้งที่' }}</label>
    <input class="form-control" name="test_time" type="number" id="test_time" required value="{{ $sensorymaster->test_time or '1'}}" >
    {!! $errors->first('test_time', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group  col-md-4 {{ $errors->has('sensory_name') ? 'has-error' : ''}}">
    <label for="sensory_name" class="control-label">{{ 'ชื่อการทดสอบ' }}</label>
    <input class="form-control" name="sensory_name" type="text" id="sensory_name" required value="{{ $sensorymaster->sensory_name or ''}}" >
    {!! $errors->first('sensory_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group  col-md-12 {{ $errors->has('note') ? 'has-error' : ''}}">
    <label for="desc" class="control-label">{{ 'Note' }}</label>
    <textarea class="form-control" name="note" type="textarea" id="note" >{{ $sensorymaster->note or ''}}</textarea>
    {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="row form-group ">
                <div class="col-sm-5">
                    <select name="from[]" id="search" class="form-control" size="8" multiple="multiple">
                        @foreach($qaDataList as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-sm-2">
                    <button type="button" id="search_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                    <button type="button" id="search_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                    <button type="button" id="search_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                    <button type="button" id="search_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                </div>
                
                <div class="col-sm-5">
                    <select name="to[]" id="search_to" class="form-control" size="8" multiple="multiple">
                        @foreach($sensorymaster->sensoryDetail as $key => $value)
                        <option value="{{ $value->qa_sample_data_id }}">{{ $value->qaSampleData->product_code }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
<div class="row">
<div class="form-group col-md-12">
    <input class="btn btn-primary" type="submit" value="Edit">
</div>
 </div>
