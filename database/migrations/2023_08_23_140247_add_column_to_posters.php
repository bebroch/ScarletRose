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
        Schema::table('posters', function (Blueprint $table) {
            $table->date('timeEventStart')->nullable()->after('about');
            $table->date('timeEventEnd')->nullable()->after('timeEventStart');
            $table->date('timeEventDay')->nullable()->after('about');
            $table->dropColumn('timeSpending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posters', function (Blueprint $table) {
            $table->dropColumn('timeEventStart');
            $table->dropColumn('timeEventEnd');
            $table->dropColumn('timeEventDay');
            $table->date('timeSpending')->after('about');
        });
    }
};
