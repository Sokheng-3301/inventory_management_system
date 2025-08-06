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
        $date = date('Y');
        Schema::create('borrows', function (Blueprint $table) {
            $table->bigIncrements('borrow_id');
            $table->integer('pro_id');
            $table->char('staff_id', 255);
            $table->date('borrow_date') -> nullable();
            $table->text('borrow_purpose');
            $table->integer('borrow_qty');
            $table->char('attachemnt', 255);
            $table->integer('borrow_status') -> default(0);
            $table->char('approve_by', 255)->nullable();
            $table->date('approve_date')->nullable();
            $table->char('owner', 255)->nullable();
            $table->date('payback_date')->nullable();
            $table->integer('payback_status')->default(1);
            $table->integer('delete_status')->default(1);
            $table->char('delete_by', 255) ->nullable();
            $table->date('delete_date') -> nullable();
            $table->year('year')->nullable();
            $table->integer('notification') -> default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrows');
    }
};
