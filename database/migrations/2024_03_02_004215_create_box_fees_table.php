<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_fees', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->unsignedBigInteger('competition_id');
            $table->string('rider_id');
            $table->string('rider_name');
            $table->string('horse_id');
            $table->string('horse_name');
            $table->string('club');
            $table->string("amount");
            $table->boolean("paid")->default(false);
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
        Schema::dropIfExists('box_fees');
    }
}
