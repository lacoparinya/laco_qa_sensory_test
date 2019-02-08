@extends('layouts.multiselect')

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
                            <div class="row">
                                    <div class="col-md-3">Product</div>
                                    <div class="col-md-3">Code</div>
                                    <div class="col-md-3">Time</div>
                                    <div class="col-md-3">Note</div>
                            </div>
                            @foreach ( $sensorymaster->sensoryDetail as $item)
                                <div class="row">
                                    <div class="col-md-3">
                                        {{ $item->qaSampleData->product_code }} | {{ $item->qaSampleData->storedate_shift }} | {{ $item->qaSampleData->seq_sample_code }} 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('detail['.$item->id.'][code]') ? 'has-error' : ''}}">
                                        <input class="form-control" name="detail[{{$item->id}}][code]" type="text" id="detail[{{$item->id}}][code]" required value="{{ $item->code or ''}}" >
                                        {!! $errors->first('detail['.$item->id.'][code]', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('detail['.$item->id.'][time]') ? 'has-error' : ''}}">
                                        <input class="form-control" name="detail[{{$item->id}}][time]" type="text" id="detail[{{$item->id}}][time]"  value="{{ $item->time or '1'}}" >
                                        {!! $errors->first('detail['.$item->id.'][time]', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('detail['.$item->id.'][note]') ? 'has-error' : ''}}">
                                        <input class="form-control" name="detail[{{$item->id}}][note]" type="text" id="detail[{{$item->id}}][note]"  value="{{ $item->note or ''}}" >
                                        {!! $errors->first('detail['.$item->id.'][note]', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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