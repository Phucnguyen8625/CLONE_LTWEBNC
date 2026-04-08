<?php
$pageTitle = 'Tủ truyện của tôi';
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

$danhSachTruyen = [
    1 => [
        'id' => 1,
        'ten' => 'Neon Drifters',
        'gia' => '119.000đ',
        'theLoai' => 'Khoa học viễn tưởng',
        'anh' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAes87Fv5ozt2posbJn-K-iVS9kdI2gA2w2VgU12Fe-acGIm64WMFPwzCIQBCOXXHCGAI6Oj0rAlEVV6rgi3aG9j4ov6n2Y_9aSsHW55sZOiW6C2KIrKdnCOkAQ0-qPFLC7n8hT6zPmvo1-OEqDJspIBPIcdklGrs_83aD9K5lHfaHnGKIywWPmU6m7ASG9dVMNFvrG9S_1Fqd_SZuVT3qMURikJNjtdnhQ5Ag9Q-tvua32LaBzVcuAxMtbZ5HiThKDjsdboPIMwmaH',
    ],
    2 => [
        'id' => 2,
        'ten' => 'The Ember King',
        'gia' => '299.000đ',
        'theLoai' => 'Kỳ ảo',
        'anh' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAF4Z1YV7iRpcusut8Rxv0dI4RD77Cn1IjLEmka9811sO_PhaOFRftDDPtxKaVLbunOeHaH-JLxN_Xx1Q5B-sF_IgPNw9lLLH3o4jeyEbcVQ-gOHXMhuLQ9LFUttFO1EzGBq4dsw4i3DlMJqSD3AnQwqY0hHCK9QAaszs0iWov-70pTJ9-9bl8uZ9cSqFlQ0rVI_WJoQrTHaUTaIyU_tWRV8FqFfuxDaMhtlvFd-2IMt2nL5qoLwQZcrg08IDuG79KUkaJ60BFcOYVE',
    ],
    3 => [
        'id' => 3,
        'ten' => 'Moss & Moonlight',
        'gia' => '79.000đ',
        'theLoai' => 'Phiêu lưu',
        'anh' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB2Pa5W0ejbol_UBuCHJF7Qj3nlV1kYH-_GsI-iVNaUaCDfcbsG-ZkvH0gs7Rx3Cm44Br1TpnzU8DEnYhzbnlPzmxAjK6p3D8yXyq46WkTPVKOjdYb5hi1hQqZrhwUU7c0x4hoi9HZ0pmilhJS43jtSUmi6z0QkV42xRH-oBnbG9bQCKoSxMu95pOcDGBkZ1dw6Pn0TwUo77VuIYoKsVoo569KaAo6d78hn4K-P6sWpiaLiL6Bh7C1jm8DQzMjNOFOf_XOuCCcGZpWL',
    ],
    4 => [
        'id' => 4,
        'ten' => 'Void Voyager',
        'gia' => '99.000đ',
        'theLoai' => 'Hành động',
        'anh' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAnjPfEs2MPobkLFO3nrDCZ24_0ws6hwpusSltcYtPYHqgxfGHs-EwrF0lATV8Pum1N0SoQ1XJrpFdS_STT5PU7kA27FsCKxjNT6_WVNxlCUsl7kzciCy_21lcqO_ZFeb7tTCn7WZtKogyhDBkFBEmOuwDNjHwgeDlPdpesX2pX7BgJOuqqcnddwLd-L-vcllayn0TN-r3xKUn5hNdIv2_Ud5D3bKczICfq2yKhivKwjiA2k6CFi0gu77eDUm-V4W1Ol7K-VtvpNk-nB',
    ],
];

if (!isset($_SESSION['user_library']) || !is_array($_SESSION['user_library'])) {
    $_SESSION['user_library'] = [1, 3];
}

$thongBao = '';
$themId = isset($_GET['add']) ? (int) $_GET['add'] : 0;
$xoaId = isset($_GET['remove']) ? (int) $_GET['remove'] : 0;

if ($themId > 0 && isset($danhSachTruyen[$themId])) {
    if (!in_array($themId, $_SESSION['user_library'], true)) {
        $_SESSION['user_library'][] = $themId;
        $thongBao = 'Đã thêm "' . $danhSachTruyen[$themId]['ten'] . '" vào tủ truyện.';
    } else {
        $thongBao = 'Truyện này đã có sẵn trong tủ truyện của bạn.';
    }
}

if ($xoaId > 0) {
    $_SESSION['user_library'] = array_values(array_filter($_SESSION['user_library'], fn ($id) => (int) $id !== $xoaId));
    $thongBao = 'Đã xóa truyện khỏi tủ truyện.';
}

$tuTruyen = [];
foreach ($_SESSION['user_library'] as $id) {
    if (isset($danhSachTruyen[$id])) {
        $tuTruyen[] = $danhSachTruyen[$id];
    }
}

require_once __DIR__ . '/../include/user/UserHeader.php';
?>

<link rel="stylesheet" href="../assets/css/public/listStyle.css">

<section class="my-library-section">
    <div class="list-container">
        <div class="list-header">
            <div>
                <h1 class="headline list-title">Tủ truyện của tôi</h1>
                <p class="list-subtitle">Những bộ truyện bạn đã lưu từ trang chủ, thư viện hoặc chợ truyện đều sẽ xuất hiện ở đây.</p>
            </div>
            <a href="<?php echo PUBLIC_URL; ?>/Library.php" class="list-add-btn">
                Thêm truyện mới
            </a>
        </div>

        <?php if ($thongBao !== ''): ?>
            <div class="list-notice">
                <?php echo e($thongBao); ?>
            </div>
        <?php endif; ?>

        <div class="list-layout">
            <div class="list-main">
                <?php foreach ($tuTruyen as $truyen): ?>
                    <div class="saved-story-card">
                        <img src="<?php echo e($truyen['anh']); ?>" alt="<?php echo e($truyen['ten']); ?>" class="saved-story-image">

                        <div class="saved-story-content">
                            <div class="saved-story-top">
                                <span class="saved-story-genre">
                                    <?php echo e($truyen['theLoai']); ?>
                                </span>
                                <span class="saved-story-price"><?php echo e($truyen['gia']); ?></span>
                            </div>

                            <h3 class="headline saved-story-title"><?php echo e($truyen['ten']); ?></h3>
                            <p class="saved-story-desc">Bạn có thể mở lại trang chi tiết để đọc tiếp, hoặc xóa khỏi danh sách nếu chưa muốn lưu nữa.</p>

                            <div class="saved-story-actions">
                                <a href="<?php echo PUBLIC_URL; ?>/Main.php?id=<?php echo (int) $truyen['id']; ?>" class="saved-story-btn saved-story-btn-primary">
                                    Đọc chi tiết
                                </a>
                                <a href="<?php echo PUBLIC_URL; ?>/StoryMarket.php?story=<?php echo (int) $truyen['id']; ?>" class="saved-story-btn saved-story-btn-blue">
                                    Xem tại chợ truyện
                                </a>
                                <a href="<?php echo PUBLIC_URL; ?>/List.php?remove=<?php echo (int) $truyen['id']; ?>" class="saved-story-btn saved-story-btn-soft">
                                    Xóa khỏi tủ
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if (empty($tuTruyen)): ?>
                    <div class="empty-library-box">
                        <h2 class="headline empty-library-title">Tủ truyện đang trống</h2>
                        <p class="empty-library-desc">Bạn chưa lưu bộ truyện nào. Hãy vào thư viện để thêm những tác phẩm đầu tiên.</p>
                        <a href="<?php echo PUBLIC_URL; ?>/Library.php" class="empty-library-btn">
                            Vào thư viện ngay
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="list-sidebar">
                <div class="summary-box">
                    <h2 class="headline summary-title">Tóm tắt nhanh</h2>

                    <div class="summary-items">
                        <div class="summary-item">
                            <p class="summary-label">Tổng số truyện đã lưu</p>
                            <p class="summary-value"><?php echo count($tuTruyen); ?></p>
                        </div>

                        <div class="summary-item">
                            <p class="summary-label">Điểm bắt đầu</p>
                            <a href="<?php echo PUBLIC_URL; ?>/Index.php" class="summary-link">Về trang chủ người dùng</a>
                        </div>

                        <div class="summary-item">
                            <p class="summary-label">Khám phá thêm</p>
                            <a href="<?php echo PUBLIC_URL; ?>/StoryMarket.php" class="summary-link">Mở chợ truyện</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="../assets/js/public/list.js"></script>

<?php require_once __DIR__ . '/../include/user/UserFooter.php'; ?>