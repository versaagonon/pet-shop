<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('medicines', 'compositions')) {
            Schema::table('medicines', function (Blueprint $table) {
                $table->text('compositions')->nullable()->after('description');
            });
        }

        if (!Schema::hasColumn('services', 'duration')) {
            Schema::table('services', function (Blueprint $table) {
                $table->string('duration')->default('30 Minutes')->after('name');
            });
        }
    }

    public function down(): void
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->dropColumn('compositions');
        });
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('duration');
        });
    }
};
