<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SensoryMaster;
use App\QaSampleData;
use App\SensoryDetail;

use Illuminate\Http\Request;


class SensoryMastersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $sensorymasters = SensoryMaster::where('sensory_name', 'like', '%' . $keyword . '%')->orWhere('test_date', 'like', '%' . $keyword . '%')->paginate($perPage);
        } else {
            $sensorymasters = SensoryMaster::latest()->paginate($perPage);
        }

        return view('sensory-masters.index', compact('sensorymasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('sensory-masters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();

        SensoryMaster::create($requestData);

        return redirect('sensory-masters')->with('flash_message', ' added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $sensorymaster = SensoryMaster::findOrFail($id);

        return view('sensory-masters.show', compact('sensorymaster'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $sensorymaster = SensoryMaster::findOrFail($id);

        return view('sensory-masters.edit', compact('sensorymaster'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();

        $sensorymaster = SensoryMaster::findOrFail($id);
        $sensorymaster->update($requestData);

        return redirect('sensory-masters')->with('flash_message', ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        SensoryMaster::destroy($id);

        return redirect('sensory-masters')->with('flash_message', ' deleted!');
    }

    public function generateTest(){
        $qaDataList = QaSampleData::pluck('product_code', 'id');
        return view('sensory-masters.generate', compact('qaDataList'));
    }

    public function generateTestAction(Request $request){
        $requestData = $request->all();

        $tmpData = array();
        $tmpData['test_date'] = $requestData['test_date'];
        $tmpData['test_time'] = $requestData['test_time'];
        $tmpData['sensory_name'] = $requestData['sensory_name'];
        $tmpData['note'] = $requestData['note'];
        $tmpData['status'] = 'create';

        $sensoryMasterId = SensoryMaster::create($tmpData)->id;

        $seq = 1;
        foreach ($requestData['to'] as $value) {
            $tmpDetail = array();

            $tmpDetail['sensory_master_id'] = $sensoryMasterId;
            $tmpDetail['qa_sample_data_id'] = $value;
            $tmpDetail['seq'] = $seq;
            $tmpDetail['status'] = 'create';
            

            SensoryDetail::create($tmpDetail);
            $seq++;
        }

        return redirect('/sensory/submitTest/' . $sensoryMasterId);
    }

    public function editset($id){
        $sensorymaster = SensoryMaster::findOrFail($id);
        if($sensorymaster->status == 'Testing'){
            return redirect('sensory-masters')->with('flash_message', ' อยู่ระหว่างการทดสอบ ไม่สามารถแก้ไขได้!');
        }
        $qaDataList = QaSampleData::pluck('product_code', 'id');
        return view('sensory-masters.editset', compact('sensorymaster', 'qaDataList'));
    }

    public function editsetAction(Request $request, $id)
    {
        $requestData = $request->all();

        $sensoryMaster = SensoryMaster::findOrFail($id);

        $sensoryMaster->test_date = $requestData['test_date'];
        $sensoryMaster->test_time = $requestData['test_time'];
        $sensoryMaster->sensory_name = $requestData['sensory_name'];
        $sensoryMaster->note = $requestData['note'];
        // $sensoryTestM->status = "create";
        foreach ($sensoryMaster->sensoryDetail as $key => $value) {
           if(!in_array("".$value->qa_sample_data_id,$requestData['to'],TRUE)){
                SensoryDetail::destroy($value->id);
           }
        }
        $seq = 1;
        foreach ($requestData['to'] as $value) {

            $sensoryDetail = SensoryDetail::where('qa_sample_data_id', $value)->where('sensory_master_id', $id)->first();

            if(empty($sensoryDetail)){
                $tmpDetail = array();

                $tmpDetail['sensory_master_id'] = $id;
                $tmpDetail['qa_sample_data_id'] = $value;
                $tmpDetail['seq'] = $seq;
                $tmpDetail['status'] = 'create';

                SensoryDetail::create($tmpDetail);
                
            }else{
                $sensoryDetail->status = $seq;
                $sensoryDetail->status = 'create';

                $sensoryDetail->save();
            }
            $seq++;
        }
        return redirect('/sensory/submitTest/' . $id);
    }

    public function submitTest($id)
    {
        $sensorymaster = SensoryMaster::findOrFail($id);

        return view('sensory-masters.submit', compact('sensorymaster'));
    }

    public function submitTestAction(Request $request,$id)
    {
        $sensorymaster = SensoryMaster::findOrFail($id);
        $sensorymaster->status = 'ready';
        $sensorymaster->save();

        $requestData = $request->all();
        foreach ($requestData['detail'] as $key => $value) {
            $tmp = SensoryDetail::findOrFail($key);
            $value['status'] = 'ready';
            $tmp->update($value);
        }

        return redirect('sensory-masters')->with('flash_message', ' พร้อมใช้ทดสอบ!');
    }

    public function startTest($id){
        $sensorymaster = SensoryMaster::findOrFail($id);
        $sensorymaster->status = 'testing';
        $sensorymaster->save();

        foreach ($sensorymaster->sensoryDetail as $key => $value) {
            $tmpD = SensoryDetail::findOrFail($value->id);
            $tmpD->status = 'testing';
            $tmpD->save();
        }
        return redirect('sensory-masters')->with('flash_message', ' เริ่ม Testing!');
    }

    public function stopTest($id)
    {
        $sensorymaster = SensoryMaster::findOrFail($id);
        $sensorymaster->status = 'stop';
        $sensorymaster->save();

        foreach ($sensorymaster->sensoryDetail as $key => $value) {
            $tmpD = SensoryDetail::findOrFail($value->id);
            $tmpD->status = 'stop';
            $tmpD->save();
        }
        return redirect('sensory-masters')->with('flash_message', ' เริ่ม Testing!');
    }

    public function endTest($id)
    {
        $sensorymaster = SensoryMaster::findOrFail($id);
        $sensorymaster->status = 'end';
        $sensorymaster->save();

        foreach ($sensorymaster->sensoryDetail as $key => $value) {
            $tmpD = SensoryDetail::findOrFail($value->id);
            $tmpD->status = 'end';
            $tmpD->save();
        }
        return redirect('sensory-masters')->with('flash_message', ' จบการทดสอบ!');
    }


    public function printform($id)
    {
        $sensorymaster = SensoryMaster::findOrFail($id);
        return view('sensory-masters.printform', compact('sensorymaster'));
    }
}


