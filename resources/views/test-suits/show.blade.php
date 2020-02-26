@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">TestSuit {{ $testsuit->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/test-suits') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/test-suits/' . $testsuit->id . '/edit') }}" title="Edit TestSuit"><button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('testsuits' . '/' . $testsuit->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete TestSuit" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>
                        <div class="row">
                        <div class="col-md-3"><b>ID</b> : {{ $testsuit->id }}</div>
                        <div class="col-md-3"><b>วันที่ทดสอบ</b> : {{ $testsuit->test_date }}</div>
                        <div class="col-md-3"><b>ประเภทการทดสอบ</b> : {{ $testsuit->test_set }}</div>
                        <div class="col-md-3"><b>ชื่อการทดสอบ</b> : {{ $testsuit->name }}</div>
                        <div class="col-md-12"><b>รายละเอียด</b> : {{ $testsuit->details }}</div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>Code</th>
                                        <th>รายละเอียด</th>
                                        <th>คำตอบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testsuit->testsuitdorderseq as $item)
                                        <tr>
                                        <td>{{ $item->seq }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->details }}</td>
                                        <td>{{ $item->ans }}</td>
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
