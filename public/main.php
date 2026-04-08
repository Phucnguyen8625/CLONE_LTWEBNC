<?php
$pageTitle = 'Chi tiết truyện';
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
        'tacGia' => 'Aoi Vector',
        'soChuong' => 24,
        'danhGia' => '4.9/5',
        'moTa' => 'Neon Drifters theo chân một nhóm courier chuyên vận chuyển ký ức số trong thành phố không bao giờ ngủ. Khi một gói dữ liệu bị đánh cắp, họ buộc phải đi qua những tầng lớp bí mật của đô thị để tìm ra sự thật.',
        'anh' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAes87Fv5ozt2posbJn-K-iVS9kdI2gA2w2VgU12Fe-acGIm64WMFPwzCIQBCOXXHCGAI6Oj0rAlEVV6rgi3aG9j4ov6n2Y_9aSsHW55sZOiW6C2KIrKdnCOkAQ0-qPFLC7n8hT6zPmvo1-OEqDJspIBPIcdklGrs_83aD9K5lHfaHnGKIywWPmU6m7ASG9dVMNFvrG9S_1Fqd_SZuVT3qMURikJNjtdnhQ5Ag9Q-tvua32LaBzVcuAxMtbZ5HiThKDjsdboPIMwmaH',
        'chuongMoi' => ['Chương 22: Mật mã dưới chân cầu', 'Chương 23: Người giữ ánh đèn', 'Chương 24: Thành phố phản chiếu'],
    ],
    2 => [
        'id' => 2,
        'ten' => 'The Ember King',
        'gia' => '299.000đ',
        'theLoai' => 'Kỳ ảo',
        'tacGia' => 'Linh Flame',
        'soChuong' => 30,
        'danhGia' => '4.8/5',
        'moTa' => 'Trong đống tro tàn của đế chế cũ, một người thừa kế trẻ tuổi phát hiện sức mạnh của vương miện lửa. Càng tiến gần ngai vàng, cậu càng phải đánh đổi nhiều hơn giữa quyền lực và lòng trắc ẩn.',
        'anh' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAF4Z1YV7iRpcusut8Rxv0dI4RD77Cn1IjLEmka9811sO_PhaOFRftDDPtxKaVLbunOeHaH-JLxN_Xx1Q5B-sF_IgPNw9lLLH3o4jeyEbcVQ-gOHXMhuLQ9LFUttFO1EzGBq4dsw4i3DlMJqSD3AnQwqY0hHCK9QAaszs0iWov-70pTJ9-9bl8uZ9cSqFlQ0rVI_WJoQrTHaUTaIyU_tWRV8FqFfuxDaMhtlvFd-2IMt2nL5qoLwQZcrg08IDuG79KUkaJ60BFcOYVE',
        'chuongMoi' => ['Chương 28: Ngọn lửa tuyên thệ', 'Chương 29: Tro tàn rực đỏ', 'Chương 30: Vua trở lại'],
    ],
    3 => [
        'id' => 3,
        'ten' => 'Moss & Moonlight',
        'gia' => '79.000đ',
        'theLoai' => 'Phiêu lưu',
        'tacGia' => 'Mộc Lam',
        'soChuong' => 18,
        'danhGia' => '4.7/5',
        'moTa' => 'Một khu rừng cổ chứa chiếc gương của mặt trăng. Trên hành trình tìm sự thật về gia đình, cô gái trẻ kết bạn với những sinh vật bí ẩn và học cách lắng nghe tiếng nói của thiên nhiên.',
        'anh' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB2Pa5W0ejbol_UBuCHJF7Qj3nlV1kYH-_GsI-iVNaUaCDfcbsG-ZkvH0gs7Rx3Cm44Br1TpnzU8DEnYhzbnlPzmxAjK6p3D8yXyq46WkTPVKOjdYb5hi1hQqZrhwUU7c0x4hoi9HZ0pmilhJS43jtSUmi6z0QkV42xRH-oBnbG9bQCKoSxMu95pOcDGBkZ1dw6Pn0TwUo77VuIYoKsVoo569KaAo6d78hn4K-P6sWpiaLiL6Bh7C1jm8DQzMjNOFOf_XOuCCcGZpWL',
        'chuongMoi' => ['Chương 16: Cánh cửa rêu xanh', 'Chương 17: Gió qua hồ bạc', 'Chương 18: Dưới trăng đầu mùa'],
    ],
    4 => [
        'id' => 4,
        'ten' => 'Void Voyager',
        'gia' => '99.000đ',
        'theLoai' => 'Hành động',
        'tacGia' => 'K. Orion',
        'soChuong' => 21,
        'danhGia' => '4.8/5',
        'moTa' => 'Tàu Voyager vượt ra ngoài quỹ đạo an toàn và đi vào vùng chân không nơi nỗi sợ có hình dạng cụ thể. Để sống sót, cả đội phải đối mặt với những phần ký ức mà họ muốn chôn vùi nhất.',
        'anh' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAnjPfEs2MPobkLFO3nrDCZ24_0ws6hwpusSltcYtPYHqgxfGHs-EwrF0lATV8Pum1N0SoQ1XJrpFdS_STT5PU7kA27FsCKxjNT6_WVNxlCUsl7kzciCy_21lcqO_ZFeb7tTCn7WZtKogyhDBkFBEmOuwDNjHwgeDlPdpesX2pX7BgJOuqqcnddwLd-L-vcllayn0TN-r3xKUn5hNdIv2_Ud5D3bKczICfq2yKhivKwjiA2k6CFi0gu77eDUm-V4W1Ol7K-VtvpNk-nB',
        'chuongMoi' => ['Chương 19: Nhật ký khoang tối', 'Chương 20: Kẻ đứng sau mặt nạ', 'Chương 21: Tín hiệu cuối cùng'],
    ],
];

$id = (int) ($_GET['id'] ?? 1);
$truyen = $danhSachTruyen[$id] ?? reset($danhSachTruyen);

require_once __DIR__ . '/../include/user/UserHeader.php';
?>

<link rel="stylesheet" href="../assets/css/public/mainStyle.css">

<section class="story-detail-section">
    <div class="story-detail-container">
        <div class="story-detail-grid">
            <div class="story-cover-card">
                <img src="<?php echo e($truyen['anh']); ?>" alt="<?php echo e($truyen['ten']); ?>" class="story-cover-image">
            </div>

            <div class="story-detail-content">
                <div class="story-badges">
                    <span class="story-badge story-badge-orange"><?php echo e($truyen['theLoai']); ?></span>
                    <span class="story-badge story-badge-blue">Đánh giá <?php echo e($truyen['danhGia']); ?></span>
                </div>

                <h1 class="headline story-detail-title"><?php echo e($truyen['ten']); ?></h1>
                <p class="story-detail-desc"><?php echo e($truyen['moTa']); ?></p>

                <div class="story-stats-grid">
                    <div class="story-stat-card">
                        <p class="story-stat-label">Tác giả</p>
                        <p class="story-stat-value"><?php echo e($truyen['tacGia']); ?></p>
                    </div>
                    <div class="story-stat-card">
                        <p class="story-stat-label">Số chương</p>
                        <p class="story-stat-value"><?php echo e((string) $truyen['soChuong']); ?></p>
                    </div>
                    <div class="story-stat-card">
                        <p class="story-stat-label">Giá truyện</p>
                        <p class="story-stat-value"><?php echo e($truyen['gia']); ?></p>
                    </div>
                </div>

                <div class="story-detail-actions">
                    <a href="<?php echo PUBLIC_URL; ?>/List.php?add=<?php echo (int) $truyen['id']; ?>" class="story-action-btn story-action-btn-gradient">
                        Thêm vào tủ truyện
                    </a>
                    <a href="<?php echo PUBLIC_URL; ?>/Library.php" class="story-action-btn story-action-btn-soft">
                        Quay về thư viện
                    </a>
                    <a href="<?php echo PUBLIC_URL; ?>/StoryMarket.php" class="story-action-btn story-action-btn-blue">
                        Xem giá tại chợ truyện
                    </a>
                </div>

                <div class="chapter-box">
                    <div class="chapter-box-header">
                        <h2 class="headline chapter-box-title">Chương mới cập nhật</h2>
                        <a href="<?php echo PUBLIC_URL; ?>/List.php?add=<?php echo (int) $truyen['id']; ?>" class="chapter-save-link">Lưu để đọc sau</a>
                    </div>

                    <div class="chapter-list">
                        <?php foreach ($truyen['chuongMoi'] as $index => $chuong): ?>
                            <div class="chapter-item">
                                <div>
                                    <p class="chapter-part">Phần <?php echo (int) ($index + 1); ?></p>
                                    <p class="chapter-name"><?php echo e($chuong); ?></p>
                                </div>
                                <a href="<?php echo PUBLIC_URL; ?>/List.php?add=<?php echo (int) $truyen['id']; ?>" class="chapter-read-btn">
                                    Đọc ngay
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="../assets/js/public/main.js"></script>

<?php require_once __DIR__ . '/../include/user/UserFooter.php'; ?>