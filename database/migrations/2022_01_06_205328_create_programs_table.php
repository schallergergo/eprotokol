<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('discipline', ['lovastusa', 'dijlovas','poniklub', 'lovastorna',"fogat"]);
            $table->string('name');
            $table->integer('numofblocks');
            $table->integer('maxMark');
            $table->enum('typeofevent', ['normal','osszevont'])->default("normal");
            $table->boolean('doublesided');
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('programs');
    }
}
