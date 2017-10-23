<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('description');
            $table->boolean('closed')->default(false);
            $table->boolean('public')->default(true);
            $table->unsignedInteger('capacity')->default(2);
            $table->unsignedInteger('users_count')->default(0);
            $table->unsignedInteger('creator_id');
            $table->unsignedInteger('language_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->timestamps();

            $table->foreign('creator_id')
                ->references('id')
                ->on('users');

            $table->foreign('language_id')
                ->references('id')
                ->on('languages')
                ->onDelete('set null');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channels');
    }
}
