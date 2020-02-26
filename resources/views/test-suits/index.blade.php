@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Testsuits</div>
                    <div class="card-body">
                        <a href="{{ url('/test-suits/create') }}" class="btn btn-success btn-sm" title="Add New TestSuit">
                            <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/test-suits') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>ทดสอบ</th>
                                        <th>จำนวนคำตอบ</th>
                                        <th>จำนวนผู้ทดสอบ</th>
                                        <th>สถานะ</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($testsuits as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->test_set }}/{{ $item->name }}</td>
                                        <td>{{ $item->testsuitd->count() }}</td>
                                        <td>{{ $item->anssuitm->count() }}</td>
                                        <td>{{ $item->status }}</td>
                                        


                                        <td>
                                            <a href="{{ url('/test-suits/' . $item->id) }}" title="View TestSuit"><button class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i> View</button></a>
                                            

                                            @if ($item->status=="Active")
                                                <a href="{{ url('/test-suits/changeStatus/' . $item->id.'/testing' ) }}" title="Start"><button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-play" aria-hidden="true"></i> Start</button></a>
                                                <a href="{{ url('/test-suits/' . $item->id . '/edit') }}" title="Edit TestSuit"><button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i> Edit</button></a>
                                            <form method="POST" action="{{ url('/test-suits' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                               {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete TestSuit" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i> Delete</button>
                                            </form>
                                            @else
                                            @if ($item->status=="testing")
                                                <a href="{{ url('/test-suits/runtest/' . $item->id ) }}" title="ทดสอบ"><button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-record" aria-hidden="true"></i> ทดสอบ</button></a>
                                                <a href="{{ url('/test-suits/changeStatus/' . $item->id.'/pause' ) }}" title="Pause"><button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-pause" aria-hidden="true"></i> Pause</button></a>
                                                <a href="{{ url('/test-suits/changeStatus/' . $item->id.'/end' ) }}" title="Stop"><button class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-stop" aria-hidden="true"></i> Stop</button></a>
                                                
                                            @else
                                            @if ($item->status=="pause")
                                                <a href="{{ url('/test-suits/changeStatus/' . $item->id.'/testing' ) }}" title="Restart"><button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-play" aria-hidden="true"></i> Re-Start</button></a>
                                            @else
                                            @if ($item->status=="end")
                                                <a href="{{ url('/test-suits/showResult/' . $item->id ) }}" title="Result"><button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-inbox" aria-hidden="true"></i> Result</button></a>
                                                <a href="{{ url('/test-suits/exportExcel/' . $item->id ) }}" title="Excel"><button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Excel</button></a>
                                            @endif
                                            @endif
                                            @endif
                                            @endif
                                            <a href="{{ url('/test-suits/printform/' . $item->id ) }}" target="_blank" title="Edit SensoryMaster"><button class="btn btn-success btn-sm"><i class="glyphicon glyphicon-qrcode" aria-hidden="true"></i> Print</button></a>
                                          
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $testsuits->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
