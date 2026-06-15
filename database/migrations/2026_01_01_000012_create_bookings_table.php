<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_phone');
            $table->string('client_whatsapp')->nullable();
            $table->string('business_type');
            $table->json('selected_products')->nullable();   // array of product names
            $table->text('custom_program_idea')->nullable();
            $table->date('meeting_date');
            $table->string('meeting_time_slot');
            $table->enum('status', ['new', 'confirmed', 'completed', 'cancelled'])->default('new');
            $table->string('meeting_link')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
