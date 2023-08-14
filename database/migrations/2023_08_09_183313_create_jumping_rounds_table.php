<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJumpingRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jumping_rounds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("start_id");
            $table->float("time1")->nullable();
            $table->float("obstacle_fault1")->nullable();
            $table->float("time_fault1")->nullable();
            $table->float("total_fault1")->nullable();
            $table->string("comments1")->nullable();

            $table->float("time2")->nullable();
            $table->float("obstacle_fault2")->nullable();
            $table->float("time_fault2")->nullable();
            $table->float("total_fault2")->nullable();
            $table->string("comments2")->nullable();


            $table->boolean("completed")->default(0);
            $table->boolean("eliminated")->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jumping_rounds');
    }
}
