<?php
$configPath = dirname(__DIR__, 2) . '/config/adminConfig.php';
if (file_exists($configPath)) {
    require_once $configPath;
}

if (!function_exists('e')) {
    function e($value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('requireAdminLogin')) {
    function requireAdminLogin(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['admin_logged_in'])) {
            header('Location: ../login.php');
            exit;
        }
    }
}

if (!function_exists('adminCurrentUserName')) {
    function adminCurrentUserName(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return $_SESSION['admin_name'] ?? 'Quản trị viên';
    }
}

requireAdminLogin();

$adminName = adminCurrentUserName();
$parts = preg_split('/\s+/u', trim($adminName)) ?: [];
$letters = '';

foreach ($parts as $part) {
    if ($part !== '') {
        $letters .= mb_substr($part, 0, 1, 'UTF-8');
    }
    if (mb_strlen($letters, 'UTF-8') >= 2) {
        break;
    }
}

$adminInitials = mb_strtoupper($letters !== '' ? $letters : 'AD', 'UTF-8');

$currentSection = 'content';
$currentPageTitle = 'Quản trị Mực - Thêm nội dung';

function navItem(string $label, string $icon, string $href, string $key, string $currentSection): string
{
    $activeClass = $key === $currentSection ? ' sidebar-link active' : ' sidebar-link';

    return '<a href="' . e($href) . '" class="' . $activeClass . '">
                <span class="material-symbols-outlined sidebar-icon">' . e($icon) . '</span>
                <span>' . e($label) . '</span>
            </a>';
}

$pageHeading = 'Thêm nội dung';
$pageDescription = 'Tạo mới bài viết, chương truyện hoặc thông báo';

$data = [
    'title' => 'Bài viết mẫu',
    'category' => 'Tin tức',
    'status' => 'Hiển thị',
    'description' => 'Đây là phần nội dung minh hoạ để bạn gắn dữ liệu thật sau này.',
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($currentPageTitle) ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/admin/content/createStyle.css">
    <script src="../../assets/js/admin/content/create.js" defer></script>
</head>
<body class="page-create">
    <div class="layout">
        <aside class="sidebar">
            <div class="sidebar-top">
                <h1 class="sidebar-title">Quản trị Mực</h1>
                <p class="sidebar-subtitle">Điều khiển hệ thống</p>
            </div>

            <nav class="sidebar-nav">
                <?= navItem('Tổng quan', 'dashboard', '../dashboard/index.php', 'dashboard', $currentSection) ?>
                <?= navItem('Nội dung', 'article', '../content/index.php', 'content', $currentSection) ?>
                <?= navItem('Doanh số', 'payments', '../sales/index.php', 'sales', $currentSection) ?>
                <?= navItem('Người dùng', 'group', '../users/index.php', 'users', $currentSection) ?>
                <?= navItem('Cài đặt', 'settings', '../settings/index.php', 'settings', $currentSection) ?>
            </nav>

            <div class="sidebar-bottom">
                <a href="../sales/index.php" class="report-button">Xuất báo cáo</a>
            </div>
        </aside>

        <main class="main-content">
            <header class="topbar">
                <div>
                    <h2 class="page-title"><?= e($pageHeading) ?></h2>
                    <p class="page-subtitle"><?= e($pageDescription) ?></p>
                </div>

                <div class="topbar-right">
                    <span class="material-symbols-outlined top-action">notifications</span>
                    <span class="material-symbols-outlined top-action">help</span>

                    <a href="../logout.php" class="logout-button">
                        <span class="material-symbols-outlined logout-icon">logout</span>
                        <span>Đăng xuất</span>
                    </a>

                    <div class="admin-avatar"><?= e($adminInitials) ?></div>
                </div>
            </header>

            <div class="page-body">
                <div class="form-card">
                    <form method="post" class="content-form" id="createContentForm">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="<?= e($data['title']) ?>"
                            >
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="category">Danh mục</label>
                                <input
                                    type="text"
                                    id="category"
                                    name="category"
                                    value="<?= e($data['category']) ?>"
                                >
                            </div>

                            <div class="form-group">
                                <label for="status">Trạng thái</label>
                                <select id="status" name="status">
                                    <option <?= $data['status'] === 'Hiển thị' ? 'selected' : '' ?>>Hiển thị</option>
                                    <option <?= $data['status'] === 'Ẩn' ? 'selected' : '' ?>>Ẩn</option>
                                    <option <?= $data['status'] === 'Nháp' ? 'selected' : '' ?>>Nháp</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea
                                id="description"
                                name="description"
                                rows="6"
                            ><?= e($data['description']) ?></textarea>
                        </div>

                        <div class="form-actions">
                            <a href="./index.php" class="button-back">Quay lại</a>
                            <button type="submit" class="button-save">Lưu nội dung</button>
                        </div>
                    </form>
                </div>

                <footer class="page-footer">
                    © <?= date('Y') ?> Mực Chuyển Động. Bảo lưu mọi quyền.
                </footer>
            </div>
        </main>
    </div>
</body>
</html>