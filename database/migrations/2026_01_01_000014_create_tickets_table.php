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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->string('client_name');
            $table->string('client_phone');
            $table->string('client_whatsapp')->nullable();
            $table->string('system_name'); // اسم النظام أو البرنامج المعني
            $table->string('type');        // support (دعم فني) أو modification (طلب تعديل)
            $table->string('priority');    // low, medium, high, urgent
            $table->string('status');      // open, in_progress, resolved, closed
            $table->string('title');
            $table->text('description');
            $table->text('admin_reply')->nullable();
            $table->timestamp('admin_reply_at')->nullable();
            $table->timestamps();

            // فهارس لتسريع التتبع والبحث
            $table->index('ticket_number');
            $table->index('client_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
