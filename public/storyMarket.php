<?php
$pageTitle = 'Chợ truyện';
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

$goiNoiBat = [
    [
        'id' => 1,
        'ten' => 'Kẻ lữ hành neon',
        'gia' => 'Giảm còn 99.000 đồng',
        'ghiChu' => 'Ưu đãi cuối tuần',
        'anh' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAes87Fv5ozt2posbJn-K-iVS9kdI2gA2w2VgU12Fe-acGIm64WMFPwzCIQBCOXXHCGAI6Oj0rAlEVV6rgi3aG9j4ov6n2Y_9aSsHW55sZOiW6C2KIrKdnCOkAQ0-qPFLC7n8hT6zPmvo1-OEqDJspIBPIcdklGrs_83aD9K5lHfaHnGKIywWPmU6m7ASG9dVMNFvrG9S_1Fqd_SZuVT3qMURikJNjtdnhQ5Ag9Q-tvua32LaBzVcuAxMtbZ5HiThKDjsdboPIMwmaH',
    ],
    [
        'id' => 2,
        'ten' => 'Vua tro lửa',
        'gia' => 'Combo 2 tập 269.000 đồng',
        'ghiChu' => 'Bán chạy nhất',
        'anh' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAF4Z1YV7iRpcusut8Rxv0dI4RD77Cn1IjLEmka9811sO_PhaOFRftDDPtxKaVLbunOeHaH-JLxN_Xx1Q5B-sF_IgPNw9lLLH3o4jeyEbcVQ-gOHXMhuLQ9LFUttFO1EzGBq4dsw4i3DlMJqSD3AnQwqY0hHCK9QAaszs0iWov-70pTJ9-9bl8uZ9cSqFlQ0rVI_WJoQrTHaUTaIyU_tWRV8FqFfuxDaMhtlvFd-2IMt2nL5qoLwQZcrg08IDuG79KUkaJ60BFcOYVE',
    ],
    [
        'id' => 4,
        'ten' => 'Lữ khách hư không',
        'gia' => 'Giá sốc 89.000 đồng',
        'ghiChu' => 'Số lượng có hạn',
        'anh' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBcQd0sG7zY_KKVmwvpnlIylcPEVxNZGetOKUj8jU4Wah3FTAvriKUnSOoXgCwhW5gBQbubBPUMRodAvxupTpzstCPBwxjS3u62QVmZdHvCN1ShREVEDKQchmjJlFc3uBbzg4nxI0KmYgt9aj4VPtqZB3At7hIt9R9wYJE9L-4lZ18jzJ7yGrLhi6_DTxgnYqR53uFoftebq2RNqBmYz8PbreOHzc5K2qMy6U-UEf2bSmYCeHEWqiajJlCgPXU0SuHNq2y_efRi6_jL',
    ],
];

$ngheSi = [
    ['ten' => 'Aoi Vector', 'moTa' => 'Chuyên khoa học viễn tưởng với nhịp kể nhanh và hình ảnh giàu năng lượng.'],
    ['ten' => 'Linh Flame', 'moTa' => 'Kỳ ảo cổ điển pha cảm xúc hiện đại và xây dựng thế giới rất chi tiết.'],
    ['ten' => 'Mộc Lam', 'moTa' => 'Truyện phiêu lưu chữa lành với bối cảnh thiên nhiên mềm mại, thơ mộng.'],
];

$featured = $goiNoiBat[0];
$topPicks = $goiNoiBat;

$newMain = [
    'id' => 3,
    'ten' => 'Trái tim mạng',
    'moTa' => 'Cỗ máy tiên tiến nhất từng được tạo ra đang che giấu một bí mật: nó có thể mơ.',
    'nut' => 'Nhận chương 1',
    'anh' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1200&q=80',
];

$newSide = [
    [
        'ten' => 'Bóng ma Kyoto',
        'moTa' => 'Những linh hồn hiện đại trong một thế giới neon.',
        'gia' => 'Mua 49.000 đồng →',
        'id' => 1,
    ],
    [
        'ten' => 'Sắt gỉ và đường xa',
        'moTa' => 'Tay đua vùng hoang tàn hậu tận thế.',
        'gia' => 'Mua 49.000 đồng →',
        'id' => 4,
    ],
];

$creatorSpotlights = [
    ['ten' => 'Kaelen Vox', 'vaiTro' => 'BIÊN KỊCH • 12 TÁC PHẨM'],
    ['ten' => 'M. J. Aris', 'vaiTro' => 'HỌA SĨ CHÍNH'],
    ['ten' => 'Luna Shade', 'vaiTro' => 'NGƯỜI PHỐI MÀU • NGÔI SAO MỚI'],
    ['ten' => 'S. J. Thorne', 'vaiTro' => 'THIẾT KẾ CỐT TRUYỆN'],
];

$giaTopPicks = [
    1 => '89.000 đồng',
    2 => '269.000 đồng',
    4 => '99.000 đồng',
];

$metaTopPicks = [
    1 => 'KHOA HỌC VIỄN TƯỞNG • TẬP 42',
    2 => 'KỲ ẢO • QUYỂN 1',
    4 => 'HÀNH ĐỘNG • TẬP 12',
];

$anhFeatured = 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=1200&q=80';

function lay2ChuDau(string $ten): string
{
    $parts = preg_split('/\s+/u', trim($ten));
    $chu = '';

    foreach ($parts as $part) {
        if ($part !== '') {
            $chu .= mb_strtoupper(mb_substr($part, 0, 1, 'UTF-8'), 'UTF-8');
        }
        if (mb_strlen($chu, 'UTF-8') >= 2) {
            break;
        }
    }

    return $chu !== '' ? $chu : 'KI';
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($pageTitle); ?></title>
    <link rel="stylesheet" href="../assets/css/public/storyMarketStyle.css">
</head>
<body>
    <div class="page">
        <header class="header">
            <div class="header-left">
                <div class="brand">KINETIC INK</div>

                <nav class="nav">
                    <a href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/Index.php') : 'Index.php'; ?>">Khám phá</a>
                    <a href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/Library.php') : 'Library.php'; ?>">Thư viện</a>
                    <a href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/StoryMarket.php') : 'StoryMarket.php'; ?>" class="active">Chợ truyện</a>
                </nav>
            </div>

            <div class="header-tools">
                <div class="search-box">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="m20 20-3.5-3.5"></path>
                    </svg>
                    <input type="text" placeholder="Tìm kiếm truyện...">
                </div>

                <a class="tool-link" href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/List.php') : 'List.php'; ?>" title="Tủ truyện">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="20" r="1"></circle>
                        <circle cx="18" cy="20" r="1"></circle>
                        <path d="M3 4h2l2.6 10.4a2 2 0 0 0 1.94 1.6h8.96a2 2 0 0 0 1.94-1.52L22 7H7"></path>
                    </svg>
                </a>

                <a class="tool-link" href="#" title="Hồ sơ">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21a8 8 0 1 0-16 0"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </a>
            </div>
        </header>

        <section class="hero-wrap">
            <div class="hero">
                <div class="hero-copy">
                    <div class="hero-badge">Tác phẩm nổi bật</div>

                    <h1 class="hero-title">
                        Kiếm sĩ
                        <em>Neon</em>
                    </h1>

                    <p class="hero-text">
                        Phần tiếp theo của thiên sử cyber-noir đã chính thức trở lại. Hãy trải nghiệm phong cách hình ảnh đậm chất truyện tranh và mạch kể bùng nổ của bộ truyện được mong chờ nhất năm nay.
                    </p>

                    <div class="hero-actions">
                        <a class="btn-primary" href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/List.php?add=' . (int) $featured['id']) : 'List.php?add=' . (int) $featured['id']; ?>">
                            Đặt trước ngay - 129.000 đồng
                        </a>
                        <a class="btn-secondary" href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/Main.php?id=' . (int) $featured['id']) : 'Main.php?id=' . (int) $featured['id']; ?>">
                            Xem giới thiệu
                        </a>
                    </div>
                </div>

                <div class="hero-art-wrap">
                    <div class="hero-art">
                        <img src="<?php echo e($anhFeatured); ?>" alt="Kiếm sĩ Neon">
                    </div>
                    <div class="hero-art-shadow"></div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="section-inner">
                <div class="section-head">
                    <div>
                        <h2 class="section-title">Lựa chọn nổi bật hôm nay</h2>
                        <div class="section-underline"></div>
                    </div>
                    <a href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/Library.php') : 'Library.php'; ?>" class="section-link">Xem tất cả</a>
                </div>

                <div class="cards-grid">
                    <?php foreach ($topPicks as $item): ?>
                        <article class="store-card">
                            <a href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/Main.php?id=' . (int) $item['id']) : 'Main.php?id=' . (int) $item['id']; ?>">
                                <div class="card-cover">
                                    <img src="<?php echo e($item['anh']); ?>" alt="<?php echo e($item['ten']); ?>">
                                    <div class="price-pill"><?php echo e($giaTopPicks[$item['id']] ?? '99.000 đồng'); ?></div>
                                </div>
                            </a>

                            <h3 class="card-title"><?php echo e($item['ten']); ?></h3>
                            <p class="card-meta"><?php echo e($metaTopPicks[$item['id']] ?? strtoupper($item['ghiChu'])); ?></p>
                            <a class="buy-btn" href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/List.php?add=' . (int) $item['id']) : 'List.php?add=' . (int) $item['id']; ?>">Mua ngay</a>
                        </article>
                    <?php endforeach; ?>
                </div>

                <div class="vault">
                    <div class="vault-box">
                        <div class="vault-copy">
                            <h3>Truy cập không giới hạn vào kho truyện</h3>
                            <p>
                                Tham gia Kinetic Ink Collective để nhận quyền truy cập vào hơn 10.000 tập truyện, các bản phát hành sớm và nội dung độc quyền từ tác giả với một mức phí hàng tháng tiết kiệm.
                            </p>

                            <div class="vault-actions">
                                <a class="trial" href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/Register.php') : 'Register.php'; ?>">Dùng thử miễn phí</a>
                                <a class="learn" href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/Library.php') : 'Library.php'; ?>">Tìm hiểu thêm</a>
                            </div>
                        </div>

                        <div class="vault-art" aria-hidden="true">
                            <div class="vault-card card-1"></div>
                            <div class="vault-card card-2"></div>
                            <div class="vault-card card-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="newly-inked">
            <div class="section-inner">
                <div>
                    <h2 class="section-title">Truyện mới ra mắt</h2>
                    <div class="section-underline newly-underline"></div>
                </div>

                <div class="newly-grid">
                    <div class="new-main">
                        <div class="new-main-copy">
                            <div class="mini-badge">Bộ truyện hoàn toàn mới</div>
                            <h3><?php echo e($newMain['ten']); ?></h3>
                            <p><?php echo e($newMain['moTa']); ?></p>
                            <a href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/Main.php?id=' . (int) $newMain['id']) : 'Main.php?id=' . (int) $newMain['id']; ?>">
                                <?php echo e($newMain['nut']); ?>
                            </a>
                        </div>

                        <div class="new-main-art">
                            <img src="<?php echo e($newMain['anh']); ?>" alt="<?php echo e($newMain['ten']); ?>">
                        </div>
                    </div>

                    <div class="new-side">
                        <?php foreach ($newSide as $side): ?>
                            <div class="side-product">
                                <div>
                                    <h4><?php echo e($side['ten']); ?></h4>
                                    <p><?php echo e($side['moTa']); ?></p>
                                </div>

                                <a href="<?php echo defined('PUBLIC_URL') ? e(PUBLIC_URL . '/List.php?add=' . (int) $side['id']) : 'List.php?add=' . (int) $side['id']; ?>">
                                    <?php echo e($side['gia']); ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="spotlights">
            <div class="section-inner">
                <div class="spotlights-title">
                    <h3>Gương mặt tác giả nổi bật</h3>
                    <p>Gặp gỡ những người tạo nên thế giới truyện đầy màu sắc.</p>
                </div>

                <div class="creators">
                    <?php foreach ($creatorSpotlights as $creator): ?>
                        <div class="creator">
                            <div class="creator-avatar"><?php echo e(lay2ChuDau($creator['ten'])); ?></div>
                            <div class="creator-name"><?php echo e($creator['ten']); ?></div>
                            <div class="creator-role"><?php echo e($creator['vaiTro']); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <footer class="footer">
            <div class="footer-inner">
                <div class="footer-left">
                    <strong>Kinetic Ink</strong>
                    <span>© 2024 Kinetic Ink Publishing Group. Bảo lưu mọi quyền.</span>
                </div>

                <div class="footer-links">
                    <a href="#">Điều khoản dịch vụ</a>
                    <a href="#">Chính sách bảo mật</a>
                    <a href="#">Cổng nhà xuất bản</a>
                    <a href="#">Quỹ tác giả</a>
                </div>

                <div class="footer-right">
                    <span class="round-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="18" cy="5" r="3"></circle>
                            <circle cx="6" cy="12" r="3"></circle>
                            <circle cx="18" cy="19" r="3"></circle>
                            <path d="M8.59 13.51 15.42 17.49"></path>
                            <path d="M15.41 6.51 8.59 10.49"></path>
                        </svg>
                    </span>

                    <span class="round-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </span>
                </div>
            </div>
        </footer>
    </div>

    <script src="../assets/js/public/storyMarket.js"></script>
</body>
</html>