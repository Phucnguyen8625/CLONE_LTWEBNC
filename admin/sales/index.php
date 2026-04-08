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

$currentSection = 'sales';
$currentPageTitle = 'Quản trị Mực - Doanh số';

$pageHeading = 'Quản lý doanh số';
$pageDescription = 'Theo dõi doanh thu, đơn hàng và các giao dịch gần đây';

$summaryCards = [
    [
        'title' => 'TỔNG DOANH THU',
        'value' => '185.000.000₫',
        'desc' => 'Doanh thu ghi nhận trong tháng này',
        'tone' => 'stat-orange'
    ],
    [
        'title' => 'ĐƠN HÀNG THÀNH CÔNG',
        'value' => '1.248',
        'desc' => 'Số đơn đã thanh toán hoàn tất',
        'tone' => 'stat-green'
    ],
    [
        'title' => 'ĐƠN ĐANG XỬ LÝ',
        'value' => '36',
        'desc' => 'Đơn hàng đang chờ xác nhận hoặc giao',
        'tone' => 'stat-dark'
    ],
    [
        'title' => 'TỶ LỆ HOÀN TIỀN',
        'value' => '1.8%',
        'desc' => 'Tỷ lệ hoàn tiền trong 30 ngày gần nhất',
        'tone' => 'stat-red'
    ],
];

$salesData = [
    [
        'id' => 'DH001',
        'customer' => 'Nguyễn Minh Anh',
        'product' => 'Gói Premium 1 tháng',
        'amount' => '199.000₫',
        'status' => 'Hoàn tất'
    ],
    [
        'id' => 'DH002',
        'customer' => 'Trần Khánh Linh',
        'product' => 'Combo truyện nổi bật',
        'amount' => '349.000₫',
        'status' => 'Đang xử lý'
    ],
    [
        'id' => 'DH003',
        'customer' => 'Lê Thành Nam',
        'product' => 'Gói Premium 6 tháng',
        'amount' => '899.000₫',
        'status' => 'Hoàn tất'
    ],
    [
        'id' => 'DH004',
        'customer' => 'Phạm Thu Hà',
        'product' => 'Gói thành viên thường niên',
        'amount' => '1.499.000₫',
        'status' => 'Hoàn tiền'
    ],
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

function salesStatusClass(string $status): string
{
    return match ($status) {
        'Hoàn tất' => 'status-complete',
        'Đang xử lý' => 'status-processing',
        'Hoàn tiền' => 'status-refund',
        default => 'status-default',
    };
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
    <link rel="stylesheet" href="../../assets/css/admin/sales/salesStyle.css">
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

            <section class="sales-wrapper">
                <div class="stats-grid">
                    <?php foreach ($summaryCards as $item): ?>
                        <div class="stat-card">
                            <p class="stat-label"><?= e($item['title']) ?></p>
                            <h3 class="stat-value <?= e($item['tone']) ?>"><?= e($item['value']) ?></h3>
                            <p class="stat-note"><?= e($item['desc']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="sales-card">
                    <div class="sales-card-header">
                        <div>
                            <h3>Danh sách giao dịch</h3>
                            <p>Theo dõi các đơn hàng và trạng thái thanh toán gần đây.</p>
                        </div>

                        <div class="sales-tools">
                            <div class="search-box">
                                <span class="material-symbols-outlined">search</span>
                                <input type="text" id="salesSearch" placeholder="Tìm theo mã đơn, khách hàng hoặc sản phẩm...">
                            </div>
                        </div>
                    </div>

                    <div class="table-wrap">
                        <table class="sales-table">
                            <thead>
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Khách hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Số tiền</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody id="salesTableBody">
                                <?php foreach ($salesData as $item): ?>
                                    <tr>
                                        <td class="sales-id"><?= e($item['id']) ?></td>
                                        <td class="sales-customer"><?= e($item['customer']) ?></td>
                                        <td class="sales-product"><?= e($item['product']) ?></td>
                                        <td class="sales-amount"><?= e($item['amount']) ?></td>
                                        <td>
                                            <span class="status-badge <?= e(salesStatusClass($item['status'])) ?>">
                                                <?= e($item['status']) ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="empty-state" id="emptyState">
                        Không tìm thấy giao dịch phù hợp.
                    </div>
                </div>

                <footer class="page-footer">
                    © <?= date('Y') ?> Mực Chuyển Động. Bảo lưu mọi quyền.
                </footer>
            </section>
        </main>
    </div>

    <script src="../../assets/js/admin/admin.js"></script>
    <script src="../../assets/js/admin/sales/sales.js"></script>
</body>
</html>