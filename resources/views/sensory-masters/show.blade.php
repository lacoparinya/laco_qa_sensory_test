@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">SensoryMaster {{ $sensorymaster->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/sensory-masters') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/sensory-masters/' . $sensorymaster->id . '/edit') }}" title="Edit SensoryMaster"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('sensorymasters' . '/' . $sensorymaster->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete SensoryMaster" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $sensorymaster->id }}</td>
                                        <th>วันที่ทดสอบ</th><td>{{ $sensorymaster->test_date }}</td>
                                        <th>ครั้งที่</th><td>{{ $sensorymaster->test_time }}</td>
                                        <th>ชื่อ</th><td>{{ $sensorymaster->sensory_name }}</td>
                                        <th>Note</th><td>{{ $sensorymaster->note }}</td>

                                    </tr>
                                    
                                </tbody>
                            </table>
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
                                    <div class="col-md-3">{{ $item->code or ''}}
                                    </div>
                                    <div class="col-md-3">{{ $item->time or '1'}}
                                    </div>
                                    <div class="col-md-3">{{ $item->note or ''}}</div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection