<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('profile', 255)->nullable();
            $table->char('card_id', 255) -> unique();

            $table->string('name_en')->nullable();
            $table->string('name_kh')->nullable();

            // $table->char('gender', 255)->nullable();
            // $table->integer('position_id')->nullable();
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->integer('role_id') -> nullable();
            $table->integer('block_status') -> default(1);
            $table->date('block_date') -> nullable();
            $table->char('block_by', 255)->nullable();
            $table->char('create_by', 255)->nullable();
            $table->rememberToken();
            $table->timestamps();
            // $table->timestamp();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
