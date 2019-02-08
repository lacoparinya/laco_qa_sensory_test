<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensoryTestDsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensory_test_ds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sensory_test_ms_id');
            $table->integer('sensory_detail_id');
            $table->integer('qa_sample_data_id');
            $table->string('sample_code',30);
            $table->string('product_code', 50);
            $table->smallInteger('color');
            $table->smallInteger('odor');
            $table->smallInteger('texture');
            $table->smallInteger('teste');
            $table->string('result', 100);
            $table->string('status', 20); 
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
        Schema::dropIfExists('sensory_test_ds');
    }
}
