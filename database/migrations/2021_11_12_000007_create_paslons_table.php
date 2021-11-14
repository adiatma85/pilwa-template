<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaslonsTable extends Migration
{
    public function up()
    {
        Schema::create('paslons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('visi')->nullable();
            $table->longText('misi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
