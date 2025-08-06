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
        Schema::create('operators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('username',255);
            $table->char('password', 255);
            $table->char('email', 255) -> unique();
            $table->integer('role_id')->nullable();
            $table->char('add_by', 255);
            $table->timestamp('crreate_date');
            $table->integer('block_status')->default(1);
            $table->char('block_by', 255) -> nullable();
            $table->date('block_date') -> nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operators');
    }
};
