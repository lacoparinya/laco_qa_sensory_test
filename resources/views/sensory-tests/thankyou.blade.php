@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>ส่งผลตรวจสอบผลเรียบร้อย</h2></div>
                    <div class="card-body">
                        <h3>ขอบคุณที่ทดสอบ</h3>
                        <br />
                        <br />
                        <a href="{{ url('/sensory-tests') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
