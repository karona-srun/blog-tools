<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->longText('title');
            $table->longText('summary')->nullable();
            $table->longText('body');
            $table->boolean('status')->default(1);
            $table->integer('viewer')->nullable();
            $table->string('pic')->nullable();
            $table->string('path')->nullable();
            $table->integer('creator')->nullable();
            $table->integer('updator')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('blogs');
    }
}
