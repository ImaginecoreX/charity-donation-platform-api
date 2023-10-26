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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('admin_email');
            $table->string('title',100);
            $table->longText('description');
            $table->dateTime('from');
            $table->dateTime('to');
            $table->string('location_link');
            $table->foreignId('district_id')->references('id')->on('districts') ;
            $table->foreignId('status_id')->references('id')->on('statuses') ;
            $table->foreignId('event_statuses_id')->references('id')->on('event_statuses');
            $table->foreign('admin_email')->references('email')->on('admins');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
