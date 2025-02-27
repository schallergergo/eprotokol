<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("start_id");
            $table->integer("fault")->default(0);
            $table->integer("completed_count")->default(0);
            $table->boolean("eliminated")->default(false);
            $table->integer("rank")->default(0);
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
        Schema::dropIfExists('eventings');
    }
}
