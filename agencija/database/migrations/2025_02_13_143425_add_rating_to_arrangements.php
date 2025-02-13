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
        Schema::table('arrangements', function (Blueprint $table) {
            $table->float('rating', 3, 2)->nullable()->after('price');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arrangements', function (Blueprint $table) {
            $table->dropColumn('rating');
        });
    }
};
