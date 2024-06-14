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
          // one category has many foods
          Schema::create('categories', function(Blueprint $table){
            $table->increments('id'); //category's id
            $table->string('name'); // category's name
            $table->longText('description');
            $table->timestamps();
        });

        Schema::create('food', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('count')->nullable();
            $table->longText('description')->nullable();
            $table->double('gia');
            $table->timestamps();
            //foreign keys
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    //xoa bang nay nay may bang kia xoa theo
                    ->onDelete('cascade');
                  // xoa bang nay thi bang kia van khong bi xoa
                // ->onDelete('set null');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food');
    }
};
