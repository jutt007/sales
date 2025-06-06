<?php

use App\Models\Lead;
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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->uuid('identifier')->unique();
            $table->json('selected_bugs')->nullable();
            $table->string('address', 1024)->nullable();
            $table->string('latitude', 15)->nullable();
            $table->string('longitude', 15)->nullable();
            $table->boolean('is_commercial')->default(false);
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->enum('preferred_contact_method', array_values(Lead::CONTACT_METHOD));
            $table->foreignId('plan_id')->nullable()->constrained();
            $table->date('appointment_date')->nullable();
            $table->string('appointment_time')->nullable();
            $table->boolean('customer_added')->default(false);
            $table->boolean('customer_card_added')->default(false);
            $table->boolean('contract_sent')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
