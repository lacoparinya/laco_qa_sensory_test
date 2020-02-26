<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnsSuitDsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ans_suit_ds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ans_suit_m_id');
            $table->integer('test_suit_d_id');
            $table->integer('value');
            $table->string('comments',255)->nullable();
            $table->string('result', 20)->nullable();
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
        Schema::dropIfExists('ans_suit_ds');
    }
}
