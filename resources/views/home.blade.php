<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Project</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; margin: 0; }
        .sidebar { width: 250px; background: #333; color: #fff; min-height: 100vh; padding: 20px; }
        .sidebar h2 { font-size: 1.2rem; border-bottom: 1px solid #555; padding-bottom: 10px; }
        .sidebar ul { list-style: none; padding: 0; }
        .sidebar ul li { margin: 10px 0; }
        .sidebar ul li a { color: #ccc; text-decoration: none; display: block; padding: 5px; }
        .sidebar ul li a:hover { color: #fff; background: #444; }
        .sidebar .submenu { padding-left: 20px; font-size: 0.9rem; }
        .content { flex: 1; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f4f4f4; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; cursor: pointer; border: none; }
        .btn-edit { background: #ffc107; color: #000; }
        .btn-delete { background: #dc3545; color: #fff; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Hệ thống Admin</h2>
        <ul>
            <li>
                <strong>Quản lý Danh mục</strong>
                <ul class="submenu">
                    <li><a href="{{ route('category.index') }}">📄 Xem danh sách</a></li>
                    <li><a href="{{ route('category.create') }}">➕ Thêm mới</a></li>
                </ul>
            </li>
            </ul>
    </div>

    <div class="content">
        @yield('content')
    </div>

</body>
</html>