<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Sponsor;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->integer('competition_id');
            $table->integer('program_id');
            $table->foreignIdFor(Sponsor::class)->default(1);
            $table->unsignedBigInteger('last_opened')->nullable();
            $table->json('active_events')->default("[]");
            $table->integer('rank')->default(0);
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
        Schema::dropIfExists('events');
    }
}
