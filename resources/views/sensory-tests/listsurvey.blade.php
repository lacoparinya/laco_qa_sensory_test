@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>รายการผลการทดสอบ Sensory Test </h2></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <a href="{{ url('/sensory-masters') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br/>
                        <br/>

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $sensorymaster->id }}</td>
                                        <th>วันที่ทดสอบ</th><td>{{ $sensorymaster->test_date }}</td>
                                        <th>ครั้งที่</th><td>{{ $sensorymaster->test_time }}</td>
                                        

                                    </tr>
                                    <tr>
                                        <th>ชื่อ</th><td>{{ $sensorymaster->sensory_name }}</td>
                                        <th>Note</th><td>{{ $sensorymaster->note }}</td>
                                        <th>Status</th><td>{{ $sensorymaster->status }}</td>

                                    </tr>
                                    
                                </tbody>
                            </table>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sensory Set / วันที่ให้ทดสอบ</th>
                                        <th>Tester / วันที่ใส่ผล</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($sensorytests as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->sensoryMaster->sensory_name }} / {{ $item->sensoryMaster->test_date }}</td>
                                        <td>{{ $item->tester_name }} / {{ $item->test_date }}</td>
                                        <td>
                                            <a href="{{ url('/sensory-tests/' . $item->id) }}" title="View SensoryTest"><button class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i> View</button></a>
                                           
                                            <form method="POST" action="{{ url('/sensory-tests' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete SensoryTest" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
