@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">SensoryTest {{ $sensorytest->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/sensory-tests') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        
                        <form method="POST" action="{{ url('sensorytests' . '/' . $sensorytest->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete SensoryTest" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $sensorytest->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sensory Test Set</th><td>{{ $sensorytest->sensoryMaster->sensory_name }} / {{ $sensorytest->sensoryMaster->test_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tester</th><td>{{ $sensorytest->tester_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Test Date</th><td>{{ $sensorytest->test_date }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Product</th>
                                        <th>Color</th>
                                        <th>Odor</th>
                                        <th>Texture</th>
                                        <th>Taste</th>
                                        <th>Average</th>
                                        <th>Result</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sensorytest->sensoryTestD as $item)
                                    <tr>
                                        <td>{{ $item->sample_code }}</td>
                                        <td>{{ $item->product_code }}</td>
                                        <td>{{ $item->color }}</td>
                                        <td>{{ $item->odor }}</td>
                                        <td>{{ $item->texture }}</td>
                                        <td>{{ $item->taste }}</td>
                                        <td>{{ $item->avg_result }}</td>
                                        <td>{{ $item->result }}</td>
                                        <td>{{ $item->note }}</td>
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
