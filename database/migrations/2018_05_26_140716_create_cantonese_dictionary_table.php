<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCantoneseDictionaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cantonese', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('english');
            $table->string('jyutping');
            $table->string('cantonese');
            $table->integer('soundAddress');
            $table->integer('type');
            $table->integer('user_id');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Cantonese');

    }
}
