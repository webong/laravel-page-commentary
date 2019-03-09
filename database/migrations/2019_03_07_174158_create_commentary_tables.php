<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentaryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentary_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('path');
            $table->timestamps();
        });

        Schema::create('commentary_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('commentary_page_id');
            $table->text('username');
            $table->text('text');
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
        Schema::dropIfExists('commentary_comments');
    }
}
