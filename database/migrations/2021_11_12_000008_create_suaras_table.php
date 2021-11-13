<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuarasTable extends Migration
{
    public function up()
    {
        Schema::create('suaras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
