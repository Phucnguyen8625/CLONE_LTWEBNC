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

$currentSection = 'settings';
$currentPageTitle = 'Quản trị Mực - Cài đặt';

$pageHeading = 'Cài đặt hệ thống';
$pageDescription = 'Điều chỉnh thông tin website và cấu hình quản trị';

$formData = [
    'site_name' => 'Mực Chuyển Động',
    'admin_email' => 'admin@example.com',
    'site_description' => 'Nền tảng truyện tranh số dành cho nghệ sĩ độc lập.',
    'allow_register' => true,
    'enable_email' => true,
    'maintenance_mode' => false,
];

$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData['site_name'] = trim($_POST['site_name'] ?? '');
    $formData['admin_email'] = trim($_POST['admin_email'] ?? '');
    $formData['site_description'] = trim($_POST['site_description'] ?? '');
    $formData['allow_register'] = isset($_POST['allow_register']);
    $formData['enable_email'] = isset($_POST['enable_email']);
    $formData['maintenance_mode'] = isset($_POST['maintenance_mode']);

    $successMessage = 'Lưu cài đặt thành công.';
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
    <link rel="stylesheet" href="../../assets/css/admin/settings/settingsStyle.css">
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

            <section class="settings-wrapper">
                <?php if ($successMessage !== ''): ?>
                    <div class="alert-success">
                        <?= e($successMessage) ?>
                    </div>
                <?php endif; ?>

                <form method="post" id="settingsForm">
                    <div class="settings-grid">
                        <div class="settings-card">
                            <h3>Thông tin website</h3>

                            <div class="form-group">
                                <label for="site_name">Tên website</label>
                                <input
                                    type="text"
                                    id="site_name"
                                    name="site_name"
                                    value="<?= e($formData['site_name']) ?>"
                                >
                            </div>

                            <div class="form-group">
                                <label for="admin_email">Email quản trị</label>
                                <input
                                    type="email"
                                    id="admin_email"
                                    name="admin_email"
                                    value="<?= e($formData['admin_email']) ?>"
                                >
                            </div>

                            <div class="form-group">
                                <label for="site_description">Mô tả</label>
                                <textarea
                                    id="site_description"
                                    name="site_description"
                                    rows="5"
                                ><?= e($formData['site_description']) ?></textarea>
                            </div>
                        </div>

                        <div class="settings-card">
                            <h3>Tùy chọn hệ thống</h3>

                            <div class="option-list">
                                <label class="option-item">
                                    <div class="option-text">
                                        <div class="option-title">Cho phép đăng ký mới</div>
                                        <div class="option-desc">Mở đăng ký tài khoản cho người dùng mới</div>
                                    </div>
                                    <input type="checkbox" name="allow_register" <?= $formData['allow_register'] ? 'checked' : '' ?>>
                                </label>

                                <label class="option-item">
                                    <div class="option-text">
                                        <div class="option-title">Bật thông báo email</div>
                                        <div class="option-desc">Gửi email tự động cho sự kiện quan trọng</div>
                                    </div>
                                    <input type="checkbox" name="enable_email" <?= $formData['enable_email'] ? 'checked' : '' ?>>
                                </label>

                                <label class="option-item">
                                    <div class="option-text">
                                        <div class="option-title">Chế độ bảo trì</div>
                                        <div class="option-desc">Tạm ẩn website khỏi người dùng công khai</div>
                                    </div>
                                    <input type="checkbox" name="maintenance_mode" <?= $formData['maintenance_mode'] ? 'checked' : '' ?>>
                                </label>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="save-btn">Lưu cài đặt</button>
                            </div>
                        </div>
                    </div>
                </form>

                <footer class="page-footer">
                    © <?= date('Y') ?> Mực Chuyển Động. Bảo lưu mọi quyền.
                </footer>
            </section>
        </main>
    </div>

    <script src="../../assets/js/admin/admin.js"></script>
    <script src="../../assets/js/admin/settings/settings.js"></script>
</body>
</html>