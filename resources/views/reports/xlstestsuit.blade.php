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
        <th>Test Set</th>
        <th>Test Name</th>
        <th>Tester</th>
        <th>Result Rate</th>
        <th>Resutl Text</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data->anssuitm as $item)
    <tr>
      <td>{{ $data->test_date }}</td>
      <td>{{ $data->test_set }}</td>
      <td>{{ $data->name }}</td>
      <td>{{ $item->name }}</td>
      <td>{{ $item->resultrate }}</td>
      <td>{{ $item->resulttxt }}</td>
    </tr>        
    @endforeach
  </tbody>
</table>
</body>
</html>