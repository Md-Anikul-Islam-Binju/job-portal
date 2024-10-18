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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('linkedIn')->nullable();
            $table->string('facebook')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('dob')->nullable();
            $table->string('hobby')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('nid')->nullable();
            $table->string('work_knowledge')->nullable();
            $table->string('verification_code')->nullable();
            $table->string('password');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
