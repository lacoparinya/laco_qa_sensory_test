@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>รายการแบบทดสอบ</h2></div>
                    <div class="card-body">
                        <a href="{{ url('/sensory/generate') }}" class="btn btn-success btn-sm" title="Add New SensoryMaster">
                            <i class="glyphicon  glyphicon-plus" aria-hidden="true"></i> สร้างแบบทดสอบ
                        </a>

                        <form method="GET" action="{{ url('/sensory-masters') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>วันที่</th>
                                        <th>ครั้งที่</th>
                                        <th>ชื่อการทดสอบ</th>
                                        <th>จำนวนตัวอย่าง</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($sensorymasters as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->test_date }}</td>
                                        <td>{{ $item->test_time }}</td>
                                        <td>{{ $item->sensory_name }}</td>
                                        <td>{{ $item->sensoryDetail->count() }}</td>
                                        <td>
                                            <a href="{{ url('/sensory-masters/' . $item->id) }}" title="View SensoryMaster"><button class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye" aria-hidden="true"></i> ดูสินค้า</button></a>
                                             @if ( $item->status == 'testing' )
                                            <a href="{{ url('/sensory/stopTest/' . $item->id ) }}" title="Edit SensoryMaster"><button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i> Stop</button></a>
                                            @else
                                            <a href="{{ url('/sensory-masters/' . $item->id . '/edit') }}" title="Edit SensoryMaster"><button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i> แก้หัวเรื่อง</button></a>
                                            <a href="{{ url('/sensory/editset/' . $item->id ) }}" title="Edit SensoryMaster"><button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i> แก้สินค้า</button></a>
                                            <a href="{{ url('/sensory/submitTest/' . $item->id ) }}" title="Edit SensoryMaster"><button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i> แก้รหัส</button></a>
                                            <a href="{{ url('/sensory/startTest/' . $item->id ) }}" title="Edit SensoryMaster"><button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i> Start</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $sensorymasters->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
