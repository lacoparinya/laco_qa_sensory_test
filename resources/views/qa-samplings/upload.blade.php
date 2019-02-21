@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>ข้อมูล QA Upload</h2></div>
                    <div class="card-body">
                        <a href="{{ url('/qa-samplings') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i> Back</button></a>
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
                            <form method="POST" action="{{ url('qasample/uploadAction') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            
                                <div  class="form-group col-md-4">
                                {{ csrf_field() }}

                            {{ Form::file('uploadfile') }}
                            </div>
                             <div class="form-group col-md-4">
                                <input class="btn btn-primary" type="submit" value="upload">
                            </div>
                             </form>
                            <div class="col-md-4" ><a href="{{ url('/files/template2.xlsx') }}" title="Back"><button class="btn btn-warning"><i class="glyphicon glyphicon-download-alt" aria-hidden="true"></i> Template Excel</button></div>
                           
                       

                        </div>
                       
                        </div>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
