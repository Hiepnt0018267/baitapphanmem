<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        // Lấy danh sách sản phẩm chưa xóa, kèm theo thông tin Danh mục
        $list = Product::with('category')->where('is_delete', 0)->get();
        return view('product.index', compact('list'));
    }

    public function create() {
        // Lấy danh sách danh mục để đổ vào thẻ Select
        $categories = Category::where('is_delete', 0)->get();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request) {
        // VALIDATION THEO ĐÚNG YÊU CẦU ĐỀ BÀI
        $request->validate([
            'name' => 'required', // Bắt buộc
            'price' => 'required|numeric|min:0', // Bắt buộc, số >= 0
            'sale_price' => 'nullable|numeric|min:0|lte:price', // lte:price nghĩa là <= price
            'stock' => 'required|integer|min:0', // Bắt buộc, số nguyên >= 0
            'category_id' => 'nullable|exists:categories,id' // Tồn tại trong bảng categories
        ], [
            
            'sale_price' => 'Giá khuyến mãi không được lớn hơn giá gốc.',
            'price.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 0.',
            'stock' => 'Giá trị tồn kho phải tối thiểu là 0.',
        ]);

        Product::create($request->all());
        return redirect()->route('product.index')->with('success', 'Thêm mới thành công');
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        $categories = Category::where('is_delete', 0)->get();
        return view('product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lte:price',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('product.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function destroy($id) {
        $product = Product::findOrFail($id);
        $product->update(['is_delete' => 1]); // Xóa mềm
        return redirect()->route('product.index');
    }
}