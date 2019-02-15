<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateGifChunkFiveOOsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gif_five_hundy', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('gif_id',255);
            $table->string('embed_url',255);
            $table->string('title',255);
            $table->string('trending_datetime')->nullable();
            $table->dateTime('migration_date')->default(DB::raw('CURRENT_TIMESTAMP'))->index('migration_date');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gif_chunk_five_o_os');
    }
}
