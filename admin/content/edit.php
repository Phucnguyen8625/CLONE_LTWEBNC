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
$currentPageTitle = 'Quản trị Mực - Chỉnh sửa nội dung';

$pageHeading = 'Chỉnh sửa nội dung';
$pageDescription = 'Cập nhật dữ liệu hiện có trong hệ thống';

$id = (int) ($_GET['id'] ?? 1);

$data = [
    'title' => 'Bài viết mẫu',
    'category' => 'Tin tức',
    'status' => 'Hiển thị',
    'description' => 'Đây là phần nội dung minh hoạ để bạn gắn dữ liệu thật sau này.',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['title'] = trim($_POST['title'] ?? '');
    $data['category'] = trim($_POST['category'] ?? '');
    $data['status'] = trim($_POST['status'] ?? '');
    $data['description'] = trim($_POST['description'] ?? '');

    $successMessage = 'Cập nhật nội dung thành công.';
}

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
    <link rel="stylesheet" href="../../assets/css/admin/content/editStyle.css">
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
                    <a href="./index.php">Nội dung</a>
                    <span>/</span>
                    <span>Chỉnh sửa</span>
                </div>

                <?php if (!empty($successMessage)): ?>
                    <div class="alert-success">
                        <?= e($successMessage) ?>
                    </div>
                <?php endif; ?>

                <div class="edit-card">
                    <div class="edit-card-header">
                        <div>
                            <h3>Biểu mẫu chỉnh sửa</h3>
                            <p>Chỉnh sửa thông tin bài viết hoặc nội dung đang có trong hệ thống.</p>
                        </div>

                        <div class="header-actions">
                            <a href="./detail.php?id=<?= e($id) ?>" class="outline-btn">Xem chi tiết</a>
                            <a href="./create.php" class="outline-btn">Tạo mới</a>
                            <a href="./index.php" class="outline-btn">Danh sách nội dung</a>
                        </div>
                    </div>

                    <form method="post" class="edit-form" id="editContentForm">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="<?= e($data['title']) ?>"
                                placeholder="Nhập tiêu đề nội dung"
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
                                    placeholder="Nhập danh mục"
                                >
                            </div>

                            <div class="form-group">
                                <label for="status">Trạng thái</label>
                                <select id="status" name="status">
                                    <option value="Hiển thị" <?= $data['status'] === 'Hiển thị' ? 'selected' : '' ?>>Hiển thị</option>
                                    <option value="Ẩn" <?= $data['status'] === 'Ẩn' ? 'selected' : '' ?>>Ẩn</option>
                                    <option value="Nháp" <?= $data['status'] === 'Nháp' ? 'selected' : '' ?>>Nháp</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea
                                id="description"
                                name="description"
                                rows="7"
                                placeholder="Nhập mô tả nội dung"
                            ><?= e($data['description']) ?></textarea>
                        </div>

                        <div class="form-actions">
                            <a href="./index.php" class="back-btn">Quay lại</a>
                            <a href="./detail.php?id=<?= e($id) ?>" class="detail-btn">Xem chi tiết</a>
                            <button type="submit" class="submit-btn">Cập nhật</button>
                        </div>
                    </form>
                </div>

                <footer class="page-footer">
                    © <?= date('Y') ?> Mực Chuyển Động. Bảo lưu mọi quyền.
                </footer>
            </section>
        </main>
    </div>

    <script src="../../assets/js/admin/admin.js"></script>
    <script src="../../assets/js/admin/content/edit.js"></script>
</body>
</html>