<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('status') ;
            $table->text('title')->nullable();
//            $table->unsignedBigInteger('title_length')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('has_canonical');
//            $table->string('html_size')->nullable();
            $table->foreignId('site_id')->constrained();

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
        Schema::dropIfExists('pages');
    }
};
