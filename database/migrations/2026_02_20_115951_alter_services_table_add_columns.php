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
        Schema::table('services', function (Blueprint $table) {
            // Adauga coloane daca nu exista deja
            if (!Schema::hasColumn('services', 'title')) {
                $table->string('title')->nullable();
            }
            if (!Schema::hasColumn('services', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('services', 'price')) {
                $table->decimal('price', 8, 2)->nullable();
            }
            if (!Schema::hasColumn('services', 'category_id')) {
                $table->foreignId('category_id')->nullable()->constrained('service_categories')->onDelete('cascade');
            }
            if (!Schema::hasColumn('services', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Sterge coloane
            $table->dropColumn(['title', 'description', 'price', 'category_id', 'is_active']);
        });
    }
};
