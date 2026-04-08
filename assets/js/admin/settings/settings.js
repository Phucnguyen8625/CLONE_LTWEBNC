document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('settingsForm');
    const siteName = document.getElementById('site_name');
    const adminEmail = document.getElementById('admin_email');

    if (!form || !siteName || !adminEmail) {
        return;
    }

    form.addEventListener('submit', function (event) {
        const siteNameValue = siteName.value.trim();
        const adminEmailValue = adminEmail.value.trim();

        if (siteNameValue === '') {
            event.preventDefault();
            alert('Vui lòng nhập tên website.');
            siteName.focus();
            return;
        }

        if (adminEmailValue === '') {
            event.preventDefault();
            alert('Vui lòng nhập email quản trị.');
            adminEmail.focus();
            return;
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailPattern.test(adminEmailValue)) {
            event.preventDefault();
            alert('Email quản trị không hợp lệ.');
            adminEmail.focus();
        }
    });
});