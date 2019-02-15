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
google.charts.setOnLoadCallback(drawVisualization);

     function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Product', 'Color', 'Odor', 'Texture', 'Taste','Limit Top','Limit Below'],
          @foreach($summaryData as $item)
            ['{{ $item->code }} - {{ $item->product_group }}',{{ $item->avg_color }},{{ $item->avg_odor }},{{ $item->avg_texture }},{{ $item->avg_taste }},5,1],
          @endforeach
        ]);

        var options = {
                chartArea: {
                    top: 45,
                    height: '50%' 
                },
                title : 'สรุปผลการคัดวันที่',
                legend: { 
                    position: 'top', 
                    maxLines: 3 
                },
                vAxis: {
                    title: 'ปริมาณDefect (%)'
                },
                seriesType: 'bars',
                series: {
                    4: {type: 'line'},
                    5: {type: 'line'}
                },


        };

        var view = new google.visualization.DataView(data);

        var chart_div = document.getElementById('chart1');
      var chart = new google.visualization.ColumnChart(chart_div);
        
        google.visualization.events.addListener(chart, 'ready', function () {
        chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
        //console.log(chart_div.innerHTML);
      });


        chart.draw(view, options);
      }

  


    
 </script>
@endif
@endsection