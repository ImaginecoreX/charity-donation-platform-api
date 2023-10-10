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
        Schema::create('requsts', function (Blueprint $table) {
            $table->id();

            $table->string('title',2048);
            $table->longText('description');
            $table->double('target_amount');
            $table->string('file_path');
            $table->unsignedBigInteger('d_type_id');
            $table->unsignedBigInteger('r_type_id');
            $table->dateTime('deadline');
            $table->timestamps();

            $table->foreign('d_type_id')->references('donation_type_id')->on('donation_types');
            $table->foreign('r_type_id')->references('requst_type_id')->on('requst_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requsts');
    }
};
