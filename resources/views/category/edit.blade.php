@extends('home')

@section('content')
<div class="container">
    <h1>Chỉnh sửa Danh mục: {{ $category->name }}</h1>
    <hr>

    {{-- Hiển thị thông báo lỗi Validation (nếu có) --}}
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px; border: 1px solid red; padding: 10px; background: #fee;">
            <ul style="margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('category.update', $category->id) }}" method="POST">
        @csrf
        {{-- Bắt buộc phải có @method('PUT') để Laravel hiểu đây là form cập nhật --}}
        @method('PUT')
        
        <div style="margin-bottom: 15px;">
            <label>Tên danh mục (*):</label><br>
            {{-- Đổ dữ liệu cũ ra ô input bằng tham số thứ 2 của hàm old() --}}
            <input type="text" name="name" value="{{ old('name', $category->name) }}" style="width: 100%; padding: 8px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Mô tả:</label><br>
            {{-- Textarea không có thuộc tính value, dữ liệu phải kẹp giữa 2 thẻ đóng mở --}}
            <textarea name="description" style="width: 100%; padding: 8px; min-height: 100px;">{{ old('description', $category->description) }}</textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Danh mục cha:</label><br>
            <select name="parent_id" style="width: 100%; padding: 8px;">
                <option value="">-- Chọn danh mục cha (nếu có) --</option>
                
                {{-- Vòng lặp lấy danh sách danh mục cha (đã lọc chống vòng lặp ở Controller) --}}
                @foreach($parents as $p)
                    <option value="{{ $p->id }}" {{ old('parent_id', $category->parent_id) == $p->id ? 'selected' : '' }}>
                        {{ $p->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" style="background: #ffc107; color: #000; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Cập nhật danh mục</button>
        <a href="{{ route('category.index') }}" style="margin-left: 10px;">Quay lại</a>
    </form>
</div>
@endsection