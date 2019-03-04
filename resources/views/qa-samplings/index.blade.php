@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">รายการ QA Sample Data</div>
                    <div class="card-body">
                        <a href="{{ url('/qasample/upload') }}" class="btn btn-success btn-sm" title="Add New QaSampling">
                            <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Upload Data
                        </a>

                        <form method="GET" action="{{ url('/qa-samplings') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
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
                                        <th>Run Number</th>
                                        <th>Sampling Date</th>
                                        <th>Sampling No.</th>
                                        <th>Product</th>
                                        <th>Customer/Farmer</th>
                                  <!--      <th>Order No./Loading Date</th>
                                        <th>Mfg. Date</th>
                                        <th>Exp. Date</th>
                                        <th>Lot/Batch</th>
                                         -->
                                        <th>Detail of Product</th>
                                        <th>Carton No.</th>
                                        <th>Pallet No.</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($qasamplings as $item)
                                    <tr>
                                        <td>{{ $item->run_number }}</td>
                <td>{{ $item->sampling_date }}</td>
                <td>{{ $item->sampling_no }}</td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->customer_farmer }}</td>
              <!--
                <td>{{ $item->order_no_loading_date }}</td>
                <td>{{ $item->mfg_date }}</td>
                <td>{{ $item->exp_date }}</td>
                <td>{{ $item->lot_batch }}</td>
              -->
                <td>{{ $item->product_details }}</td>
                <td>{{ $item->carton_no }}</td>
                <td>{{ $item->pallet_no }}</td>



                                        
                                        
                                        <td>
                                            <a href="{{ url('/qa-samplings/' . $item->id) }}" title="View QaSampling"><button class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i> View</button></a>

                                            <form method="POST" action="{{ url('/qa-samplings' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete QaSampling" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $qasamplings->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
