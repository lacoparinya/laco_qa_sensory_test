<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SensoryTestM;
use App\SensoryTestD;
use App\SensoryMaster;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SensoryTestsController extends Controller
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
            $sensorytests = SensoryTestM::latest()->paginate($perPage);
        } else {
            $sensorytests = SensoryTestM::latest()->paginate($perPage);
        }

        return view('sensory-tests.index', compact('sensorytests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('sensory-tests.create');
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

        SensoryTestM::create($requestData);

        return redirect('sensory-tests')->with('flash_message', ' added!');
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
        $sensorytest = SensoryTestM::findOrFail($id);

        return view('sensory-tests.show', compact('sensorytest'));
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
        $sensorytest = SensoryTestM::findOrFail($id);

        return view('sensory-tests.edit', compact('sensorytest'));
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

        $sensorytest = SensoryTestM::findOrFail($id);
        $sensorytest->update($requestData);

        return redirect('sensory-tests')->with('flash_message', ' updated!');
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
        SensoryTestM::destroy($id);

        return redirect('sensory-tests')->with('flash_message', ' deleted!');
    }

    public function runtest($id){
        $sensorymaster = SensoryMaster::findOrFail($id);

        return view('sensory-tests.runtest', compact('sensorymaster'));
    }

    public function runtestAction(Request $request, $id){
        $requestData = $request->all();
        $date = Carbon::now();

        $tmpSensoryTestM = array();
        $tmpSensoryTestM['sensory_master_id'] = $id;
        $tmpSensoryTestM['test_date'] = $date->format('Y-m-d');
        $tmpSensoryTestM['tester_name'] = $requestData['tester_name'];
        $tmpSensoryTestM['tester_note'] = $requestData['tester_note'];
        $tmpSensoryTestM['status'] = 'Tested';

        $sensoryTestMId = SensoryTestM::create($tmpSensoryTestM)->id;

        foreach ($requestData['test'] as $key => $value) {
            $tmpSensoryTestD = array();
            $tmpSensoryTestD['sensory_test_ms_id'] = $sensoryTestMId;
            $tmpSensoryTestD['sensory_detail_id'] = $key;
            $tmpSensoryTestD['qa_sample_data_id'] = $value['qasampleid'];
            $tmpSensoryTestD['sample_code'] = $value['txtcode'];
            $tmpSensoryTestD['product_code'] = $value['txtprod'];
            $tmpSensoryTestD['color'] = $value['color'];
            $tmpSensoryTestD['odor'] = $value['odor'];
            $tmpSensoryTestD['texture'] = $value['texture'];
            $tmpSensoryTestD['taste'] = $value['taste'];
            $tmpSensoryTestD['result'] = $value['hidden'];
            $tmpSensoryTestD['status'] = 'Tested';

            SensoryTestD::create($tmpSensoryTestD);
            
        }

        return redirect('/sensory/viewtest/'. $sensoryTestMId);

    }

    public function edittest($id)
    {
        $sensoryTestM = SensoryTestM::findOrFail($id);

        if($sensoryTestM->status == 'Lock'){
            return view('sensory-tests.thankyou', compact('sensoryTestM'));
        }

        return view('sensory-tests.viewtest', compact('sensoryTestM'));
    }

    public function edittestAction(Request $request, $id){

        $requestData = $request->all();

        $sensoryTestM = SensoryTestM::findOrFail($id);

        $sensoryTestM->test_date = $requestData['test_date'];
        $sensoryTestM->test_time = $requestData['test_time'];
        $sensoryTestM->sensory_name = $requestData['sensory_name'];
        $sensoryTestM->note = $requestData['note'];

        return redirect('/sensory/viewtest/' . $id);
    }

    public function viewtest($id)
    {
        $sensoryTestM = SensoryTestM::findOrFail($id);

        return view('sensory-tests.viewtest', compact('sensoryTestM'));
    }

    public function sendtest($id){
        $sensoryTestM = SensoryTestM::findOrFail($id);

        foreach ($sensoryTestM->sensoryTestD as $key => $value) {

            $sensoryTestD = SensoryTestD::findOrFail($value->id);

            $sensoryTestD->status = 'Lock';

            $sensoryTestD->save();

        }

        $sensoryTestM->status = 'Lock';

        $sensoryTestM->save();

        return view('sensory-tests.thankyou', compact('sensoryTestM'));

    }   
}
