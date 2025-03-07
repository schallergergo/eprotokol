<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventingExtraInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventing_extra_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("event_id");
            $table->text("description")->nullable();
            $table->integer("cross_time_allowed")->nullable();
            $table->integer("sj_time_allowed")->nullable();
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
        Schema::dropIfExists('eventing_extra_infos');
    }
}
