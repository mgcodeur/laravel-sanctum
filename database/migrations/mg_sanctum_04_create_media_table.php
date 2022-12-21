<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('media', function(Blueprint $table) {
           $table->id();
           $table->morphs('mediable');
           $table->string('name');
           $table->string('group')->nullable();
           $table->string('disk')->nullable();
           $table->string('size')->nullable(); //large, medium, thumbnail
           $table->string('full_path')->nullable();
           $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('media');
    }
};
