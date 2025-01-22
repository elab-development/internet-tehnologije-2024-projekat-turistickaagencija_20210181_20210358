<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('arrangement_id')->constrained()->onDelete('cascade');
        $table->foreignId('client_id')->constrained()->onDelete('cascade');
        $table->enum('status', ['pending', 'confirmed', 'canceled']);
        $table->date('date');
        $table->timestamps();
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
