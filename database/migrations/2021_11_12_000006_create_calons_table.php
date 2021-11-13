<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonsTable extends Migration
{
    public function up()
    {
        Schema::create('calons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('visi')->nullable();
            $table->string('misi')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
