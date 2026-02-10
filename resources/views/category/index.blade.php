@extends('home')


@section('content')
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Danh sách Danh mục</h1>
        <a href="{{ route('category.create') }}" class="btn" style="background: #28a745; color: white; padding: 10px; text-decoration: none; border-radius: 5px;">+ Thêm mới</a>
    </div>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;" border="1">
        <thead>
            <tr style="background: #f4f4f4;">
                <th style="padding: 10px;">ID</th>
                <th style="padding: 10px;">Tên danh mục</th>
                <th style="padding: 10px;">Danh mục cha</th>
                <th style="padding: 10px;">Trạng thái</th>
                <th style="padding: 10px;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $cat)
            <tr>
                <td style="padding: 10px; text-align: center;">{{ $cat->id }}</td>
                <td style="padding: 10px;">{{ $cat->name }}</td>
                <td style="padding: 10px; text-align: center;">{{ $cat->parent->name ?? '---' }}</td>
                <td style="padding: 10px; text-align: center;">
                    <span style="color: {{ $cat->is_active ? 'green' : 'red' }}">
                        {{ $cat->is_active ? 'Đang bật' : 'Đang tắt' }}
                    </span>
                </td>
                <td style="padding: 10px; text-align: center;">
                    <a href="{{ route('category.edit', $cat->id) }}" class="btn btn-edit">Sửa</a>
                    
                    <form action="{{ route('category.destroy', $cat->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 20px;">Chưa có dữ liệu danh mục.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection