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
        Schema::create('ware_houses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('name', 200);
            $table->string('serial_code')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('street')->nullable();
            $table->string('additional')->nullable();
            $table->string('post_code');
            $table->string('city');
            $table->string('state');
            $table->string('status', 50);
            $table->foreignId('created_by')->nullable()->constrained('users', 'id')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users', 'id')->onDelete('set null');
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
        Schema::dropIfExists('ware_houses');
    }
};
