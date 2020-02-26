@extends('layouts.graph')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">TestSuit {{ $data2->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/test-suits') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br/>
                        <br/>
                        <div class="row">
                        <div class="col-md-3"><b>ID</b> : {{ $data2->id }}</div>
                        <div class="col-md-3"><b>วันที่ทดสอบ</b> : {{ $data2->test_date }}</div>
                        <div class="col-md-3"><b>ประเภทการทดสอบ</b> : {{ $data2->test_set }}</div>
                        <div class="col-md-3"><b>ชื่อการทดสอบ</b> : {{ $data2->name }}</div>
                        <div class="col-md-12"><b>รายละเอียด</b> : {{ $data2->details }}</div>
                        </div>
                            <div class="row">
                                <div class="col-md-12" id="piechart"  style=" height: 300px;"></div>
                            </div>
                            <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ผู้ทดสอบ</th>
                                        <th>คะแนน</th>
                                        <th>ผลการทดสอบ</th>
                                        <th>สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data2->anssuitm as $item)
                                        <tr>
                                        <td alt="{{ $item->id }}">{{ $item->name }}</td>
                                        <td>{{ $item->resultrate }}</td>
                                        <td>{{ $item->resulttxt }}</td>
                                        <td>{{ $item->status }}</td>
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

<script>

google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Result', 'Person'],
          @foreach ($data as $reportitm)
    ['{{ $reportitm->resulttxt }}',     {{ $reportitm->count_result }}],
            @endforeach
          
        ]);

        var options = {
          title: 'Result of {{ $data2->name }}'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
</script>
@endsection
