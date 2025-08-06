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
        Schema::create('staff_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('card_id', 255)->nullable();
            $table->char('gender', 255) -> nullable();
            $table->char('position', 255) -> nullable();
            // $table->char('id_card', 255) -> nullable();
            $table->char('phone_number', 255) -> nullable();
            $table->char('email_address', 255) ->unique() -> nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_users');
    }
};
