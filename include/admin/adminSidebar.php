<?php require_once __DIR__ . '/../../config/AdminConfig.php'; ?>

<aside class="admin-sidebar">
    <h2>QUẢN TRỊ</h2>

    <a href="<?php echo ADMIN_URL; ?>/Dashboard/index.php">Bảng điều khiển</a>
    <a href="<?php echo ADMIN_URL; ?>/Content/index.php">Nội dung</a>
    <a href="<?php echo ADMIN_URL; ?>/Sales/index.php">Doanh thu</a>
    <a href="<?php echo ADMIN_URL; ?>/Users/index.php">Người dùng</a>
    <a href="<?php echo ADMIN_URL; ?>/Logout.php">Đăng xuất</a>
</aside>

<div class="admin-main">
    <div class="admin-topbar">
        <h1><?php echo htmlspecialchars($pageTitle ?? 'Trang quản trị', ENT_QUOTES, 'UTF-8'); ?></h1>
        <div>Xin chào, <?php echo htmlspecialchars($_SESSION['admin_name'] ?? 'Admin', ENT_QUOTES, 'UTF-8'); ?></div>
    </div>
    <div class="admin-content">