<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    tr td {
        border: 1px solid #000000;
        word-wrap: normal;
    }
    tr td.noborder {
        border: none;
        word-wrap: normal;
    }
     tr td.noborder-last {
        border: none;
        word-wrap: normal;
    }
    tr td.noborderr {
        border: none;
        text-align: right;
        word-wrap: break-word;
    }
    tr td.noborderc {
        border: none;
        text-align: center;
        word-wrap: break-word;
        font: bolder;
    }
    @media all {
	    .page-break	{ page-break-before: always; }
    }
    </style>
</head>
<body>
<table>
  <thead>
    <tr>
        <th>Test date</th>
        <th>Run Number</th>
        <th>Product	Order</th>
        <th>No./Loading Date</th>
        <th>Exp. Date</th>
        <th>Lot/Batch</th>
        <th></th>
        <th>Color</th>
        <th>Odor</th>
        <th>Texture</th>
        <th>Taste</th>
        <th>Average Score</th>
        <th>Result</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($summaryData as $item)
    <tr>
      <td>{{ $item->test_date }}</td>
      <td>{{ $item->code }}</td>
      <td>{{ $item->product_name }}</td>
      <td>{{ $item->order_no_loading_date }}</td>
      <td>{{ $item->exp_date }}</td>
      <td>{{ $item->lot_batch }}</td>
      <td></td>
      <td>{{ $item->avg_color }}</td>
      <td>{{ $item->avg_odor }}</td>
      <td>{{ $item->avg_texture }}</td>
      <td>{{ $item->avg_taste }}</td>
      <td>{{ $item->avg_all }}</td>
      <td>{{ $detailSummary[$item->test_date][$item->code]['result'] }}</td>
    </tr>        
    @endforeach
  </tbody>
</table>
</body>
</html>