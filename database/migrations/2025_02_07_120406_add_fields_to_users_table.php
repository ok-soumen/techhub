<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobileNumber')->unique();
            $table->date('dob')->nullable();
            $table->text('address')->nullable();
            $table->string('course_type')->nullable();
            $table->enum('role', ['user', 'admin', 'teacher'])->default('user');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['mobileNumber', 'dob', 'address', 'course_type', 'role']);
        });
    }
};
