<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            DB::statement('ALTER TABLE leads MODIFY preferred_contact_method TEXT');

            \App\Models\Lead::query()->update([
                'preferred_contact_method' => null
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            DB::statement("ALTER TABLE leads MODIFY preferred_contact_method ENUM('Call','Email','Text')");
        });
    }
};
