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
        Schema::create('table_hoadon', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tenkhachhang');
            $table->string('sdt');
            $table->string('email');
            $table->double('tongtieng');
            $table->timestamps();
        });

        Schema::create('table_chitiethoadon', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_hoadon'); // Tạo trường id_hoadon để làm foreign key
            $table->string('ten');
            $table->integer('soluong');
            $table->double('gia');
            $table->timestamps();

            // Đặt tên foreign key constraint là id_hoadon và thiết lập onDelete('cascade')
            $table->foreign('id_hoadon')
                ->references('id')
                ->on('table_hoadon')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_hoadon');
    }
};
