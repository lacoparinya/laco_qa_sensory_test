<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use App\QaSampleData;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class QaSampleDatasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
            $qasampledatas = QaSampleData::latest()->paginate($perPage);
        } else {
            $qasampledatas = QaSampleData::latest()->paginate($perPage);
        }

        return view('qa-sample-datas.index', compact('qasampledatas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('qa-sample-datas.create');
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

        QaSampleData::create($requestData);

        return redirect('qa-sample-datas')->with('flash_message', ' added!');
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
        $qasampledata = QaSampleData::findOrFail($id);

        return view('qa-sample-datas.show', compact('qasampledata'));
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
        $qasampledata = QaSampleData::findOrFail($id);

        return view('qa-sample-datas.edit', compact('qasampledata'));
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

        $qasampledata = QaSampleData::findOrFail($id);
        $qasampledata->update($requestData);

        return redirect('qa-sample-datas')->with('flash_message', ' updated!');
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
        QaSampleData::destroy($id);

        return redirect('qa-sample-datas')->with('flash_message', ' deleted!');
    }

    public function upload(){

        return view('qa-sample-datas.upload');
    }

    public function uploadAction(Request $request){

        $path = $request->file('uploadfile')->store('xls');

        $storagePath = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();

       Excel::selectSheets('Sheet1')->load($storagePath . $path,function($reader){

            $mapping = array(
                'รหัสผลิตภัณฑ์' => 'product_code',
                'วันที่เก็บผลิตภัณฑ์:กะ' => 'storedate_shift',
                ' Codeลำดับการส่งตัวอย่าง' => 'seq_sample_code',
                'วันที่ตรวจสอบ' => 'test_date',
                'Sampl' => 'sample_date',
                'สุ่มครั้งที่ ' => 'sample_time',
                'Product' => 'product_name',
                'Month' => 'month',
                'ผลิตภัณฑ์' => 'product_group',
                'เขต' => 'broker_Code',
                'ลูกสวน' => 'farmer_name',
                'วันที่ผลิต' => 'produce_date',
                'เวลาสุ่ม' => 'sample_r_time',
                'หมายเลขกล่อง' => 'box_number',
                'TPC (cfu./g.)' => 'tpc_m',
                'TPC' => 'tpc_d',
                'x' => 'code_x',
                'Dilution' => 'Dilution',
                'Power' => 'power',
                'Coliform 10 time dilution (colonies) ' => 'colonies',
                'Coliform' => 'coliform',
                'x2' => 'code_x2',
                'Dilution2' => 'Dilution2',
                'Power2' => 'power2',
                'Coliform 10 time dilution (colonies) 2' => 'colonies2',
                'E.coli (MPN/g.)' => 'e_coli',
                'Yeast (cfu./0.1g.)' => 'yeast',
                'Mold (cfu./0.1g.)' => 'mold',
                '% salt (pod)' => 'salt_pod',
                '% salt (kernel)' => 'salt_kernel',
                '% salt ' => 'salt_percent',
                'pH สีเข้ม' => 'ph_dark',
                'pH สีอ่อน' => 'ph_light',
                'pH' => 'ph',
                'pH (Kernel)' => 'ph_kernel',
                'TSS สีเข้ม' => 'tss_dark',
                'TSS สีอ่อน' => 'tss_light',
                'TSS' => 'tss',
                'TSS (Kernel)' => 'tss_kernel',
                '% TA สีเข้ม' => 'ta_dark',
                '% TA สีอ่อน' => 'ta_light',
                '% TA' => 'ta',
                'Hardness' => 'ta_light',
                'Viscosity' => 'viscosity',
                'Spec IGSBFR : Salt Kernel <0.8%' => '',
                'Spec IGSBFR : TSS 5.0-10.0' => '',
                'Spec IGSBFR : pH 6.5-7.5' => '',
                'Spec IGSBFR : %MC <2%' => '',
                'Spec IGSBFR: Foreign substances 0%' => '',
                'Spec IGSBFR : Whole Bean <10 %' => '',
                'Spec IGSBFR : Inner film bean <2 %' => '',
                'Spec IGSBFR : Broken Half <15 %' => '',
                'Spec IGSBFR : Viscosity' => '',
                'IMAND25, MANMD25 : < 20 mm. (%)' => '',
                'IMAND25, MANMD25 : > 35 mm.(%) ' => '',
                'IMAND25, MANMD25 : 20-35 mm.(%)' => '',
                'IMAMD10 : < 10 mm.(%)' => '',
                ' IMAMD10 : > 10 mm.(%) ' => '',
                ' IMAMD10 : 10 mm.(%)' => '',
                'Sensory test' => '',
                'Sensory test ซ้ำ' => '',
                'Enzyme peroxidase : Solid' => '',
                'Enzyme peroxidase : Liquid' => '',
                'หมายเลขพาเลท' => 'pallet_code',
                'Line' => 'line',
                'Hr ที่' => 'hr',
                'หมายเหตุ ' => 'note',
                'สถานะผลิตภัณฑ์' => 'status',
            );

            $reader->each(function ($tmpdata) use ($mapping) {
        
                $saveTmp = array(); 
                 foreach ($tmpdata as $key => $value) {

                  if(isset($mapping[$key])){
                       $mapKey = $mapping[$key];
                       
                       if(!empty($mapKey)){
                            $value = str_replace("'","",$value);

                            if($value == "-" or $value == ""){
                                $saveTmp[$mapKey] = null;
                            }elseif(strpos($value,"<") !== false){
                                $saveTmp[$mapKey] = -1*$value;
                            } else {
                                $saveTmp[$mapKey] = $value;
                            }
                            
                       }
                    }
                }
                $chkData = QaSampleData::where('product_code', $saveTmp['product_code'])->first();
                if(!empty($chkData)){
                    $chkData->update($saveTmp);
                }else{
                    QaSampleData::create($saveTmp);
                }
            });
            
       }, 'windows-874');

        return redirect('qa-sample-datas');
    }
}
