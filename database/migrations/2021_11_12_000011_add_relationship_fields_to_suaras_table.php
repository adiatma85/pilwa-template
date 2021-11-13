<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSuarasTable extends Migration
{
    public function up()
    {
        Schema::table('suaras', function (Blueprint $table) {
            $table->unsignedBigInteger('calon_id')->nullable();
            $table->foreign('calon_id', 'calon_fk_5325718')->references('id')->on('calons');
            $table->unsignedBigInteger('peserta_id')->nullable();
            $table->foreign('peserta_id', 'peserta_fk_5325719')->references('id')->on('peserta');
        });
    }
}
