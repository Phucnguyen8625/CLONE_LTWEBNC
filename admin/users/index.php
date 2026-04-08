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

        return $_SESSION['admin_name'] ?? 'Admin Avatar';
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
$currentSection = 'users';
$currentPageTitle = 'User Directory';

function navItem(string $label, string $icon, string $href, string $key, string $currentSection): string
{
    $active = $key === $currentSection;
    $class = $active ? 'sidebar-link active' : 'sidebar-link';

    return '
        <a href="' . e($href) . '" class="' . $class . '">
            <span class="material-symbols-outlined sidebar-icon">' . e($icon) . '</span>
            <span>' . e($label) . '</span>
        </a>
    ';
}

$stats = [
    [
        'icon' => 'groups',
        'label' => 'TOTAL MEMBERS',
        'value' => '24,592',
        'meta' => '+12%',
        'cardClass' => 'stat-card warm',
        'iconClass' => 'icon-warm',
        'metaClass' => 'meta-warm',
    ],
    [
        'icon' => 'bolt',
        'label' => 'ACTIVE USERS',
        'value' => '1,204',
        'meta' => 'Live Now',
        'cardClass' => 'stat-card blue',
        'iconClass' => 'icon-blue',
        'metaClass' => 'meta-blue',
    ],
    [
        'icon' => 'stars',
        'label' => 'PREMIUM CONVERSION',
        'value' => '9,340',
        'meta' => '38% Rate',
        'cardClass' => 'stat-card olive',
        'iconClass' => 'icon-olive',
        'metaClass' => 'meta-olive',
    ],
];

$users = [
    [
        'name' => 'Miles Morales',
        'username' => '@brooklyn_ink',
        'email' => 'miles.m@spiderverse.com',
        'membership' => 'PREMIUM',
        'membership_class' => 'membership premium',
        'status' => 'Active',
        'status_class' => 'status active',
        'last_active' => '2 mins ago',
        'avatar' => 'MM',
        'avatar_class' => 'avatar avatar-miles',
    ],
    [
        'name' => 'Gwen Stacy',
        'username' => '@ghost_spider',
        'email' => 'g.stacy@earth65.org',
        'membership' => 'FREE',
        'membership_class' => 'membership free',
        'status' => 'Active',
        'status_class' => 'status active',
        'last_active' => '14 mins ago',
        'avatar' => 'GS',
        'avatar_class' => 'avatar avatar-gwen',
    ],
    [
        'name' => "Miguel O'Hara",
        'username' => '@spiderman_2099',
        'email' => 'miguel@alchemax.corp',
        'membership' => 'PREMIUM',
        'membership_class' => 'membership premium',
        'status' => 'Away',
        'status_class' => 'status away',
        'last_active' => '3 hours ago',
        'avatar' => 'MO',
        'avatar_class' => 'avatar avatar-miguel',
    ],
    [
        'name' => 'Jessica Drew',
        'username' => '@j_drew_bike',
        'email' => 'jd@web.com',
        'membership' => 'FREE',
        'membership_class' => 'membership free',
        'status' => 'Suspended',
        'status_class' => 'status suspended',
        'last_active' => '2 months ago',
        'avatar' => 'JD',
        'avatar_class' => 'avatar avatar-jessica',
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($currentPageTitle) ?></title>

    <link rel="stylesheet" href="../../assets/css/admin/adminStyle.css">
    <link rel="stylesheet" href="../../assets/css/admin/users/usersStyle.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>
<body>
<div class="admin-layout users-page">
    <aside class="sidebar">
        <div class="sidebar-top">
            <div class="brand-box">
                <div class="brand-title">Kinetic Admin</div>
                <div class="brand-subtitle">MARKETPLACE CONTROL</div>
            </div>

            <nav class="sidebar-menu">
                <?= navItem('Dashboard', 'dashboard', '../dashboard/index.php', 'dashboard', $currentSection) ?>
                <?= navItem('Sales', 'credit_card', '../sales/index.php', 'sales', $currentSection) ?>
                <?= navItem('Content', 'menu_book', '../content/index.php', 'content', $currentSection) ?>
                <?= navItem('Users', 'group', '../users/index.php', 'users', $currentSection) ?>
                <?= navItem('Settings', 'settings', '../settings/index.php', 'settings', $currentSection) ?>
            </nav>
        </div>

        <div class="sidebar-bottom">
            <button type="button" class="issue-btn">
                <span>+</span>Add New Issue
            </button>

            <div class="admin-profile">
                <div class="admin-avatar">
                    <span><?= e($adminInitials) ?></span>
                </div>
                <div>
                    <div class="admin-name"><?= e($adminName ?: 'Admin Avatar') ?></div>
                    <div class="admin-role">Super Admin</div>
                </div>
            </div>
        </div>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <div class="page-head">
                <h1 class="page-title">User Directory</h1>
                <nav class="subnav">
                    <a href="#" class="active">Directory</a>
                    <a href="#">Permissions</a>
                    <a href="#">Logs</a>
                </nav>
            </div>

            <div class="topbar-tools">
                <div class="search-box">
                    <span class="material-symbols-outlined">search</span>
                    <input type="text" placeholder="Search accounts...">
                </div>
                <span class="material-symbols-outlined tool-icon">notifications</span>
                <span class="material-symbols-outlined tool-icon">help</span>
            </div>
        </header>

        <section class="stats-grid">
            <?php foreach ($stats as $item): ?>
                <div class="<?= e($item['cardClass']) ?>">
                    <div class="stat-head">
                        <div class="stat-icon <?= e($item['iconClass']) ?>">
                            <span class="material-symbols-outlined"><?= e($item['icon']) ?></span>
                        </div>
                        <div class="stat-meta <?= e($item['metaClass']) ?>"><?= e($item['meta']) ?></div>
                    </div>
                    <div class="stat-label"><?= e($item['label']) ?></div>
                    <div class="stat-value"><?= e($item['value']) ?></div>
                </div>
            <?php endforeach; ?>

            <div class="growth-card">
                <div class="growth-top">
                    <div>
                        <div class="growth-label">GROWTH FORECAST</div>
                        <div class="growth-value">+5.2k</div>
                    </div>
                    <span class="material-symbols-outlined growth-trend-icon">trending_up</span>
                </div>

                <div class="growth-chart">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </section>

        <section class="section-card">
            <div class="section-header">
                <h2 class="section-title">User Directory</h2>

                <div class="table-actions">
                    <button type="button" class="action-btn">
                        <span class="material-symbols-outlined">filter_alt</span>
                        <span>Filter</span>
                    </button>

                    <button type="button" class="action-btn">
                        <span class="material-symbols-outlined">download</span>
                        <span>Export CSV</span>
                    </button>
                </div>
            </div>

            <div class="user-table-wrap">
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>USER</th>
                            <th>EMAIL</th>
                            <th>MEMBERSHIP</th>
                            <th>STATUS</th>
                            <th>LAST ACTIVE</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <div class="<?= e($user['avatar_class']) ?>">
                                            <?= e($user['avatar']) ?>
                                        </div>
                                        <div>
                                            <div class="user-name"><?= e($user['name']) ?></div>
                                            <div class="user-username"><?= e($user['username']) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td><?= e($user['email']) ?></td>
                                <td>
                                    <span class="<?= e($user['membership_class']) ?>">
                                        <?= e($user['membership']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="<?= e($user['status_class']) ?>">
                                        <?= e($user['status']) ?>
                                    </span>
                                </td>
                                <td><?= e($user['last_active']) ?></td>
                                <td>
                                    <span class="action-dots">···</span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="section-footer">
                <div>Showing 1 to 10 of 24,592 users</div>

                <div class="pagination">
                    <span class="page-btn">‹</span>
                    <span class="page-number active">1</span>
                    <span class="page-number">2</span>
                    <span class="page-number">3</span>
                    <span class="page-ellipsis">...</span>
                    <span class="page-number">2459</span>
                    <span class="page-btn">›</span>
                </div>
            </div>
        </section>

        <section class="bottom-grid">
            <div class="insight-card">
                <h3 class="insight-title">User Onboarding Insight</h3>
                <p class="insight-text">
                    New user registrations have spiked by 22% this week following the
                    "Spider-Punk #1" drop. Consider launching a Premium conversion
                    campaign targeting "Free" users with &gt; 5 items in their library.
                </p>

                <button type="button" class="campaign-btn">Generate Campaign</button>
            </div>

            <div class="storage-card">
                <div class="storage-title">STORAGE USAGE</div>
                <div class="storage-bar">
                    <div class="storage-fill"></div>
                </div>
                <div class="storage-value">1.2 TB / 2.0 TB</div>
                <div class="storage-status">SYSTEM STATUS: OPTIMAL</div>
            </div>
        </section>
    </main>
</div>

<script src="../../assets/js/admin/users/index.js"></script>
</body>
</html>