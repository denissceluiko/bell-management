<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'ring-queue';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('enqueued_rings');
        Schema::create('enqueued_rings', function (Blueprint $table) {
            $table->id();
            $table->time('ring_at');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enqueued_rings');
    }
};
