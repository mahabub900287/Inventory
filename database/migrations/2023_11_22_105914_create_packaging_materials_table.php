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
        Schema::create('packaging_materials', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('sku')->unique();
            $table->string('type', 50);
            $table->json('masurement')->nullable();
            $table->text('description');
            // $table->string('barcode_type')->comment('Code-128/EAN-13/GS1-128/QR-Code');
            // $table->string('barcode_number')->unique();
            $table->string('reorder_point')->nullable();
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
        Schema::dropIfExists('packaging_materials');
    }
};
