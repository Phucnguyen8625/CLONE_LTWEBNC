<?php
$tenTrang = 'Kinetic Ink | Tài khoản';

$menuTrai = [
    [
        'ten' => 'Tài khoản',
        'icon' => 'person',
        'link' => 'user.php',
        'active' => true,
    ],
    [
        'ten' => 'Tùy chọn',
        'icon' => 'settings_suggest',
        'link' => '#',
        'active' => false,
    ],
    [
        'ten' => 'Riêng tư',
        'icon' => 'lock',
        'link' => '#',
        'active' => false,
    ],
    [
        'ten' => 'Cài đặt ứng dụng',
        'icon' => 'stay_current_portrait',
        'link' => '../Setting.php',
        'active' => false,
    ],
];

$thongTinNguoiDung = [
    'ten' => 'Alex "Ink" Chen',
    'email' => 'alex.chen@kineticink.com',
    'vaiTro' => 'Nhà sáng tạo đã xác minh',
    'capDo' => 42,
    'phanTram' => 78,
    'xpConLai' => '2.450 XP để lên cấp 43. Tiếp tục đọc để mở khóa bìa truyện độc quyền.',
];

$goiThanhVien = [
    'ten' => 'PRO READER',
    'moTa' => 'Truy cập không giới hạn vào kho truyện và được xem sớm các đợt phát hành truyện hằng tuần.',
    'ngayGiaHan' => '12/10/2024',
];

$taiKhoanLienKet = [
    [
        'ten' => 'Google',
        'trangThai' => 'Đã kết nối với alex.c_ink',
        'hanhDong' => 'Ngắt kết nối',
        'kieu' => 'disconnect',
        'svg' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21.35,11.1H12.18V13.83H18.69C18.36,17.64 15.19,19.27 12.19,19.27C8.36,19.27 5.05,16.22 5.05,12C5.05,7.78 8.36,4.73 12.19,4.73C15.31,4.73 17.1,6.7 17.1,6.7L19,4.72C19,4.72 16.56,2 12.1,2C6.42,2 2.03,6.8 2.03,12C2.03,17.05 6.16,22 12.25,22C17.6,22 21.5,18.33 21.5,12.91C21.5,11.76 21.35,11.1 21.35,11.1V11.1Z" fill="currentColor"></path></svg>',
    ],
    [
        'ten' => 'Facebook',
        'trangThai' => 'Chưa kết nối',
        'hanhDong' => 'Kết nối',
        'kieu' => 'connect',
        'svg' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96C18.34 21.21 22 17.06 22 12.06C22 6.53 17.5 2.04 12 2.04Z" fill="currentColor"></path></svg>',
    ],
];

$baoMat = [
    [
        'icon' => 'key',
        'ten' => 'Đổi mật khẩu',
        'loai' => 'arrow',
    ],
    [
        'icon' => 'phonelink_lock',
        'ten' => 'Xác thực hai lớp',
        'loai' => 'badge',
        'badge' => 'ĐANG BẬT',
    ],
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($tenTrang) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/public/settings/userStyle.css">
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="brand">KINETIC INK</div>

        <div class="profile-mini">
            <div class="profile-mini-avatar"></div>
            <div class="profile-mini-text">
                <strong>Cài đặt</strong>
                <span>Quản lý trải nghiệm biên tập và tài khoản của bạn</span>
            </div>
        </div>

        <nav class="menu">
            <?php foreach ($menuTrai as $menu): ?>
                <a href="<?= htmlspecialchars($menu['link']) ?>" class="menu-item <?= $menu['active'] ? 'active' : '' ?>">
                    <span class="material-symbols-outlined"><?= htmlspecialchars($menu['icon']) ?></span>
                    <span><?= htmlspecialchars($menu['ten']) ?></span>
                </a>
            <?php endforeach; ?>
        </nav>

        <button class="upgrade-btn" type="button">Nâng cấp Premium</button>

        <div class="sidebar-bottom">
            <a href="#">
                <span class="material-symbols-outlined">help</span>
                <span>Trung tâm hỗ trợ</span>
            </a>
            <a href="../Logout.php">
                <span class="material-symbols-outlined">logout</span>
                <span>Đăng xuất</span>
            </a>
        </div>
    </aside>

    <main class="main">
        <div class="top-dots"></div>

        <header class="page-header">
            <h1>ACCOUNT</h1>
            <div class="page-sub">Identity &amp; Access</div>
        </header>

        <div class="grid">
            <section class="card profile-card">
                <div class="profile-wrap">
                    <div class="profile-photo-box">
                        <div class="profile-photo"></div>
                        <button class="edit-photo-btn" type="button">
                            <span class="material-symbols-outlined">edit</span>
                        </button>
                    </div>

                    <div class="profile-content">
                        <div class="profile-head">
                            <div>
                                <h2><?= htmlspecialchars($thongTinNguoiDung['ten']) ?></h2>
                                <p><?= htmlspecialchars($thongTinNguoiDung['email']) ?></p>
                            </div>
                            <span class="verified-badge"><?= htmlspecialchars($thongTinNguoiDung['vaiTro']) ?></span>
                        </div>

                        <div class="level-box">
                            <div class="level-top">
                                <span>Ink Level</span>
                                <span>LVL <?= (int)$thongTinNguoiDung['capDo'] ?></span>
                            </div>

                            <div class="progress">
                                <div class="progress-fill" style="width: <?= (int)$thongTinNguoiDung['phanTram'] ?>%;"></div>
                            </div>

                            <div class="level-note"><?= htmlspecialchars($thongTinNguoiDung['xpConLai']) ?></div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="card membership-card">
                <div class="membership-top">
                    <span class="material-symbols-outlined membership-star">stars</span>
                    <span>Membership</span>
                </div>

                <div class="membership-title"><?= htmlspecialchars($goiThanhVien['ten']) ?></div>
                <div class="membership-text"><?= htmlspecialchars($goiThanhVien['moTa']) ?></div>

                <div class="membership-row">
                    <span>Gia hạn vào</span>
                    <span><?= htmlspecialchars($goiThanhVien['ngayGiaHan']) ?></span>
                </div>

                <button class="membership-btn" type="button">Quản lý gói thành viên</button>
            </section>

            <section class="card social-card">
                <div class="section-title">Tài khoản mạng xã hội liên kết</div>

                <div class="social-list">
                    <?php foreach ($taiKhoanLienKet as $taiKhoan): ?>
                        <div class="social-item">
                            <div class="social-left">
                                <div class="social-icon">
                                    <?= $taiKhoan['svg'] ?>
                                </div>

                                <div>
                                    <div class="social-name"><?= htmlspecialchars($taiKhoan['ten']) ?></div>
                                    <div class="social-status"><?= htmlspecialchars($taiKhoan['trangThai']) ?></div>
                                </div>
                            </div>

                            <button class="social-btn <?= htmlspecialchars($taiKhoan['kieu']) ?>" type="button">
                                <?= htmlspecialchars($taiKhoan['hanhDong']) ?>
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="right-col">
                <div class="card security-card">
                    <div class="security-title">Bảo mật</div>

                    <div class="security-list">
                        <?php foreach ($baoMat as $item): ?>
                            <button class="security-item" type="button">
                                <div class="security-left">
                                    <span class="material-symbols-outlined"><?= htmlspecialchars($item['icon']) ?></span>
                                    <span><?= htmlspecialchars($item['ten']) ?></span>
                                </div>

                                <?php if ($item['loai'] === 'badge'): ?>
                                    <span class="active-badge"><?= htmlspecialchars($item['badge']) ?></span>
                                <?php else: ?>
                                    <span class="material-symbols-outlined security-arrow">chevron_right</span>
                                <?php endif; ?>
                            </button>
                        <?php endforeach; ?>
                    </div>

                    <div class="ink-overlay">INK</div>
                </div>

                <div class="card danger-card">
                    <h4>Vùng nguy hiểm</h4>
                    <p>Xóa vĩnh viễn tài khoản và toàn bộ thư viện truyện kỹ thuật số đã mua của bạn.</p>
                    <button class="danger-btn" type="button">Xóa tài khoản</button>
                </div>
            </section>
        </div>
    </main>
</div>

<script src="../../assets/js/public/settings/user.js"></script>
</body>
</html>