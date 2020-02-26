<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestSuitDsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_suit_ds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_suit_m_id');
            $table->string('code',20);
            $table->string('details',100)->nullable();
            $table->integer('seq');
            $table->integer('ans');
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
        Schema::dropIfExists('test_suit_ds');
    }
}
