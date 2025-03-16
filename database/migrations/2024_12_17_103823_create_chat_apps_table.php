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
        Schema::create('chat_apps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // Sender
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade'); // Receiver
            $table->text('message'); // Message content
            $table->boolean('is_read')->default(false); // Read status
            $table->timestamp('sent_at')->useCurrent(); // Timestamp
            $table->timestamps(); // Created & Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_apps');
    }
};
