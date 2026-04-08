<?php
require_once __DIR__ . '/../../config/AdminConfig.php';

if (!isset($pageTitle) || $pageTitle === '') {
    $pageTitle = 'Trang quản trị';
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:Arial,sans-serif;background:#f4f6f9;color:#333}
        .admin-layout{display:flex;min-height:100vh}
        .admin-sidebar{width:250px;background:#1e293b;color:#fff;padding:20px}
        .admin-sidebar h2{margin-bottom:25px}
        .admin-sidebar a{display:block;color:#fff;text-decoration:none;padding:12px;border-radius:8px;margin-bottom:10px}
        .admin-sidebar a:hover{background:#334155}
        .admin-main{flex:1}
        .admin-topbar{background:#fff;padding:20px 25px;border-bottom:1px solid #ddd;display:flex;justify-content:space-between;align-items:center}
        .admin-content{padding:25px}
        .card-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;margin-bottom:20px}
        .card{background:#fff;padding:20px;border-radius:12px;box-shadow:0 3px 8px rgba(0,0,0,.06)}
        .content-box{background:#fff;padding:25px;border-radius:12px;box-shadow:0 3px 8px rgba(0,0,0,.06)}
        .table{width:100%;border-collapse:collapse}
        .table th,.table td{padding:12px;border-bottom:1px solid #eee;text-align:left}
        .table th{background:#f8fafc}
        .btn,.btn-small{display:inline-block;text-decoration:none;border:none;cursor:pointer;border-radius:8px}
        .btn{padding:10px 16px;background:#2563eb;color:#fff}
        .btn:hover{background:#1d4ed8}
        .btn-small{padding:7px 12px;background:#0ea5e9;color:#fff;font-size:13px}
        .btn-warning{background:#f59e0b}
        .form-group{margin-bottom:16px}
        .form-group label{display:block;margin-bottom:8px;font-weight:bold}
        .form-group input,.form-group select,.form-group textarea{width:100%;padding:12px;border:1px solid #ccc;border-radius:8px}
        .alert-success{background:#dcfce7;color:#166534;padding:12px;border-radius:8px;margin-bottom:16px}
        .alert-error{background:#fee2e2;color:#b91c1c;padding:12px;border-radius:8px;margin-bottom:16px}
        .page-action{display:flex;justify-content:space-between;align-items:center;gap:10px;margin-bottom:20px;flex-wrap:wrap}
    </style>
</head>
<body>
<div class="admin-layout">