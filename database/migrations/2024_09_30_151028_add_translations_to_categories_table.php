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
        Schema::table('categories', function (Blueprint $table) {
               // Colonnes pour les traductions en français, anglais, wolof
               $table->string('name_fr')->nullable();
               $table->string('name_en')->nullable();
               $table->string('name_wo')->nullable();
               $table->string('name_ar')->nullable();


            // Colonnes pour les traductions des descriptions
            $table->text('description_fr')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_wo')->nullable();
            $table->text('description_ar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['name_fr', 'name_en', 'name_wo','name_ar',
                                'description_fr', 'description_en', 
                                'description_wo', 'description_ar'
                            ]);
        });
    }
};
