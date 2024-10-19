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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->nullable()->constrained('ware_houses')->onDelete('cascade');
            $table->string('delivery_type')->comment('parcels/pallets');
            $table->boolean('product_type')->default(0)->comment('0 = product, 1 = bundle');
            $table->json('delivery_metarial')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('inbound')->default(false);
            $table->string('ref_number')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('sender_address')->nullable();
            $table->text('description')->nullable();
            $table->string('status', 50)->default('announced');
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
        Schema::dropIfExists('deliveries');
    }
};
