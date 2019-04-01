@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>แก้ไขผลการทดสอบ</h2></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">วันที่ทดสอบ : {{ $sensoryTestM->sensoryMaster->test_date }}</div>
                            <div class="col-md-4">ครั้งที่ : {{ $sensoryTestM->sensoryMaster->test_time }}</div>
                            <div class="col-md-4">ชื่อ : {{ $sensoryTestM->sensoryMaster->sensory_name }}</div>
                            <div class="col-md-12">Note : {{ $sensoryTestM->sensoryMaster->note }}</div>
                        </div>
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/sensory/edittestAction/'.$sensoryTestM->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group col-md-4 {{ $errors->has('tester_name') ? 'has-error' : ''}}">
                                <label for="tester_name" class="control-label">{{ 'ชื่อผู้ทดสอบ' }}</label>
                            <input class="form-control" name="tester_name" type="text" required id="tester_name" value="{{ $sensoryTestM->tester_name }}" >
                                {!! $errors->first('tester_name', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group col-md-8 {{ $errors->has('tester_note') ? 'has-error' : ''}}">
                                <label for="tester_note" class="control-label">{{ 'Note' }}</label>
                                <input class="form-control" name="tester_note" type="text" id="tester_note" value="{{ $sensoryTestM->tester_note }}">
                                {!! $errors->first('tester_note', '<p class="help-block">:message</p>') !!}
                            </div>

                            <table class="table" >
                                <tbody>
                                    @foreach ( $sensoryTestM->sensoryTestD as $item)
                                    <tr>
                                        <td>{{ $item->sample_code }}<br/>{{ $item->product_code }}</td>


                                        <td>Color<div class="form-group {{ $errors->has('test['.$item->id.'][color]') ? 'has-error' : ''}}">
                                        <select data-id="{{$item->id}}" name="test[{{$item->id}}][color]" id="test-{{$item->id}}-color" required class="form-control sensory-check" style="width:100px;">>
                                            @foreach ($optionList as $key=>$value)
                                                <option value="{{ $key }}"
                                                @if ($key == $item->color)
                                                    selected
                                                @endif
                                                >{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('test['.$item->id.'][color]', '<p class="help-block">:message</p>') !!}
                                        </div></td>
                                        <td>Odor<div class="form-group {{ $errors->has('test['.$item->id.'][odor]') ? 'has-error' : ''}}">
                                    
                                        <select data-id="{{$item->id}}" name="test[{{$item->id}}][odor]" id="test-{{$item->id}}-odor" required class="form-control sensory-check" style="width:100px;">>
                                            @foreach ($optionList as $key=>$value)
                                                <option value="{{ $key }}"
                                                @if ($key == $item->odor)
                                                    selected
                                                @endif
                                                >{{ $value }}</option>
                                            @endforeach
                                        </select>

                                        {!! $errors->first('test['.$item->id.'][odor]', '<p class="help-block">:message</p>') !!}
                                        </div></td>
                                        <td>Texture<div class="form-group {{ $errors->has('test['.$item->id.'][texture]') ? 'has-error' : ''}}">
                                        
                                            <select data-id="{{$item->id}}" name="test[{{$item->id}}][texture]" id="test-{{$item->id}}-texture" required class="form-control sensory-check" style="width:100px;">>
                                            @foreach ($optionList as $key=>$value)
                                                <option value="{{ $key }}"
                                                @if ($key == $item->texture)
                                                    selected
                                                @endif
                                                >{{ $value }}</option>
                                            @endforeach
                                        </select>

                                            {!! $errors->first('test['.$item->id.'][texture]', '<p class="help-block">:message</p>') !!}
                                        </div></td>
                                        <td>Taste<div class="form-group {{ $errors->has('test['.$item->id.'][taste]') ? 'has-error' : ''}}">
                                        
                                            <select data-id="{{$item->id}}" name="test[{{$item->id}}][taste]" id="test-{{$item->id}}-taste" required class="form-control sensory-check" style="width:100px;">
                                            @foreach ($optionList as $key=>$value)
                                                <option value="{{ $key }}"
                                                @if ($key == $item->taste)
                                                    selected
                                                @endif
                                                >{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('test['.$item->id.'][taste]', '<p class="help-block">:message</p>') !!}
                                        </div></td>
                                    </tr>
                                    <tr>
                                        <td  colspan="5">
                                        <div style="float:left">
                                            note<input data-id="{{$item->id}}"  class="form-control sensory-check" name="test[{{$item->id}}][note]" type="text" id="test-{{$item->id}}-note" value="{{ $item->note or '' }}">
                                        {!! $errors->first('test['.$item->id.'][note]', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        <div  style="float:left;padding-left:10%;">
                                    Image
                                        <input data-id="{{$item->id}}"  type="file" accept="image/*" name="test[{{$item->id}}][capture]" id="test-{{$item->id}}-capture" capture="camera"> 
                                        @if (!empty($item->image_path))
                                            <img src="{{  env('APP_URL').Illuminate\Support\Facades\Storage::url($item->image_path) }}" height="100px">
                                        @endif  
                                    </div>
                                    <div>
                                            <div id="test-{{$item->id}}-result" > ({{ $item->avg_result }}) {{ $item->result }}</div>
                                            <input type="hidden" name="test[{{$item->id}}][hidden]" id="test-{{$item->id}}-hidden" value="{{ $item->result }}" />
                                            <input type="hidden" name="test[{{$item->id}}][avg]" id="test-{{$item->id}}-avg" value="{{ $item->avg_result }}" />
                                    </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="ยืนยันผลทดสอบ">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection