<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensoryTestMsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensory_test_ms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sensory_master_id');
            $table->date('test_date');
            $table->string('tester_name');
            $table->text('tester_note');
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
        Schema::dropIfExists('sensory_test_ms');
    }
}
