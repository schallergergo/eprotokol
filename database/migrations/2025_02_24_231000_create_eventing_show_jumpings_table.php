<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventingShowJumpingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventing_show_jumpings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("start_id");
            $table->float("time")->nullable();
            $table->float("obstacle_fault")->nullable();
            $table->float("time_fault")->nullable();
            $table->float("total_fault")->nullable();
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
        Schema::dropIfExists('eventing_show_jumpings');
    }
}
