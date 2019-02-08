<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQaSampleDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qa_sample_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_code',50);
            $table->string('storedate_shift',50);
            $table->string('seq_sample_code',10);
            $table->date('test_date');
            $table->date('sample_date');
            $table->integer('sample_time');
            $table->string('product_name',50);
            $table->string('month',10);
            $table->string('product_group',50);
            $table->string('broker_Code',20);
            $table->string('farmer_name',100);
            $table->string('produce_date',100);
            $table->string('sample_r_time',30);
            $table->string('box_number',50);
            $table->float('tpc_m'); //-1 x =  < 
            $table->float('tpc_d');
            $table->string('code_x', 5);
            $table->integer('Dilution');
            $table->integer('power');
            $table->integer('colonies'); //-1 = รอผล
            $table->string('e_coli', 50);
            $table->integer('yeast');
            $table->integer('mold');
            $table->float('salt_pod');
            $table->float('salt_kernel');
            $table->float('salt_percent');
            $table->float('ph_dark');
            $table->float('ph_light');
            $table->float('ph');
            $table->float('ph_kernel');
            $table->float('tss_dark');
            $table->float('tss_light');
            $table->float('tss');
            $table->float('tss_kernel');
            $table->float('ta_dark');
            $table->float('ta_light');
            $table->float('ta');
            $table->float('hardness');
            $table->float('viscosity');
            $table->string('pallet_code', 50);
            $table->string('line', 10);
            $table->string('hr', 50);
            $table->string('status', 100);
            $table->text('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qa_sample_datas');
    }
}
