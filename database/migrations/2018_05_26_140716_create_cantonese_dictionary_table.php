<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToWords extends Migration
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
            $table->rememberToken();
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
        Schema::table('Cantonese', function ($table){
            $table->dropColumn('user_id');
        });    }
}
