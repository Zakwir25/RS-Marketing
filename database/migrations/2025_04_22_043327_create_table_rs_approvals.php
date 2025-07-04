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
        Schema::create('table_rs_approvals', function (Blueprint $table) {
            $table->id();
            $table->string('rs_no');
            $table->string('nik');
            $table->integer('level');
            $table->string('status')->default('pending');
            $table->string('comment')->nullable();
            $table->text('level')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_rs_approvals');
    }
};
