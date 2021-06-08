<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummaryProgress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summary_progress', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('program_id')->unsigned();
            $table->foreign('program_id')->references('id')->on('summary_program')->onDelete('cascade');
            $table->string('rencana_aksi');
            $table->string('progress')->nullable();
            $table->string('pic');
            $table->date('due_date');
            $table->string('evidence')->nullable();
            $table->string('witel', 255);
            $table->string('note')->nullable();
            $table->string('progress_status')->default('berjalan');
            $table->date('progress_update')->nullable();
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
        Schema::dropIfExists('summary_progress');
    }
}
