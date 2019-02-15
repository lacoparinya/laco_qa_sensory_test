<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\SensoryMaster;

class ReportsController extends Controller
{
    public function summaryreport($testId){

        $masterData = SensoryMaster::findOrFail($testId);

        $summaryData = DB::table('sensory_test_ms')
            ->leftJoin('sensory_test_ds', 'sensory_test_ms.id', '=', 'sensory_test_ds.sensory_test_ms_id')
            ->leftJoin('sensory_masters', 'sensory_masters.id', '=', 'sensory_test_ms.sensory_master_id')
            ->leftJoin('qa_sample_datas', 'qa_sample_datas.id', '=', 'sensory_test_ds.qa_sample_data_id')
            ->leftJoin('sensory_details', 'sensory_details.id', '=', 'sensory_test_ds.sensory_detail_id')
            ->select(
                'sensory_details.code',
                'qa_sample_datas.product_group',
                DB::raw('SUM(sensory_test_ds.color) as sum_color'),
                DB::raw('SUM(sensory_test_ds.odor) as sum_odor'),
                DB::raw('SUM(sensory_test_ds.texture) as sum_texture'),
                DB::raw('SUM(sensory_test_ds.taste) as sum_taste'),
                DB::raw('SUM(sensory_test_ds.color)/count(sensory_test_ms.tester_name) as avg_color'),
                DB::raw('SUM(sensory_test_ds.odor)/count(sensory_test_ms.tester_name) as avg_odor'),
                DB::raw('SUM(sensory_test_ds.texture)/count(sensory_test_ms.tester_name) as avg_texture'),
                DB::raw('SUM(sensory_test_ds.taste)/count(sensory_test_ms.tester_name) as avg_taste'),
                DB::raw('count(sensory_test_ms.tester_name) as number_tester')
            )->where('sensory_masters.id', $testId)->groupBy('sensory_details.code', 'qa_sample_datas.product_group')->get();

        return view('reports.summaryreport', compact('masterData', 'summaryData'));
    }
}
