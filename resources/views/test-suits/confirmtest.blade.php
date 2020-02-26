@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">TestSuit {{ $anssuit->testsuitm->id }} | AnsTestSuit {{ $anssuit->id }}</div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-4"><b>วันที่ทดสอบ</b> : {{ $anssuit->testsuitm->test_date }}</div>
                        <div class="col-md-4"><b>ประเภทการทดสอบ</b> : {{ $anssuit->testsuitm->test_set }}</div>
                        <div class="col-md-4"><b>ชื่อการทดสอบ</b> : {{ $anssuit->testsuitm->name }}</div>
                        <div class="col-md-12"><b>รายละเอียด</b> : {{ $anssuit->testsuitm->details }}</div>
                        <div class="col-md-12"><b>ชื่อผู้ทดสอบ</b> : {{ $anssuit->name }}
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
                                    @foreach ($anssuit->anssuitd as $item)
                                        <tr>
                                        <td>{{ $item->testsuitd->code }}</td>
                                        <td>{{ $item->value }} </td>
                                        </tr>
                                    @endforeach
                                    
                                    
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12 form-group">
    <a href="{{ url('/test-suits/edittest/' . $anssuit->id) }}" title="Start"><button class="btn btn-success">Edit</button></a>
    @if ($checkdup)
        <a href="{{ url('/test-suits/confirmtestAction/' . $anssuit->id) }}" title="Start"><button class="btn btn-primary">Confirm</button></a>
 
    @endif
    
                                                  
</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
