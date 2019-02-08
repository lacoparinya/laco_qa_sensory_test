@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create New SensoryMaster</div>
                    <div class="card-body">
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

                        <form method="POST" action="{{ url('/sensory/submitAction/'.$sensorymaster->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
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

                            <table class="table" >
                                <thead>
                                    <tr>
                                        <th style="text-align:center" rowspan="2">ตัวอย่าง</th>
                                        <th style="text-align:center" rowspan="2">Product</th>
                                        <th style="text-align:center" colspan="4">Test Item</th>
                                        <th style="text-align:center" rowspan="2">Result</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center" >Color</th>
                                        <th style="text-align:center" >Odor</th>
                                        <th style="text-align:center" >Texture</th>
                                        <th style="text-align:center" >Taste</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $sensorymaster->sensoryDetail as $item)
                                    <tr>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->qaSampleData->seq_sample_code }}</td>
                                        <td><div class="form-group {{ $errors->has('test['.$item->id.'][color]') ? 'has-error' : ''}}">
                                        <input min="1" max="5" data-id="{{$item->id}}" class="form-control sensory-check" name="test-{{$item->id}}-color" type="number" id="test-{{$item->id}}-color" required >
                                        {!! $errors->first('test['.$item->id.'][color]', '<p class="help-block">:message</p>') !!}
                                        </div></td>
                                        <td><div class="form-group {{ $errors->has('test['.$item->id.'][odor]') ? 'has-error' : ''}}">
                                        <input data-id="{{$item->id}}" class="form-control sensory-check" name="test[{{$item->id}}][odor]" type="number" id="test-{{$item->id}}-odor" required >
                                        {!! $errors->first('test['.$item->id.'][odor]', '<p class="help-block">:message</p>') !!}
                                        </div></td>
                                        <td><div class="form-group {{ $errors->has('test['.$item->id.'][texture]') ? 'has-error' : ''}}">
                                        <input min="1" max="5" data-id="{{$item->id}}"  class="form-control sensory-check" name="test[{{$item->id}}][texture]" type="number" id="test-{{$item->id}}-texture" required >
                                        {!! $errors->first('test['.$item->id.'][texture]', '<p class="help-block">:message</p>') !!}
                                        </div></td>
                                        <td><div class="form-group {{ $errors->has('test['.$item->id.'][taste]') ? 'has-error' : ''}}">
                                        <input min="1" max="5" data-id="{{$item->id}}"  class="form-control sensory-check" name="test[{{$item->id}}][taste]" type="number" id="test-{{$item->id}}-taste" required >
                                        {!! $errors->first('test['.$item->id.'][taste]', '<p class="help-block">:message</p>') !!}
                                        </div></td>
                                        <td>
                                            <div id="test-{{$item->id}}-result" ></div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Submit">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection