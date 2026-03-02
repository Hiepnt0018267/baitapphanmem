@extends('home')

@section('content')
<div class="container">
    <h1>Chỉnh sửa Sản phẩm: {{ $product->name }}</h1>
    <hr>

    {{-- Hiển thị thông báo lỗi Validation --}}
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px; border: 1px solid red; padding: 10px; background: #fee;">
            <ul style="margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('product.update', $product->id) }}" method="POST">
        @csrf
        {{-- LƯU Ý QUAN TRỌNG: Form update bắt buộc phải có dòng @method('PUT') --}}
        @method('PUT')
        
        <div style="margin-bottom: 15px;">
            <label>Tên sản phẩm (*):</label><br>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" style="width: 100%; padding: 8px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Danh mục:</label><br>
            <select name="category_id" style="width: 100%; padding: 8px;">
                <option value="">-- Chọn danh mục (nếu có) --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Giá gốc (*):</label><br>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" style="width: 100%; padding: 8px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Giá khuyến mãi:</label><br>
            <input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Số lượng kho (*):</label><br>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" style="width: 100%; padding: 8px;" required>
        </div>

        <button type="submit" style="background: #ffc107; color: #000; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Cập nhật sản phẩm</button>
        <a href="{{ route('product.index') }}" style="margin-left: 10px;">Quay lại</a>
    </form>
</div>
@endsection