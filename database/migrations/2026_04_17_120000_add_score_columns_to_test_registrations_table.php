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
        Schema::table('test_registrations', function (Blueprint $table) {
            $table->unsignedTinyInteger('orang_benar')->nullable()->after('address');
            $table->unsignedTinyInteger('urutan_benar')->nullable()->after('orang_benar');
            $table->unsignedTinyInteger('orang_salah')->nullable()->after('urutan_benar');
            $table->unsignedTinyInteger('urutan_salah')->nullable()->after('orang_salah');
            $table->unsignedSmallInteger('total_poin')->nullable()->after('urutan_salah');
            $table->timestamp('tested_at')->nullable()->after('total_poin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test_registrations', function (Blueprint $table) {
            $table->dropColumn([
                'orang_benar',
                'urutan_benar',
                'orang_salah',
                'urutan_salah',
                'total_poin',
                'tested_at',
            ]);
        });
    }
};
