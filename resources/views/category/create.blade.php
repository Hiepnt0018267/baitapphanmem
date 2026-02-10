@extends('home')

@section('content')
<div class="container">
    <h1>Thêm Danh mục Mới</h1>
    <hr>
    <form action="{{ route('category.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 15px;">
            <label>Tên danh mục:</label><br>
            <input type="text" name="name" style="width: 100%; padding: 8px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Mô tả:</label><br>
            <textarea name="description" style="width: 100%; padding: 8px;"></textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Danh mục cha:</label><br>
            <select name="parent_id" style="width: 100%; padding: 8px;">
                <option value="">-- Chọn danh mục cha (nếu có) --</option>
                @foreach($parents as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Lưu danh mục</button>
        <a href="{{ route('category.index') }}" style="margin-left: 10px;">Quay lại</a>
    </form>
</div>
@endsection