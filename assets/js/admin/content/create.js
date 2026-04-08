document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('createContentForm');

    if (!form) return;

    form.addEventListener('submit', function () {
        console.log('Đang gửi form thêm nội dung...');
    });
});