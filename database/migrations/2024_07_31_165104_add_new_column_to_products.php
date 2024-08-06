<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->integer('todays_deal');
            $table->string('sku');
            $table->string('unit')->nullable();
            $table->integer('min_qty');
            $table->double('tax', 8, 2);
            $table->string('tax_type')->nullable();
            $table->string('shipping_type')->nullable();
            $table->double('shipping_cost', 8, 2);
            $table->mediumText('meta_title');
            $table->longText('meta_description');
            $table->string('pdf')->nullable();
            $table->double('rating', 8, 2);
            $table->float('purchase_price');
            $table->mediumText('tags')->nullable();
            $table->string('video_link')->nullable();
            $table->unsignedBigInteger('video_provider_id')->nullable();
            $table->foreign('video_provider_id')->references('id')->on('video_providers')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
