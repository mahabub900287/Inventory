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
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users', 'id')->onDelete('set null');
            $table->string('street')->nullable();
            $table->string('phone')->nullable();
            $table->string('additional')->nullable();
            $table->string('post_code');
            $table->string('city');
            $table->string('state');
            $table->string('company_name');
            $table->string('company_email');
            $table->string('company_phone');
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
        Schema::dropIfExists('customer_addresses');
    }
};
