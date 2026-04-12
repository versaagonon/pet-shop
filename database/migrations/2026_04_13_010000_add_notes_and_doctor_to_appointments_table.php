<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->text('notes')->nullable()->after('status');
            $table->foreignId('doctor_id')->nullable()->after('notes')->constrained('users')->onDelete('set null');
        });

        // Migrate existing status values
        DB::table('appointments')->where('status', 'pending')->update(['status' => 'booking']);
        DB::table('appointments')->where('status', 'completed')->update(['status' => 'done']);
    }

    public function down(): void
    {
        // Revert status values
        DB::table('appointments')->where('status', 'booking')->update(['status' => 'pending']);
        DB::table('appointments')->where('status', 'done')->update(['status' => 'completed']);

        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
            $table->dropColumn(['notes', 'doctor_id']);
        });
    }
};
