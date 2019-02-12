@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>ข้อมูล QA Upload</h2></div>
                    <div class="card-body">
                        <a href="{{ url('/qa-sample-datas') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="row">
                            <form method="POST" action="{{ url('qa/uploadAction') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            <div  class="col-md-12">
                                <div  class="form-group col-md-6">
                                {{ csrf_field() }}

                            {{ Form::file('uploadfile') }}
                            </div>
                            <div class="form-group col-md-6">
                                <input class="btn btn-primary" type="submit" value="upload">
                            </div>

                            </div>
                        </form>

                        </div>
                        <div class="row">
                            <div class="col-md-6"><a href="{{ url('/qa-sample-datas') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Template Excel</button></a>
                       </div>
                            <div class="col-md-6"></div>
                        </div>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
