@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">TestSuit {{ $testsuit->id }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/test-suits/edittestAction/'.$anssuit->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="row">
                        <div class="col-md-4"><b>วันที่ทดสอบ</b> : {{ $testsuit->test_date }}</div>
                        <div class="col-md-4"><b>ประเภทการทดสอบ</b> : {{ $testsuit->test_set }}</div>
                        <div class="col-md-4"><b>ชื่อการทดสอบ</b> : {{ $testsuit->name }}</div>
                        <div class="col-md-12"><b>รายละเอียด</b> : {{ $testsuit->details }}</div>
                        <div class="col-md-12">
                            <div class="form-group  col-md-4 {{ $errors->has('name') ? 'has-error' : ''}}">
        <label for="name" class="control-label">{{ 'ชื่อผู้ทดสอบ' }}</label>
        <input class="form-control" name="name" type="text" id="name" required value="{{$anssuit->name}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
                        </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>คำตอบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testsuit->testsuitdorderseq as $item)
                                        <tr>
                                        <td>{{ $item->code }}</td>
                                        <td>
                                            @foreach ($testsuit->testsuitdorderseq as $item2)
                                                <label for='code-{{$item->id}}' class="control-label">{{ $loop->iteration }}</label>
                                                @if ($anssuitdlist[$item->id] == $loop->iteration)
                                                    {{ Form::radio('code-'.$item->id, $loop->iteration  , true , ['class'=>'chkdup']) }}
                                                @else
                                                    {{ Form::radio('code-'.$item->id, $loop->iteration  , false , ['class'=>'chkdup']) }}
                                                @endif
                                                
                                            @endforeach
                                        </td>
                                        </tr>
                                    @endforeach
                                    
                                    
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12 form-group">
    <input class="btn btn-primary" type="submit" value="Send">
</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
