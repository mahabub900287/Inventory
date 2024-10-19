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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('sku')->unique();
            $table->json('type')->nullable();
            $table->string('prepacked')->default(0);
            $table->json('prepacked_metarial')->nullable();
            $table->string('weight');
            $table->string('stock')->default(0);
            $table->string('barcode_type')->comment('Code-128/EAN-13/GS1-128/QR-Code')->nullable();;
            $table->string('barcode_number')->nullable();
            $table->text('description')->nullable();
            $table->string('tariff_number');
            $table->string('country_id');
            $table->string('item_type', 50)->default('product');
            $table->string('status', 50)->default('inactive');
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
        Schema::dropIfExists('products');
    }
};
