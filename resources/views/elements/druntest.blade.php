@extends('layouts.notlogin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12"><h2>กรอกผลตรวจสอบ</h2>

                        <div class="row">
                            <div class="col-md-4">วันที่ทดสอบ : {{ $sensorymaster->test_date }}</div>
                            <div class="col-md-4">ครั้งที่ : {{ $sensorymaster->test_time }}</div>
                            <div class="col-md-4">ชื่อ : {{ $sensorymaster->sensory_name }}</div>
                            <div class="col-md-12">Note : {{ $sensorymaster->note }}</div>
                        </div>
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/sensory/runtestAction/'.$sensorymaster->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group col-md-4 {{ $errors->has('tester_name') ? 'has-error' : ''}}">
                                <label for="tester_name" class="control-label">{{ 'ชื่อผู้ทดสอบ' }}</label>
                                <input class="form-control" name="tester_name" type="text" required id="tester_name" >
                                {!! $errors->first('tester_name', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group col-md-8 {{ $errors->has('tester_note') ? 'has-error' : ''}}">
                                <label for="tester_note" class="control-label">{{ 'Note' }}</label>
                                <input class="form-control" name="tester_note" type="text" id="tester_note" >
                                {!! $errors->first('tester_note', '<p class="help-block">:message</p>') !!}
                            </div>

                            <table class="table">
                                <tbody>
                                    @foreach ( $sensorymaster->sensoryDetail as $item)
                                    <tr>
                                        <td>{{ Form::checkbox('chktested', $item->id, false,array('class' => 'chkall')) }} ตัวอย่าง : {{ $item->code }}<br/>Product : {{ $item->qaSampleData->product_name }}</td>
                                        <td>Color<div class="{{ $errors->has('test['.$item->id.'][color]') ? 'has-error' : ''}}">
                                        <select data-id="{{$item->id}}" name="test[{{$item->id}}][color]" id="test-{{$item->id}}-color" required class="form-control sensory-check" style="width:55px;">>
                                            @foreach ($optionList as $key=>$value)
                                                <option value="{{ $key }}"
                                                @if ($key == '3')
                                                    selected 
                                                @endif
                                                >{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('test['.$item->id.'][color]', '<p class="help-block">:message</p>') !!}
                                        </div></td>
                                        <td>Odor<div class=" form-group  {{ $errors->has('test['.$item->id.'][odor]') ? 'has-error' : ''}}">
                                    
                                        <select data-id="{{$item->id}}" name="test[{{$item->id}}][odor]" id="test-{{$item->id}}-odor" required class="form-control sensory-check" style="width:55px;">
                                            @foreach ($optionList as $key=>$value)
                                                <option value="{{ $key }}"
                                                @if ($key == '3')
                                                    selected 
                                                @endif
                                                >{{ $value }}</option>
                                            @endforeach
                                        </select>

                                        {!! $errors->first('test['.$item->id.'][odor]', '<p class="help-block">:message</p>') !!}
                                        </div></td>
                                        <td>Texture<div class="form-group {{ $errors->has('test['.$item->id.'][texture]') ? 'has-error' : ''}}">
                                        
                                            <select data-id="{{$item->id}}" name="test[{{$item->id}}][texture]" id="test-{{$item->id}}-texture" required class="form-control sensory-check" style="width:55px;">>
                                            @foreach ($optionList as $key=>$value)
                                                <option value="{{ $key }}"
                                                @if ($key == '3')
                                                    selected 
                                                @endif
                                                >{{ $value }}</option>
                                            @endforeach
                                        </select>

                                            {!! $errors->first('test['.$item->id.'][texture]', '<p class="help-block">:message</p>') !!}
                                        </div></td>
                                        <td>Taste<div class="form-group {{ $errors->has('test['.$item->id.'][taste]') ? 'has-error' : ''}}">
                                        
                                            <select data-id="{{$item->id}}" name="test[{{$item->id}}][taste]" id="test-{{$item->id}}-taste" required class="form-control sensory-check" style="width:55px;">
                                            @foreach ($optionList as $key=>$value)
                                                <option value="{{ $key }}"
                                                @if ($key == '3')
                                                    selected 
                                                @endif
                                                >{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('test['.$item->id.'][taste]', '<p class="help-block">:message</p>') !!}
                                        </div></td>
                                        
                                        <td>Note<div class="form-group {{ $errors->has('test['.$item->id.'][note]') ? 'has-error' : ''}}">
                                        <input data-id="{{$item->id}}"  class="form-control sensory-check" name="test[{{$item->id}}][note]" type="text" id="test-{{$item->id}}-note" style="width:150px;" >
                                        {!! $errors->first('test['.$item->id.'][note]', '<p class="help-block">:message</p>') !!}
                                        Image
                                        <input data-id="{{$item->id}}"  type="file" accept="image/*" name="test[{{$item->id}}][capture]" id="test-{{$item->id}}-capture" capture="camera"> 
                                        </div></td>
                                        <td>Result (Avg Point)
                                            <div id="test-{{$item->id}}-result" ></div>
                                            <input type="hidden" name="test[{{$item->id}}][hidden]" id="test-{{$item->id}}-hidden" value="Pass"/>
                                            <input type="hidden" name="test[{{$item->id}}][avg]" id="test-{{$item->id}}-avg" value="3" />
                                            
                                            <input type="hidden" name="test[{{$item->id}}][qasampleid]" id="test-{{$item->id}}-qasampleid" value="{{ $item->qaSampleData->id }}" />
                                            <input type="hidden" name="test[{{$item->id}}][txtcode]" id="test-{{$item->id}}-txtcode" value="{{ $item->code }}" />
                                            <input type="hidden" name="test[{{$item->id}}][txtprod]" id="test-{{$item->id}}-txtprod" value="{{ $item->qaSampleData->product_name }}" />
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           
                            <div class="form-group">
                                <input name='btnsave' id='btnsave' class="btn btn-primary" type="submit" value="ส่งผลทดสอบ" disabled>
                            </div>

                        </form>
            </div>
        </div>
    </div>
@endsection