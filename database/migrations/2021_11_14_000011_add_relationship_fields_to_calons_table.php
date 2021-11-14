<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCalonsTable extends Migration
{
    public function up()
    {
        Schema::table('calons', function (Blueprint $table) {
            $table->unsignedBigInteger('paslon_id')->nullable();
            $table->foreign('paslon_id', 'paslon_fk_5337636')->references('id')->on('paslons');
        });
    }
}
