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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('total');
            $table->unsignedBigInteger('user_id');
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('zip_code')->nullable();
            $table->text('message')->nullable();
            $table->enum('status',['pending','delivery','delivered','cancelled'])->default('pending');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
