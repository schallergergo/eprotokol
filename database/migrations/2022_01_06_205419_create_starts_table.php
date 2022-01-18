<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class CreateStartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('starts', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();
            $table->unsignedBigInteger('event_id');
            $table->string('rider_id');
            $table->string('rider_name');
            $table->string('horse_id');
            $table->string('horse_name');
            $table->string('club');
            $table->string('category');
            $table->integer('rank')->default(0);
            $table->float('mark')->default(0);
            $table->float('percent')->default(0);
            $table->float('collective')->default(0);
            $table->boolean('completed')->default(0); 
            $table->boolean('public')->default(1); 
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
        Schema::dropIfExists('starts');
    }
}
