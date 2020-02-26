<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TestSuitM;
use App\TestSuitD;
use App\AnsSuitM;
use App\AnsSuitD;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TestSuitsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',
        ['except' => [
                'runtest',
                'runtestAction',
                'confirmtest',
                'confirmtestAction',
                'edittest',
                'edittestAction',
                'printform'
        ]]);
    }
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
            $testsuits = TestSuitM::latest()->paginate($perPage);
        } else {
            $testsuits = TestSuitM::latest()->paginate($perPage);
        }

        return view('test-suits.index', compact('testsuits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('test-suits.create');
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

        $requestData['status'] = 'Active';

        $testsuitmid = TestSuitM::create($requestData)->id;

        for ($i=1; $i <= 10; $i++) { 
            if(!empty($testsuitmid) && !empty($requestData['code'.$i]) && !empty($requestData['ans' . $i])){
                $tmpTestSuitD = array();
                $tmpTestSuitD['test_suit_m_id'] = $testsuitmid;
                $tmpTestSuitD['code'] = $requestData['code' . $i];
                $tmpTestSuitD['details'] = $requestData['desc' . $i];
                $tmpTestSuitD['seq'] = $i;
                $tmpTestSuitD['ans'] = $requestData['ans' . $i];

                TestSuitD::create($tmpTestSuitD);
            }
        }

        return redirect('test-suits')->with('flash_message', 'TestSuitM added!');
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
        $testsuit = TestSuitM::findOrFail($id);
        
        return view('test-suits.show', compact('testsuit'));
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
        $testsuit = TestSuitM::findOrFail($id);
        $testsuitds = array();
        foreach ($testsuit->testsuitdorderseq as $testsuitdobj) {
            $testsuitds[$testsuitdobj->seq] = $testsuitdobj;
        }
        return view('test-suits.edit', compact('testsuit', 'testsuitds'));
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
        
        $testsuit = TestSuitM::findOrFail($id);
        $testsuit->update($requestData);

        for ($i=1; $i <= 10; $i++) { 
            $chk = TestSuitD::where('test_suit_m_id',$id)
                        ->where('seq',$i)->first();

            if(empty($chk)){
                if (!empty($id) && !empty($requestData['code' . $i]) && !empty($requestData['ans' . $i])) {
                    $tmpTestSuitD = array();
                    $tmpTestSuitD['test_suit_m_id'] = $id;
                    $tmpTestSuitD['code'] = $requestData['code' . $i];
                    $tmpTestSuitD['details'] = $requestData['desc' . $i];
                    $tmpTestSuitD['seq'] = $i;
                    $tmpTestSuitD['ans'] = $requestData['ans' . $i];

                    TestSuitD::create($tmpTestSuitD);
                }
            }else{
                if (!empty($id) && !empty($requestData['code' . $i]) && !empty($requestData['ans' . $i])) {

                    $chk->code = $requestData['code' . $i];
                    $chk->details = $requestData['desc' . $i];
                    $chk->seq = $i;
                    $chk->ans = $requestData['ans' . $i];

                    $chk->update();
                }else{
                    $chk->delete();
                }
            }
        }

        return redirect('test-suits')->with('flash_message', 'TestSuitM updated!');
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
        TestSuitM::destroy($id);

        return redirect('test-suits')->with('flash_message', 'TestSuitM deleted!');
    }

    public function changeStatus($id,$status){
        $testsuit = TestSuitM::findOrFail($id);
        $testsuit->status = $status;
        $testsuit->update();

        return redirect('test-suits')->with('flash_message', 'TestSuitM deleted!');
    }

    public function runtest($test_suit_m_id){

        $testsuit = TestSuitM::findOrFail($test_suit_m_id);

        if($testsuit->status == 'testing'){

            return view('test-suits.runtest', compact('testsuit'));

        }else{
            return view('test-suits.stoptest', compact('testsuit'));
        }

    }

    public function runtestAction(Request $request, $test_suit_m_id){

        $testsuit = TestSuitM::findOrFail($test_suit_m_id);
        
        $requestData = $request->all();
        $requestData['test_suit_m_id'] = $test_suit_m_id;
        $requestData['status'] = 'Active';

        $anssuitmid = AnsSuitM::create($requestData)->id;

        if (!empty($anssuitmid)){
            foreach ($testsuit->testsuitdorderseq as $testsuitdobj) {
                $tmpAnsTestD = array();
                $tmpAnsTestD['ans_suit_m_id'] = $anssuitmid;
                $tmpAnsTestD['test_suit_d_id'] = $testsuitdobj->id;
                $tmpAnsTestD['value'] = $requestData['code-'. $testsuitdobj->id];
                $tmpAnsTestD['comments'] = '';
                $tmpAnsTestD['result'] = 'Incorrect';
                if($tmpAnsTestD['value'] == $testsuitdobj->ans){
                    $tmpAnsTestD['result'] = 'Correct';
                }
                AnsSuitD::create($tmpAnsTestD);
            }

            return redirect('test-suits/confirmtest/' . $anssuitmid)->with('flash_message', 'TestSuitM deleted!');
        }
    }

    public function confirmtest($ans_suit_m_id){
        $anssuit = AnsSuitM::findOrFail($ans_suit_m_id);

        $checkdup = true;
        $arraychk = array();
        foreach ($anssuit->anssuitd as $item) {
            if(isset($arraychk[$item->value])){
                $checkdup = false;
            }

            $arraychk[$item->value] = $item->id;
        }

        return view('test-suits.confirmtest', compact('anssuit', 'checkdup'));
    }

    public function confirmtestAction($ans_suit_m_id){

        $anssuit = AnsSuitM::findOrFail($ans_suit_m_id);

        $rate = 2/3;

        $resultRate = 0;
        $resultTxt = 'Fail';

        foreach ($anssuit->anssuitd as $anssuitdobj) {
            if($anssuitdobj->result == 'Correct'){
                $resultRate++;
            }
        }

        $checkRate = ($resultRate*100)/ $anssuit->anssuitd->count();

        if($checkRate >= $rate){
                $resultTxt = "Pass";
        }

        $anssuit->resultrate = $resultRate;
        $anssuit->resulttxt = $resultTxt;

        $anssuit->status = 'confirm';

        $anssuit->update();

        return view('test-suits.thankyou', compact('anssuit'));

    }

    public function edittest($ans_suit_m_id){

        $anssuit = AnsSuitM::findOrFail($ans_suit_m_id);
        $testsuit = $anssuit->testsuitm;

        $anssuitdlist =array();
        foreach ($anssuit->anssuitd as $anssuitdObj) {
            $anssuitdlist[$anssuitdObj->test_suit_d_id] = $anssuitdObj->value;
        }

        return view('test-suits.edittest', compact('testsuit', 'anssuit', 'anssuitdlist'));
    }

    public function edittestAction(Request $request, $ans_suit_m_id)
    {
        $requestData = $request->all();
        
        $anssuit = AnsSuitM::findOrFail($ans_suit_m_id);
        $anssuit->name =  $requestData['name'];
        $anssuit->status = 'Active';

        AnsSuitD::where('ans_suit_m_id', $ans_suit_m_id)->delete();

        foreach ($anssuit->testsuitm->testsuitdorderseq as $testsuitdobj) {
            $tmpAnsTestD = array();
            $tmpAnsTestD['ans_suit_m_id'] = $ans_suit_m_id;
            $tmpAnsTestD['test_suit_d_id'] = $testsuitdobj->id;
            $tmpAnsTestD['value'] = $requestData['code-' . $testsuitdobj->id];
            $tmpAnsTestD['comments'] = '';
            $tmpAnsTestD['result'] = 'Incorrect';
            if ($tmpAnsTestD['value'] == $testsuitdobj->ans) {
                $tmpAnsTestD['result'] = 'Correct';
            }

            AnsSuitD::create($tmpAnsTestD);
        }

        return redirect('test-suits/confirmtest/' . $ans_suit_m_id)->with('flash_message', 'TestSuitM deleted!');

    }

    public function showResult($test_suit_m_id){
        $data = DB::table('ans_suit_ms')
            ->leftJoin('test_suit_ms', 'test_suit_ms.id', '=', 'ans_suit_ms.test_suit_m_id')
            ->select('test_suit_ms.test_set','test_suit_ms.name', 'ans_suit_ms.resulttxt',DB::raw('count(ans_suit_ms.id) as count_result'))
            ->where('ans_suit_ms.test_suit_m_id', $test_suit_m_id)
            ->groupBy('test_suit_ms.test_set', 'test_suit_ms.name', 'ans_suit_ms.resulttxt')
            ->get();
        //var_dump($data);

        $data2 = TestSuitM::findOrFail($test_suit_m_id);

        //var_dump($data2);

        return view('test-suits.showresult', compact('data', 'data2'));
    }

    public function exportExcel($test_suit_m_id){
        $data = TestSuitM::findOrFail($test_suit_m_id);

        $filename = "qa_test_suit_report_" . $test_suit_m_id . date('ymdHi');

        Excel::create($filename, function ($excel) use ($data) {
            $excel->sheet('clients', function ($sheet) use ($data) {
                $sheet->setOrientation('landscape')->loadView('reports.xlstestsuit')->with('data', $data);
            });
        })->export('xlsx');
    }

    public function printform($id)
    {
       // $data = TestSuitM::findOrFail($test_suit_m_id);
        return view('test-suits.printform', compact('id'));
    }
}
