<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();
            $table->unsignedBigInteger('start_id');
            $table->unsignedBigInteger('penciler');
            $table->string('position');
            $table->json('assessment')->nullable();
            $table->float('mark')->default(0);
            $table->float('percent')->default(0);
            $table->float('collective')->default(0);
            $table->float('error')->default(0);
            $table->boolean('eliminated')->default(0);
            $table->smallInteger('completed')->default(0);
            $table->boolean('printed')->default(0);
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
        Schema::dropIfExists('results');
    }
}
