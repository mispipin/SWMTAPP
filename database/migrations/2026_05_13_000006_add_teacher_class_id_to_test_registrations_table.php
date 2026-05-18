<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('test_registrations', function (Blueprint $table) {
            $table->foreignId('teacher_class_id')->nullable()->after('address')->constrained('teacher_classes')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('test_registrations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('teacher_class_id');
        });
    }
};