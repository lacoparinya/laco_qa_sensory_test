<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\DB;
use App\SensoryMaster;

class ReportsController extends Controller
{
    public function summaryreport($testId){

        $masterData = SensoryMaster::findOrFail($testId);

        $summaryData = DB::table('sensory_test_ms')
            ->leftJoin('sensory_test_ds', 'sensory_test_ms.id', '=', 'sensory_test_ds.sensory_test_ms_id')
            ->leftJoin('sensory_masters', 'sensory_masters.id', '=', 'sensory_test_ms.sensory_master_id')
            ->leftJoin('qa_sample_sensories', 'qa_sample_sensories.id', '=', 'sensory_test_ds.qa_sample_data_id')
            ->leftJoin('sensory_details', 'sensory_details.id', '=', 'sensory_test_ds.sensory_detail_id')
            ->select(
                'sensory_details.code',
                'qa_sample_sensories.product_name',
                DB::raw('SUM(sensory_test_ds.color) as sum_color'),
                DB::raw('SUM(sensory_test_ds.odor) as sum_odor'),
                DB::raw('SUM(sensory_test_ds.texture) as sum_texture'),
                DB::raw('SUM(sensory_test_ds.taste) as sum_taste'),
                DB::raw('SUM(sensory_test_ds.color)/count(sensory_test_ms.tester_name) as avg_color'),
                DB::raw('SUM(sensory_test_ds.odor)/count(sensory_test_ms.tester_name) as avg_odor'),
                DB::raw('SUM(sensory_test_ds.texture)/count(sensory_test_ms.tester_name) as avg_texture'),
                DB::raw('SUM(sensory_test_ds.taste)/count(sensory_test_ms.tester_name) as avg_taste'),
                DB::raw('count(sensory_test_ms.tester_name) as number_tester')
            )->where('sensory_masters.id', $testId)->groupBy('sensory_details.code', 'qa_sample_sensories.product_name')->get();

        return view('reports.summaryreport', compact('masterData', 'summaryData'));
    }

    public function xlsreport($testId){
        $masterData = SensoryMaster::findOrFail($testId);

        $summaryData = DB::table('sensory_test_ms')
            ->leftJoin('sensory_test_ds', 'sensory_test_ms.id', '=', 'sensory_test_ds.sensory_test_ms_id')
            ->leftJoin('sensory_masters', 'sensory_masters.id', '=', 'sensory_test_ms.sensory_master_id')
            ->leftJoin('qa_sample_sensories', 'qa_sample_sensories.id', '=', 'sensory_test_ds.qa_sample_data_id')
            ->leftJoin('sensory_details', 'sensory_details.id', '=', 'sensory_test_ds.sensory_detail_id')
            ->select(
                'sensory_details.code',
                'qa_sample_sensories.product_name',
                'qa_sample_sensories.order_no_loading_date',
                'qa_sample_sensories.lot_batch',
                'qa_sample_sensories.exp_date',
                DB::raw('SUM(sensory_test_ds.color) as sum_color'),
                DB::raw('SUM(sensory_test_ds.odor) as sum_odor'),
                DB::raw('SUM(sensory_test_ds.texture) as sum_texture'),
                DB::raw('SUM(sensory_test_ds.taste) as sum_taste'),
                DB::raw('SUM(sensory_test_ds.color)/count(sensory_test_ms.tester_name) as avg_color'),
                DB::raw('SUM(sensory_test_ds.odor)/count(sensory_test_ms.tester_name) as avg_odor'),
                DB::raw('SUM(sensory_test_ds.texture)/count(sensory_test_ms.tester_name) as avg_texture'),
                DB::raw('SUM(sensory_test_ds.taste)/count(sensory_test_ms.tester_name) as avg_taste'),
                DB::raw('((SUM(sensory_test_ds.color) + SUM(sensory_test_ds.odor)+ SUM(sensory_test_ds.texture) + SUM(sensory_test_ds.taste))/count(sensory_test_ms.tester_name))/4 as avg_all'),

                DB::raw('count(sensory_test_ms.tester_name) as number_tester')
            )->where('sensory_masters.id', $testId
            )->groupBy(
                'sensory_details.code', 
                'qa_sample_sensories.product_name', 
                'qa_sample_sensories.order_no_loading_date',
                'qa_sample_sensories.lot_batch',
                'qa_sample_sensories.exp_date'
            )->get();

        $detailData = DB::table('sensory_test_ms')
            ->leftJoin('sensory_test_ds', 'sensory_test_ms.id', '=', 'sensory_test_ds.sensory_test_ms_id')
            ->leftJoin('sensory_masters', 'sensory_masters.id', '=', 'sensory_test_ms.sensory_master_id')
            ->leftJoin('qa_sample_sensories', 'qa_sample_sensories.id', '=', 'sensory_test_ds.qa_sample_data_id')
            ->leftJoin('sensory_details', 'sensory_details.id', '=', 'sensory_test_ds.sensory_detail_id')
            ->select(
                'sensory_details.code',
                'qa_sample_sensories.product_name',
                'qa_sample_sensories.order_no_loading_date',
                'qa_sample_sensories.lot_batch',
                'qa_sample_sensories.exp_date',
                'sensory_test_ds.color',
                'sensory_test_ds.odor',
                'sensory_test_ds.texture',
                'sensory_test_ds.taste'
            )->where('sensory_masters.id', $testId)->get();

        $detailSummary = array();
        foreach ($detailData as $key => $value) {
            if(isset($detailSummary[$value->code])){
                $detailSummary[$value->code]['count'] += 1;
                if ($value->color == 1 || $value->color == 5) {
                    $detailSummary[$value->code]['color']['fail'] += 1;

                    $detailSummary[$value->code]['all']['fail'] += 1;


                } else {
                    $detailSummary[$value->code]['color']['pass'] += 1;

                    $detailSummary[$value->code]['all']['pass'] += 1;
                }
                if ($value->odor == 1 || $value->odor == 5) {
                    $detailSummary[$value->code]['odor']['fail'] += 1;

                    $detailSummary[$value->code]['all']['fail'] += 1;
                } else {
                    $detailSummary[$value->code]['odor']['pass'] += 1;

                    $detailSummary[$value->code]['all']['pass'] += 1;
                }
                if ($value->texture == 1 || $value->texture == 5) {
                    $detailSummary[$value->code]['texture']['fail'] += 1;

                    $detailSummary[$value->code]['all']['fail'] += 1;
                } else {
                    $detailSummary[$value->code]['texture']['pass'] += 1;

                    $detailSummary[$value->code]['all']['pass'] += 1;
                }
                if ($value->taste == 1 || $value->taste == 5) {
                    $detailSummary[$value->code]['taste']['fail'] += 1;

                    $detailSummary[$value->code]['all']['fail'] += 1;
                } else {
                    $detailSummary[$value->code]['taste']['pass'] += 1;

                    $detailSummary[$value->code]['all']['pass'] += 1;
                }
            }else{
                $detailSummary[$value->code]['count'] = 1;
                if($value->color == 1 || $value->color == 5){
                    $detailSummary[$value->code]['color']['pass'] = 0;
                    $detailSummary[$value->code]['color']['fail'] = 1;

                    $detailSummary[$value->code]['all']['pass'] = 0;
                    $detailSummary[$value->code]['all']['fail'] = 1;
                }else{
                    $detailSummary[$value->code]['color']['pass'] = 1;
                    $detailSummary[$value->code]['color']['fail'] = 0;

                    $detailSummary[$value->code]['all']['pass'] = 1;
                    $detailSummary[$value->code]['all']['fail'] = 0;
                }
                if ($value->odor == 1 || $value->odor == 5) {
                    $detailSummary[$value->code]['odor']['pass'] = 0;
                    $detailSummary[$value->code]['odor']['fail'] = 1;

                    $detailSummary[$value->code]['all']['fail'] += 1;
                } else {
                    $detailSummary[$value->code]['odor']['pass'] = 1;
                    $detailSummary[$value->code]['odor']['fail'] = 0;

                    $detailSummary[$value->code]['all']['pass'] += 1;
                }
                if ($value->texture == 1 || $value->texture == 5) {
                    $detailSummary[$value->code]['texture']['pass'] = 0;
                    $detailSummary[$value->code]['texture']['fail'] = 1;

                    $detailSummary[$value->code]['all']['fail'] += 1;
                } else {
                    $detailSummary[$value->code]['texture']['pass'] = 1;
                    $detailSummary[$value->code]['texture']['fail'] = 0;

                    $detailSummary[$value->code]['all']['pass'] += 1;
                }
                if ($value->taste == 1 || $value->taste == 5) {
                    $detailSummary[$value->code]['taste']['pass'] = 0;
                    $detailSummary[$value->code]['taste']['fail'] = 1;

                    $detailSummary[$value->code]['all']['fail'] += 1;
                } else {
                    $detailSummary[$value->code]['taste']['pass'] = 1;
                    $detailSummary[$value->code]['taste']['fail'] = 0;

                    $detailSummary[$value->code]['all']['pass'] += 1;
                }
            }

            $percent = ($detailSummary[$value->code]['taste']['fail']/ $detailSummary[$value->code]['count'])*100;

            if($percent < 20){
                $detailSummary[$value->code]['result'] = 'Pass';
            }else{
                $detailSummary[$value->code]['result'] = 'Fail';
            }
            
        }

        $filename = "qa_sensory_report_" . $testId . date('ymdHi');

        Excel::create($filename, function ($excel) use ($masterData, $summaryData, $detailSummary) {
            $excel->sheet('clients', function ($sheet) use ($masterData, $summaryData, $detailSummary) {
                $sheet->setOrientation('landscape')->loadView('reports.xlssummaryreport')->with('masterData', $masterData)->with('summaryData', $summaryData)->with('detailSummary', $detailSummary);
            });
        })->export('xlsx');

        //return view('reports.xlssummaryreport', compact('masterData', 'summaryData', 'detailSummary'));
    }
}
