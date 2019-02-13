@extends('layouts.notlogin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>ตรวจสอบผล และ ยืนยัน</h2></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4"><label class="control-label">วันที่ทดสอบ</label> : {{ $sensoryTestM->sensoryMaster->test_date }}</div>
                            <div class="col-md-4"><label class="control-label">ครั้งที่</label> : {{ $sensoryTestM->sensoryMaster->test_time }}</div>
                            <div class="col-md-4"><label class="control-label">ชื่อ</label> : {{ $sensoryTestM->sensoryMaster->sensory_name }}</div>
                            <div class="col-md-12"><label class="control-label">Note</label> : {{ $sensoryTestM->sensoryMaster->note }}</div>
                        </div>
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                             <div class="col-md-4">
                                <label for="tester_name" class="control-label">{{ 'ชื่อผู้ทดสอบ' }}</label> : {{ $sensoryTestM->tester_name }}</div>
                            <div class="col-md-8" >
                                <label for="tester_note" class="control-label">{{ 'Note' }}</label> : {{ $sensoryTestM->tester_note }}</div>

                            <table class="table" >
                                <thead>
                                    <tr>
                                        <th style="text-align:center" rowspan="2">ตัวอย่าง</th>
                                        <th style="text-align:center" rowspan="2">Product</th>
                                        <th style="text-align:center" colspan="4">Test Item</th>
                                        <th style="text-align:center" rowspan="2">Result</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center" >Color</th>
                                        <th style="text-align:center" >Odor</th>
                                        <th style="text-align:center" >Texture</th>
                                        <th style="text-align:center" >Taste</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:center;">
                                    @foreach ( $sensoryTestM->sensoryTestD as $item)
                                    <tr>
                                        <td>{{ $item->sample_code }}</td>
                                        <td>{{ $item->product_code }}</td>
                                        <td>{{ $item->color }}</td>
                                        <td>{{ $item->odor }}</td>
                                        <td>{{ $item->texture }}</td>
                                        <td>{{ $item->taste }}</td>
                                        <td><div id="test-{{$item->id}}-result" >{{ $item->result }}</div></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           
                            <div class="form-group">
                                <a href="{{ url('/sensory/edittest/' . $sensoryTestM->id) }}" title="View SensoryTest"><button class="btn btn-success btn-m"><i class="fa fa-eye" aria-hidden="true"></i> แก้ไขผล</button></a>
                                <a href="{{ url('/sensory/sendtest/' . $sensoryTestM->id) }}" title="View SensoryTest"><button class="btn btn-primary btn-m"><i class="fa fa-eye" aria-hidden="true"></i> ส่งผล</button></a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection