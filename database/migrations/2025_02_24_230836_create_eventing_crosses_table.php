<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventingCrossesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventing_crosses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("start_id");
            $table->float("time")->nullable();
            $table->float("obstacle_fault")->nullable();
            $table->float("time_fault")->nullable();
            $table->float("total_fault")->nullable();
            $table->float("time_allowed_difference")->default(0);
            $table->string("comments")->nullable();
            $table->boolean("completed")->default(false);
            $table->boolean("eliminated")->default(false);
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
        Schema::dropIfExists('eventing_crosses');
    }
}
