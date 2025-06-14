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
        Schema::table('leads', function (Blueprint $table) {
            $table->float('initial_fee')->default(0)->after('plan_id');
            $table->float('discount')->default(0)->after('initial_fee');
            $table->float('charges')->default(0)->after('discount');
            $table->string('charges_type')->nullable()->after('charges');
            $table->unsignedBigInteger('plan_price_id')->nullable()->after('charges_type');
            $table->foreign('plan_price_id')->references('id')->on('plan_prices')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign(['plan_price_id']);
            $table->dropColumn(['initial_fee','discount','charges','plan_price_id','charges_type']);
        });
    }
};
