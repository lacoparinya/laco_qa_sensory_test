@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">การทดสอบ {{ $testsuit->name }} ปิดให้บริการ</div>
                    <div class="card-body">
                        <a href="{{ url('/test-suits') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
