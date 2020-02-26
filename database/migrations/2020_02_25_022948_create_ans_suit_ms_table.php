<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnsSuitMsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ans_suit_ms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_suit_m_id');
            $table->string('name',100);
            $table->string('comments',255)->nullable();
            $table->integer('resultrate')->nullable();
            $table->string('resulttxt', 100)->nullable();
            $table->string('status', 100);
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
        Schema::dropIfExists('ans_suit_ms');
    }
}
