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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('category_id')->nullable(); // Khóa ngoại kết nối với categories
        $table->string('name');
        $table->decimal('price', 15, 2)->default(0); // Giá gốc
        $table->decimal('sale_price', 15, 2)->nullable(); // Giá khuyến mãi
        $table->integer('stock')->default(0); // Số lượng tồn kho
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->boolean('is_active')->default(1);
        $table->boolean('is_delete')->default(0); // Dùng để xóa mềm
        $table->timestamps();

        // Ràng buộc khóa ngoại: Nếu danh mục bị xóa, cột này sẽ set về null
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
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
