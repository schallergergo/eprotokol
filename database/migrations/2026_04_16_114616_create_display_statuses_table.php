<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisplayStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('display_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("competition_id");
            $table->unsignedBigInteger("event_id")->nullable();
            $table->string("event_name")->nullable();
            $table->string("display")->default('default');
            $table->string('title')->nullable();
            $table->string('message')->nullable();
            $table->json('completed_data')->nullable();
            $table->json('pending_data')->nullable();
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
        Schema::dropIfExists('display_statuses');
    }
}
