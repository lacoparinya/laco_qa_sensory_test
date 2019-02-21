<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use App\QaSampleSensory;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

use Carbon\Carbon;


class QaSamplingsController extends Controller
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
            $qasamplings = QaSampleSensory::latest()->paginate($perPage);
        } else {
            $qasamplings = QaSampleSensory::latest()->paginate($perPage);
        }

        return view('qa-samplings.index', compact('qasamplings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('qa-samplings.create');
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

        QaSampleSensory::create($requestData);

        return redirect('qa-samplings')->with('flash_message', ' added!');
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
        $qasampling = QaSampleSensory::findOrFail($id);

        return view('qa-samplings.show', compact('qasampling'));
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
        $qasampling = QaSampleSensory::findOrFail($id);

        return view('qa-samplings.edit', compact('qasampling'));
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

        $qasamplingqasampling = QaSampleSensory::findOrFail($id);
        $qasampling->update($requestData);

        return redirect('qa-samplings')->with('flash_message', ' updated!');
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
        QaSampleSensory::destroy($id);

        return redirect('qa-samplings')->with('flash_message', ' deleted!');
    }

    public function upload()
    {

        return view('qa-samplings.upload');
    }

    public function uploadAction(Request $request)
    {

        $path = $request->file('uploadfile')->store('xls');

        $storagePath = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();

        Excel::selectSheets('Sheet1')->load($storagePath . $path, function ($reader) {

            $mapping = array(
                'Run Number' => 'run_number',
                'Sampling Date' => 'sampling_date',
                'Sampling No.' => 'sampling_no',
                'Product' => 'product_name',
                'Customer/Farmer' => 'customer_farmer',
                'Order No./Loading Date ' => 'order_no_loading_date',
                'Mfg. Date' => 'mfg_date',
                'Exp. Date' => 'exp_date',
                'Lot/Batch' => 'lot_batch',
                'Detail of Product ' => 'product_details',
                'Carton No.' => 'carton_no',
                'Pallet No.' => 'pallet_no',
            );

            $reader->formatDates(false)->each(function ($tmpdata) use ($mapping) {
                
                $saveTmp = array();
                foreach ($tmpdata as $key => $value) {

                    if (isset($mapping[$key])) {
                        $mapKey = $mapping[$key];

                        if (!empty($mapKey)) {
                            //$value = str_replace("'", "", $value);

                            if ($value == "-" or $value == "") {
                                $saveTmp[$mapKey] = null;
                            } elseif (strpos($value, "<") !== false) {
                                $saveTmp[$mapKey] = -1 * $value;
                            } else {
                                if($mapKey == 'sampling_date'){
                                    $value = Carbon::parse($value);
                                }
                                $saveTmp[$mapKey] = $value;
                            }

                        }
                    }
                }

                $chkData = QaSampleSensory::where('run_number', $saveTmp['run_number'])->first();
                if (!empty($chkData)) {
                    $chkData->update($saveTmp);
                } else {
                    QaSampleSensory::create($saveTmp);
                }
            });

        }, 'windows-874');

        return redirect('qa-samplings');
    }

}
