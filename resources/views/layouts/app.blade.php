<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Manajemen Stok Barang') - LKS Inventory</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; color: #2d3436; line-height: 1.6; }
        .navbar { background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%); padding: 0 2rem; display: flex; align-items: center; gap: 0; box-shadow: 0 2px 10px rgba(0,0,0,0.15); position: sticky; top: 0; z-index: 100; }
        .navbar-brand { font-size: 1.2rem; font-weight: 700; color: #fff; padding: 1rem 1.5rem 1rem 0; border-right: 1px solid rgba(255,255,255,0.2); margin-right: 0.5rem; letter-spacing: 0.5px; }
        .navbar a { color: #ecf0f1; text-decoration: none; font-weight: 500; padding: 1rem 1.2rem; transition: all 0.2s; border-bottom: 3px solid transparent; font-size: 0.95rem; }
        .navbar a:hover { background: rgba(255,255,255,0.1); border-bottom-color: #3498db; }
        .navbar a.active { background: rgba(255,255,255,0.15); border-bottom-color: #3498db; color: #fff; }
        .container { max-width: 1200px; margin: 1.5rem auto; padding: 0 1.5rem; }
        .card { background: #fff; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); padding: 1.5rem; margin-bottom: 1.5rem; border: 1px solid #e9ecef; }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 2px solid #f0f2f5; }
        .card-header h2 { font-size: 1.25rem; color: #2c3e50; font-weight: 600; }
        .table-responsive { overflow-x: auto; border-radius: 8px; border: 1px solid #e9ecef; }
        table { width: 100%; border-collapse: collapse; margin-top: 0; }
        th { background: #f8f9fa; padding: 0.85rem 1rem; text-align: left; font-weight: 600; color: #495057; border-bottom: 2px solid #dee2e6; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
        td { padding: 0.85rem 1rem; border-bottom: 1px solid #f1f3f5; font-size: 0.9rem; }
        tr:hover { background: #f8f9fa; }
        tr:last-child td { border-bottom: none; }
        .btn { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.55rem 1.1rem; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: all 0.2s; line-height: 1.4; }
        .btn:hover { transform: translateY(-1px); box-shadow: 0 4px 8px rgba(0,0,0,0.15); }
        .btn-primary { background: #3498db; color: #fff; }
        .btn-primary:hover { background: #2980b9; }
        .btn-success { background: #27ae60; color: #fff; }
        .btn-success:hover { background: #219a52; }
        .btn-warning { background: #f39c12; color: #fff; }
        .btn-warning:hover { background: #e67e22; }
        .btn-danger { background: #e74c3c; color: #fff; }
        .btn-danger:hover { background: #c0392b; }
        .btn-sm { padding: 0.35rem 0.7rem; font-size: 0.8rem; }
        .btn-lg { padding: 0.7rem 1.5rem; font-size: 0.95rem; }
        .form-group { margin-bottom: 1.25rem; }
        .form-group label { display: block; margin-bottom: 0.4rem; font-weight: 500; color: #495057; font-size: 0.9rem; }
        .form-control { width: 100%; padding: 0.65rem 0.9rem; border: 1.5px solid #dee2e6; border-radius: 8px; font-size: 0.9rem; transition: border-color 0.2s, box-shadow 0.2s; background: #fff; }
        .form-control:focus { outline: none; border-color: #3498db; box-shadow: 0 0 0 3px rgba(52,152,219,0.15); }
        select.form-control { cursor: pointer; appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23999' d='M6 8.825L1.175 4 2.238 2.938 6 6.7 9.763 2.938 10.825 4z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 0.9rem center; padding-right: 2.5rem; }
        textarea.form-control { min-height: 80px; resize: vertical; }
        .alert { padding: 1rem 1.25rem; border-radius: 8px; margin-bottom: 1.25rem; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem; border-left: 4px solid transparent; }
        .alert-success { background: #d4edda; color: #155724; border-left-color: #27ae60; }
        .alert-danger { background: #f8d7da; color: #721c24; border-left-color: #e74c3c; }
        .badge { display: inline-flex; align-items: center; padding: 0.25rem 0.6rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600; gap: 0.3rem; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 1.5rem; }
        .stat-card { background: #fff; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); border: 1px solid #e9ecef; position: relative; overflow: hidden; }
        .stat-card::before { content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%; }
        .stat-card:nth-child(1)::before { background: #3498db; }
        .stat-card:nth-child(2)::before { background: #27ae60; }
        .stat-card:nth-child(3)::before { background: #9b59b6; }
        .stat-card h3 { font-size: 0.85rem; color: #7f8c8d; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
        .stat-card .value { font-size: 2rem; font-weight: 700; color: #2c3e50; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .page-header h1 { font-size: 1.5rem; color: #2c3e50; font-weight: 700; }
        .empty-state { text-align: center; padding: 3rem 2rem; color: #95a5a6; }
        .empty-state .icon { font-size: 3rem; margin-bottom: 1rem; opacity: 0.5; }
        .empty-state p { font-size: 0.95rem; }
        .empty-state a { color: #3498db; text-decoration: none; font-weight: 500; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .divider { height: 1px; background: #e9ecef; margin: 1.5rem 0; }
        .actions { display: flex; gap: 0.4rem; }
        .font-mono { font-family: 'Courier New', monospace; font-size: 0.85rem; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .mt-1 { margin-top: 1rem; }
        .img-preview { max-width: 100%; border-radius: 8px; margin-top: 0.5rem; }
    </style>
    @yield('styles')
</head>
<body>
    <div class="navbar">
        <span class="navbar-brand">📦 LKS Inventory</span>
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('items.index') }}" class="{{ request()->routeIs('items.*') ? 'active' : '' }}">Master Barang</a>
        <a href="{{ route('stock-ins.index') }}" class="{{ request()->routeIs('stock-ins.*') ? 'active' : '' }}">Barang Masuk</a>
        <a href="{{ route('stock-outs.index') }}" class="{{ request()->routeIs('stock-outs.*') ? 'active' : '' }}">Barang Keluar</a>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <div>
                    <strong>Terjadi kesalahan:</strong>
                    <ul style="margin: 0.5rem 0 0 1rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
