<?php

use App\Models\Shipment;
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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->nullable()->constrained('ware_houses')->onDelete('cascade');
            $table->foreignId('customer_address_id')->nullable()->constrained('customer_addresses')->onDelete('cascade');
            $table->boolean('preview_picks')->default(0);
            $table->string('order_number')->unique();;
            $table->string('type');
            $table->string('invoice_number')->unique();
            $table->string('type_of_good');
            $table->string('dhl_order')->nullable();
            $table->string('note')->nullable();
            $table->string('dhl_status', 50)->default('pendding');
            $table->string('status', 50)->default(Shipment::RELEASE_STATUS);
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
        Schema::dropIfExists('shipments');
    }
};
