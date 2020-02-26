<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestSuitMsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_suit_ms', function (Blueprint $table) {
            $table->increments('id');
            $table->date('test_date');
            $table->string('test_set',50)->nullable();
            $table->string('name',100);
            $table->string('details', 255)->nullable();
            $table->string('status',50);
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
        Schema::dropIfExists('test_suit_ms');
    }
}
