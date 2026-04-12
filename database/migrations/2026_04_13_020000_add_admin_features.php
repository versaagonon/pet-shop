<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Services: add duration column
        Schema::table('services', function (Blueprint $table) {
            $table->string('duration')->default('30 Minutes')->after('name');
        });

        // 2. Medicines: add stock and compositions for "Mixed Medicine"
        Schema::table('medicines', function (Blueprint $table) {
            $table->text('compositions')->nullable()->after('description'); // JSON: [{"name":"x","qty":1}]
            $table->integer('stock')->default(0)->after('compositions');
        });

        // 3. Products: new table
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('Antiparasit');
            $table->decimal('price', 15, 2); // selling price
            $table->decimal('bought_price', 15, 2)->default(0); // cost price
            $table->integer('stock')->default(0);
            $table->string('unit')->default('unit'); // unit, tablet, tube
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');

        Schema::table('medicines', function (Blueprint $table) {
            $table->dropColumn(['compositions', 'stock']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('duration');
        });
    }
};
