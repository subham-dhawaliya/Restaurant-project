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
        // Check if columns exist before adding
        if (!Schema::hasColumn('users', 'city')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('city')->nullable()->after('address');
            });
        }
        
        if (!Schema::hasColumn('users', 'pincode')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('pincode', 10)->nullable()->after('city');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'city')) {
                $table->dropColumn('city');
            }
            if (Schema::hasColumn('users', 'pincode')) {
                $table->dropColumn('pincode');
            }
        });
    }
};
