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
        Schema::create('penjemputans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kartu_id')->nullable()->constrained('kartus')->nullOnDelete();
            $table->date('tanggal');
            $table->time('jam');
            $table->string('screenshoot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjemputans');
    }
};
