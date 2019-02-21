@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">แสดงข้อมูล ตัวอย่าง QA  # {{ $qasampling->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/qa-samplings') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                         <form method="POST" action="{{ url('qasamplings' . '/' . $qasampling->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete QaSampling" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $qasampling->id }}</td>
                                        <th>Run Number</th><td>{{ $qasampling->run_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sampling Date</th><td>{{ $qasampling->sampling_date }}</td>
                                        <th>Sampling No.</th><td>{{ $qasampling->sampling_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product</th><td>{{ $qasampling->product_name }}</td>
                                        <th>Customer/Farmer</th><td>{{ $qasampling->customer_farmer }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order No./Loading Date</th><td>{{ $qasampling->order_no_loading_date }}</td>
                                        <th>Mfg. Date</th><td>{{ $qasampling->mfg_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Exp. Date</th><td>{{ $qasampling->exp_date }}</td>
                                        <th>Lot/Batch</th><td>{{ $qasampling->lot_batch }}</td>
                                    </tr>
                                    <tr>
                                        <th>Detail of Product</th><td>{{ $qasampling->product_details }}</td>
                                        <th>Carton No.</th><td>{{ $qasampling->carton_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pallet No.</th><td>{{ $qasampling->pallet_no }}</td>
                                        <th></th><td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
