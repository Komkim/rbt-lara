<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('author_id')->unsigned();
            $table->string('title');
            $table->string('description');
            $table->text('text');
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('authors');
        });
    }

    public function down()
    {
        Schema::dropIfExists('news');
    }
}
