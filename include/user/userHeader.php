<?php
require_once __DIR__ . '/../../config/WebConfig.php';

if (!isset($pageTitle) || $pageTitle === '') {
    $pageTitle = $tenWebsite;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($pageTitle); ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700;800&family=Manrope:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <style>
        body { font-family: 'Manrope', sans-serif; }
        .headline { font-family: 'Space Grotesk', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #a73300, #ff794a); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-6px); box-shadow: 0 12px 25px rgba(0,0,0,0.12); }
    </style>
</head>
<body class="bg-[#fff4f3] text-[#4e211e]">

<nav class="fixed top-0 left-0 w-full bg-white/80 backdrop-blur-md shadow-sm z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <a href="<?php echo PUBLIC_URL; ?>/Index.php" class="text-2xl font-extrabold text-orange-700 headline">
            <?php echo e($tenWebsite); ?>
        </a>

        <div class="hidden md:flex items-center gap-8 font-semibold">
            <a href="<?php echo PUBLIC_URL; ?>/Index.php" class="text-orange-700 border-b-2 border-orange-700 pb-1">Khám phá</a>
            <a href="<?php echo PUBLIC_URL; ?>/Library.php" class="hover:text-orange-700">Thư viện</a>
            <a href="<?php echo PUBLIC_URL; ?>/StoryMarket.php" class="hover:text-orange-700">Chợ truyện</a>
        </div>

        <div class="flex items-center gap-4">
            <a href="<?php echo PUBLIC_URL; ?>/List.php" class="hover:text-orange-700" title="Danh sách">
                <span class="material-symbols-outlined">list</span>
            </a>
            <a href="<?php echo PUBLIC_URL; ?>/Register.php" class="hover:text-orange-700" title="Tài khoản">
                <span class="material-symbols-outlined">account_circle</span>
            </a>
        </div>
    </div>
</nav>