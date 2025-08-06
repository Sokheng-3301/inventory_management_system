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
        Schema::create('table_apply_function_for_role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('role_id') ->nullable();
            $table->char('main_function_id', 255) -> nullable();
            $table->char('sub_function_id', 255) -> nullable();
            $table->char('action_edit', 255) -> nullable();
            $table->char('action_delete', 255) ->nullable();

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_apply_function_for_role');
    }
};
