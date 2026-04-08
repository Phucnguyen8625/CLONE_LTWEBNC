<?php
$pageTitle = 'Thư viện truyện';
require_once __DIR__ . '/../config/WebConfig.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!function_exists('kiemTraDangNhapNguoiDung')) {
    function kiemTraDangNhapNguoiDung(): bool
    {
        return !empty($_SESSION['user_logged_in']) || !empty($_SESSION['user']);
    }
}

if (!kiemTraDangNhapNguoiDung()) {
    header('Location: ' . (defined('PUBLIC_URL') ? PUBLIC_URL . '/Login.php' : 'Login.php'));
    exit;
}

$tuKhoa = trim($_GET['q'] ?? '');
$theLoaiDangChon = trim($_GET['genre'] ?? 'Tất cả');

$danhSachTruyen = [
    [
        'id' => 1,
        'ten' => 'Kẻ lữ hành neon',
        'gia' => '119.000 đồng',
        'theLoai' => 'Khoa học viễn tưởng',
        'tacGia' => 'Aoi Vector',
        'moTa' => 'Một đội săn ký ức băng qua những đại lộ phát sáng để cứu thành phố khỏi sự sụp đổ dữ liệu.',
        'anh' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAes87Fv5ozt2posbJn-K-iVS9kdI2gA2w2VgU12Fe-acGIm64WMFPwzCIQBCOXXHCGAI6Oj0rAlEVV6rgi3aG9j4ov6n2Y_9aSsHW55sZOiW6C2KIrKdnCOkAQ0-qPFLC7n8hT6zPmvo1-OEqDJspIBPIcdklGrs_83aD9K5lHfaHnGKIywWPmU6m7ASG9dVMNFvrG9S_1Fqd_SZuVT3qMURikJNjtdnhQ5Ag9Q-tvua32LaBzVcuAxMtbZ5HiThKDjsdboPIMwmaH',
    ],
    [
        'id' => 2,
        'ten' => 'Vua tro lửa',
        'gia' => '299.000 đồng',
        'theLoai' => 'Kỳ ảo',
        'tacGia' => 'Linh Flame',
        'moTa' => 'Vương quốc tro tàn trỗi dậy cùng vị vua mang ngọn lửa của lời tiên tri cổ xưa.',
        'anh' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAF4Z1YV7iRpcusut8Rxv0dI4RD77Cn1IjLEmka9811sO_PhaOFRftDDPtxKaVLbunOeHaH-JLxN_Xx1Q5B-sF_IgPNw9lLLH3o4jeyEbcVQ-gOHXMhuLQ9LFUttFO1EzGBq4dsw4i3DlMJqSD3AnQwqY0hHCK9QAaszs0iWov-70pTJ9-9bl8uZ9cSqFlQ0rVI_WJoQrTHaUTaIyU_tWRV8FqFfuxDaMhtlvFd-2IMt2nL5qoLwQZcrg08IDuG79KUkaJ60BFcOYVE',
    ],
    [
        'id' => 3,
        'ten' => 'Rêu và ánh trăng',
        'gia' => '79.000 đồng',
        'theLoai' => 'Phiêu lưu',
        'tacGia' => 'Mộc Lam',
        'moTa' => 'Một cô gái trẻ băng qua khu rừng cổ để tìm chiếc đèn có thể soi ra bí mật của mặt trăng.',
        'anh' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB2Pa5W0ejbol_UBuCHJF7Qj3nlV1kYH-_GsI-iVNaUaCDfcbsG-ZkvH0gs7Rx3Cm44Br1TpnzU8DEnYhzbnlPzmxAjK6p3D8yXyq46WkTPVKOjdYb5hi1hQqZrhwUU7c0x4hoi9HZ0pmilhJS43jtSUmi6z0QkV42xRH-oBnbG9bQCKoSxMu95pOcDGBkZ1dw6Pn0TwUo77VuIYoKsVoo569KaAo6d78hn4K-P6sWpiaLiL6Bh7C1jm8DQzMjNOFOf_XOuCCcGZpWL',
    ],
    [
        'id' => 4,
        'ten' => 'Lữ khách hư không',
        'gia' => '99.000 đồng',
        'theLoai' => 'Hành động',
        'tacGia' => 'K. Orion',
        'moTa' => 'Một phi hành đoàn trẻ tuổi đối đầu với vùng chân không có thể nuốt chửng ký ức.',
        'anh' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBcQd0sG7zY_KKVmwvpnlIylcPEVxNZGetOKUj8jU4Wah3FTAvriKUnSOoXgCwhW5gBQbubBPUMRodAvxupTpzstCPBwxjS3u62QVmZdHvCN1ShREVEDKQchmjJlFc3uBbzg4nxI0KmYgt9aj4VPtqZB3At7hIt9R9wYJE9L-4lZ18jzJ7yGrLhi6_DTxgnYqR53uFoftebq2RNqBmYz8PbreOHzc5K2qMy6U-UEf2bSmYCeHEWqiajJlCgPXU0SuHNq2y_efRi6_jL',
    ],
];

$theLoai = ['Tất cả', 'Khoa học viễn tưởng', 'Kỳ ảo', 'Phiêu lưu', 'Hành động'];

$truyenDaLoc = array_values(array_filter($danhSachTruyen, function ($truyen) use ($tuKhoa, $theLoaiDangChon) {
    $hopTuKhoa = $tuKhoa === ''
        || stripos($truyen['ten'], $tuKhoa) !== false
        || stripos($truyen['tacGia'], $tuKhoa) !== false
        || stripos($truyen['theLoai'], $tuKhoa) !== false;

    $hopTheLoai = $theLoaiDangChon === 'Tất cả' || $theLoaiDangChon === $truyen['theLoai'];

    return $hopTuKhoa && $hopTheLoai;
}));

$tenNguoiDung = $_SESSION['user']['name'] ?? $_SESSION['user_name'] ?? 'Hồ sơ bạn đọc';
$truyenTiepTuc = !empty($truyenDaLoc) ? $truyenDaLoc[0] : $danhSachTruyen[0];

$trangThaiDoc = [
    1 => ['label' => 'ĐÃ HOÀN THÀNH', 'percent' => 100],
    2 => ['label' => 'ĐÃ ĐỌC 45%', 'percent' => 45],
    3 => ['label' => 'VỪA BẮT ĐẦU', 'percent' => 18],
    4 => ['label' => 'SẮP ĐỌC XONG', 'percent' => 88],
];

function taoAvatarSvgDataUri(string $name): string
{
    $svg = '
    <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 120 120">
        <rect width="120" height="120" rx="18" fill="#ffffff"/>
        <rect x="1.5" y="1.5" width="117" height="117" rx="16.5" fill="none" stroke="#c95a17" stroke-width="3"/>
        <circle cx="60" cy="42" r="18" fill="#2f2f2f"/>
        <path d="M30 96c6-18 19-28 30-28s24 10 30 28" fill="#111827"/>
        <rect x="48" y="62" width="24" height="20" rx="4" fill="#ffffff"/>
        <text x="60" y="114" text-anchor="middle" font-family="Arial, sans-serif" font-size="8" fill="#7b341e">' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</text>
    </svg>';

    return 'data:image/svg+xml;charset=UTF-8,' . rawurlencode($svg);
}

$avatarSrc = taoAvatarSvgDataUri($tenNguoiDung);

function taoLinkGenre(string $genre, string $tuKhoa): string
{
    $params = ['genre' => $genre];

    if ($tuKhoa !== '') {
        $params['q'] = $tuKhoa;
    }

    return '?' . http_build_query($params);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($pageTitle); ?></title>
    <link rel="stylesheet" href="../assets/css/public/libraryStyle.css">
</head>
<body>
    <div class="page">
        <aside class="sidebar">
            <div class="sidebar-top">
                <div class="profile-box">
                    <div class="profile-avatar-wrap">
                        <img src="<?php echo $avatarSrc; ?>" alt="<?php echo e($tenNguoiDung); ?>">
                    </div>
                    <div class="profile-name"><?php echo e($tenNguoiDung); ?></div>
                    <div class="profile-level">CẤP ĐỘ MỰC: BẬC THẦY</div>
                </div>

                <nav class="side-menu">
                    <a href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/Index.php') : 'Index.php'; ?>" class="side-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="9"></circle>
                            <path d="M12 7v5l3 2"></path>
                        </svg>
                        <span>Khám phá</span>
                    </a>

                    <a href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/Library.php') : 'Library.php'; ?>" class="side-link active">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 5.5C3 4.67 3.67 4 4.5 4H10a3 3 0 0 1 3 3v13a2.5 2.5 0 0 0-2.5-2.5H3z"></path>
                            <path d="M21 5.5C21 4.67 20.33 4 19.5 4H14a3 3 0 0 0-3 3v13a2.5 2.5 0 0 1 2.5-2.5H21z"></path>
                        </svg>
                        <span>Thư viện</span>
                    </a>

                    <a href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/StoryMarket.php') : 'StoryMarket.php'; ?>" class="side-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 7h18"></path>
                            <path d="M6 7V5a2 2 0 0 1 2-2h1"></path>
                            <path d="M18 7v12a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V7"></path>
                            <path d="M9 11h6"></path>
                        </svg>
                        <span>Chợ truyện</span>
                    </a>
                </nav>
            </div>

            <div class="sidebar-bottom">
                <button type="button" class="token-btn">MUA TOKEN</button>

                <div class="tiny-links">
                    <a href="Setting.php">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33h.01A1.65 1.65 0 0 0 10 3.09V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51h.01a1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82v.01a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                        <span>Cài đặt</span>
                    </a>

                    <a href="#">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="9"></circle>
                            <path d="M9.09 9a3 3 0 1 1 5.82 1c0 2-3 3-3 3"></path>
                            <path d="M12 17h.01"></path>
                        </svg>
                        <span>Hỗ trợ</span>
                    </a>
                </div>
            </div>
        </aside>

        <header class="header">
            <div class="header-left">
                <div class="brand">KINETIC INK</div>

                <nav class="top-nav">
                    <a href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/Index.php') : 'Index.php'; ?>">Khám phá</a>
                    <a href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/Library.php') : 'Library.php'; ?>" class="active">Thư viện</a>
                    <a href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/StoryMarket.php') : 'StoryMarket.php'; ?>">Chợ truyện</a>
                </nav>
            </div>

            <div class="header-tools">
                <form class="search-form" method="get">
                    <input type="text" name="q" value="<?php echo e($tuKhoa); ?>" placeholder="Tìm kiếm trong bộ sưu tập...">
                    <input type="hidden" name="genre" value="<?php echo e($theLoaiDangChon); ?>">
                </form>

                <a class="icon-link" href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/List.php') : 'List.php'; ?>" title="Tủ truyện">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="20" r="1"></circle>
                        <circle cx="18" cy="20" r="1"></circle>
                        <path d="M3 4h2l2.6 10.4a2 2 0 0 0 1.94 1.6h8.96a2 2 0 0 0 1.94-1.52L22 7H7"></path>
                    </svg>
                </a>

                <a class="icon-link" href="#" title="Hồ sơ">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21a8 8 0 1 0-16 0"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </a>
            </div>
        </header>

        <main class="main">
            <section class="hero">
                <div class="hero-content">
                    <div class="hero-tag">TIẾP TỤC ĐỌC</div>
                    <h1><?php echo e($truyenTiepTuc['ten']); ?></h1>
                    <p><?php echo e($truyenTiepTuc['moTa']); ?></p>

                    <div class="hero-actions">
                        <a class="hero-btn" href="<?php echo PUBLIC_URL; ?>/Main.php?id=<?php echo (int) $truyenTiepTuc['id']; ?>">
                            Đọc tiếp
                        </a>

                        <div class="hero-progress-wrap">
                            <div class="hero-progress-label">Hoàn thành 84%</div>
                            <div class="hero-progress-bar">
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hero-art">
                    <img src="<?php echo e($truyenTiepTuc['anh']); ?>" alt="<?php echo e($truyenTiepTuc['ten']); ?>">
                </div>
            </section>

            <div class="filter-tabs">
                <?php foreach ($theLoai as $item): ?>
                    <a
                        href="<?php echo e(taoLinkGenre($item, $tuKhoa)); ?>"
                        class="<?php echo $theLoaiDangChon === $item ? 'active' : ''; ?>"
                    >
                        <?php echo e($item); ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <?php if (!empty($truyenDaLoc)): ?>
                <div class="cards">
                    <?php foreach ($truyenDaLoc as $truyen): ?>
                        <?php
                            $progress = $trangThaiDoc[$truyen['id']] ?? ['label' => 'ĐANG ĐỌC', 'percent' => 55];
                        ?>
                        <article class="comic-card">
                            <div class="comic-thumb">
                                <img src="<?php echo e($truyen['anh']); ?>" alt="<?php echo e($truyen['ten']); ?>">

                                <div class="card-progress">
                                    <div class="card-progress-label"><?php echo e($progress['label']); ?></div>
                                    <div class="card-progress-track">
                                        <span style="width: <?php echo (int) $progress['percent']; ?>%;"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="comic-info">
                                <div class="comic-title"><?php echo e($truyen['ten']); ?></div>
                                <div class="comic-meta">
                                    <?php echo e($truyen['gia']); ?> • <?php echo e($truyen['theLoai']); ?>
                                </div>

                                <div class="comic-actions">
                                    <a class="comic-btn primary" href="<?php echo PUBLIC_URL; ?>/Main.php?id=<?php echo (int) $truyen['id']; ?>">
                                        Chi tiết
                                    </a>
                                    <a class="comic-btn secondary" href="<?php echo PUBLIC_URL; ?>/List.php?add=<?php echo (int) $truyen['id']; ?>">
                                        Lưu truyện
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-box">
                    Không tìm thấy truyện phù hợp. Hãy thử từ khóa khác hoặc đổi thể loại.
                </div>
            <?php endif; ?>
        </main>

        <footer class="footer">
            <div class="footer-left">
                <strong>KINETIC INK</strong>
                <span>© 2024 Kinetic Ink Publishing Group. Bảo lưu mọi quyền.</span>
            </div>

            <div class="footer-links">
                <a href="#">Điều khoản dịch vụ</a>
                <a href="#">Chính sách bảo mật</a>
                <a href="#">Cổng nhà xuất bản</a>
                <a href="#">Quỹ tác giả</a>
            </div>
        </footer>
    </div>

    <script src="../assets/js/public/library.js"></script>
</body>
</html>