<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('styles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("start_id");
            $table->float("time")->nullable();
            $table->float("total_fault")->nullable();
            $table->float("given_mark")->nullable();
            $table->float("deductions")->nullable();
            $table->float("total_mark")->nullable();
            $table->string("comments")->nullable();
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
        Schema::dropIfExists('styles');
    }
}
