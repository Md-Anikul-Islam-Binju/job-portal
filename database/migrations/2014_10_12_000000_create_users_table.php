<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('role')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            //optional
            $table->string('name_bn')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_name_bn')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_name_bn')->nullable();
            $table->string('nationality')->nullable();
            $table->string('nationality_bn')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('blood_group_bn')->nullable();
            $table->string('profile')->nullable();
            $table->string('nid')->nullable();
            $table->string('dob')->nullable();
            $table->integer('status')->default(1);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
