@extends('layouts.graph')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>รายงาน</h2></div>
                    <div class="panel-body">
                        <a href="{{ url('/sensory-masters') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        
                        @if (!$summaryData->isEmpty())
                        <div class="row">
                        </div>
                        <div class="row">
                          <div class="col-md-12">  
                            <div id="chart1" style=" height: 500px;"></div>
                          </div>
                    </div>
                    @else
                    <div class="row">
                            <div class="col-md-12" style="text-align:center;"><B>ไม่สามารถ สร้าง Graph ได้</B></div>
                            </div>
                    @endif
                </div>
            </div>
        </div>
</div>
@if (!$summaryData->isEmpty())
<script>
google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

  


    
 </script>
@endif
@endsection