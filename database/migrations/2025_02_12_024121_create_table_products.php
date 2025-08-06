<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('pro_img', 255) -> nullable();
            $table->char('pro_name_kh', 255);
            $table->char('pro_name_en', 255);
            $table->char('pro_code',255);
            $table->integer('cat_id');
            $table->integer('qty');
            $table->integer('stock_status') -> default(1);
            $table->text('pro_description') -> nullable();
            $table->char('add_by', 255);
            $table->date('create_date') -> default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('delete_status')->default(1);
            $table->char('delete_by', 255) -> nullable();
            $table->date('delete_date') -> nullable();
            $table->year('year') -> nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
