<?php
$configPath = dirname(__DIR__, 2) . '/config/AdminConfig.php';
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
$currentPageTitle = 'Quản trị Mực - Nội dung';

$pageHeading = 'Quản lý nội dung';
$pageDescription = 'Theo dõi bài viết, chương truyện và trạng thái xuất bản';

$contents = [
    ['id' => 1, 'title' => 'Bài viết giới thiệu', 'category' => 'Tin tức', 'status' => 'Hiển thị'],
    ['id' => 2, 'title' => 'Khuyến mãi tháng 4', 'category' => 'Ưu đãi', 'status' => 'Nháp'],
    ['id' => 3, 'title' => 'Hướng dẫn đặt hàng', 'category' => 'Hướng dẫn', 'status' => 'Hiển thị'],
];

function navItem(string $label, string $icon, string $href, string $key, string $currentSection): string
{
    $activeClass = $key === $currentSection ? 'sidebar-link active' : 'sidebar-link';

    return '
        <a href="' . e($href) . '" class="' . e($activeClass) . '">
            <span class="material-symbols-outlined sidebar-link-icon">' . e($icon) . '</span>
            <span>' . e($label) . '</span>
        </a>
    ';
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($currentPageTitle) ?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="../../assets/css/admin/adminStyle.css">
    <link rel="stylesheet" href="../../assets/css/admin/content/indexStyle.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="sidebar-top">
                <h1 class="sidebar-logo">Quản trị Mực</h1>
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
                <a href="../sales/index.php" class="sidebar-report-btn">Xuất báo cáo</a>
            </div>
        </aside>

        <main class="main-content">
            <header class="topbar">
                <div class="topbar-left">
                    <h2 class="page-title"><?= e($pageHeading) ?></h2>
                    <p class="page-desc"><?= e($pageDescription) ?></p>
                </div>

                <div class="topbar-right">
                    <button type="button" class="icon-btn" aria-label="Thông báo">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>

                    <button type="button" class="icon-btn" aria-label="Trợ giúp">
                        <span class="material-symbols-outlined">help</span>
                    </button>

                    <a href="../logout.php" class="logout-btn">
                        <span class="material-symbols-outlined logout-icon">logout</span>
                        <span>Đăng xuất</span>
                    </a>

                    <div class="admin-avatar"><?= e($adminInitials) ?></div>
                </div>
            </header>

            <section class="content-wrapper">
                <div class="breadcrumb">
                    <a href="../dashboard/index.php">Trang quản trị</a>
                    <span>/</span>
                    <span>Nội dung</span>
                </div>

                <div class="content-card">
                    <div class="content-card-header">
                        <div>
                            <h3>Danh sách nội dung</h3>
                            <p>Quản lý bài viết, thông báo và chương truyện trong hệ thống.</p>
                        </div>

                        <div class="header-actions">
                            <a href="./create.php" class="add-btn">
                                <span class="material-symbols-outlined add-btn-icon">add</span>
                                <span>Thêm nội dung</span>
                            </a>
                        </div>
                    </div>

                    <div class="table-tools">
                        <div class="search-box">
                            <span class="material-symbols-outlined">search</span>
                            <input type="text" id="contentSearch" placeholder="Tìm theo tiêu đề hoặc danh mục...">
                        </div>
                    </div>

                    <div class="table-wrap">
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Tiêu đề</th>
                                    <th>Danh mục</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="contentTableBody">
                                <?php foreach ($contents as $item): ?>
                                    <tr>
                                        <td><?= e($item['id']) ?></td>
                                        <td class="content-title"><?= e($item['title']) ?></td>
                                        <td class="content-category"><?= e($item['category']) ?></td>
                                        <td>
                                            <span class="status-badge <?= $item['status'] === 'Hiển thị' ? 'status-show' : 'status-draft' ?>">
                                                <?= e($item['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-group">
                                                <a href="./detail.php?id=<?= e($item['id']) ?>" class="action-btn action-detail">Chi tiết</a>
                                                <a href="./edit.php?id=<?= e($item['id']) ?>" class="action-btn action-edit">Sửa</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="empty-state" id="emptyState">
                        Không tìm thấy nội dung phù hợp.
                    </div>
                </div>

                <footer class="page-footer">
                    © <?= date('Y') ?> Mực Chuyển Động. Bảo lưu mọi quyền.
                </footer>
            </section>
        </main>
    </div>

    <script src="../../assets/js/admin/admin.js"></script>
    <script src="../../assets/js/admin/content/index.js"></script>
</body>
</html>