<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('message_id');
            $table->foreign('message_id')
              ->references('id')
              ->on('messages')->onDelete('cascade');
              $table->bigInteger('room_id');
            $table->foreign('room_id')
              ->references('id')
              ->on('rooms')->onDelete('cascade');

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
        Schema::dropIfExists('rooms_messages');
    }
}
