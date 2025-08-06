<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('role_name', 255);
            $table->char('add_by', 255);
            // $table->timestamp('create_date');
            $table->timestamp('create_date');
            $table->integer('delete_status')->default(1);
            $table->char('delete_by', 255) -> nullable();
            $table->date('delete_date') -> nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
