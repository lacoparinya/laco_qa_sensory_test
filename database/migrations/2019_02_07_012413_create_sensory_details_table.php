<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensoryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensory_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sensory_master_id');
            $table->integer('qa_sample_data_id');
            $table->integer('seq');
            $table->string('code');
            $table->integer('time');
            $table->text('note');
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
        Schema::dropIfExists('sensory_details');
    }
}
