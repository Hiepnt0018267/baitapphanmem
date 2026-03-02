@extends('home') 

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Danh sách Sản phẩm</h2>
        <a href="{{ route('product.create') }}" class="btn" style="background: #28a745; color: white;">➕ Thêm mới</a>
    </div>

    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Giá gốc</th>
                <th>Giá KM</th>
                <th>Tồn kho</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($list as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    {{-- Gọi tên danh mục, nếu không có thì hiển thị 'Trống' --}}
                    <td>{{ $item->category->name ?? 'Trống' }}</td> 
                    <td>{{ number_format($item->price) }} đ</td>
                    <td>{{ $item->sale_price ? number_format($item->sale_price).' đ' : '-' }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>
                        <a href="{{ route('product.edit', $item->id) }}" class="btn btn-edit">Sửa</a>
                        
                        {{-- Form nút Xóa --}}
                        <form action="{{ route('product.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Chưa có sản phẩm nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection