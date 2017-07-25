<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTtnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ttns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('recipient_id');
            $table->integer('from_department_id');
            $table->integer('to_department_id');
            $table->integer('from_location_id');
            $table->integer('to_location_id');
            $table->integer('track_id')->nullable();
            $table->string('weight')->nullable();
            $table->string('width')->nullable();
            $table->string('depth')->nullable();
            $table->string('height')->nullable();
            $table->string('price');
            $table->enum('status', ['new', 'in_progress', 'completed']);
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
        Schema::dropIfExists('ttns');
    }
}
