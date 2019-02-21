<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQaSampleSensoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qa_sample_sensories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('run_number','50');
            $table->date('sampling_date');
            $table->string('sampling_no', '20');
            $table->string('product_name', '50');
            $table->string('customer_farmer', '50');
            $table->string('order_no_loading_date', '100');
            $table->date('mfg_date');
            $table->date('exp_date');
            $table->string('lot_batch', '20');
            $table->string('product_details', '150');
            $table->string('carton_no', '20');
            $table->string('pallet_no', '30');
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
        Schema::dropIfExists('qa_sample_sensories');
    }
}
