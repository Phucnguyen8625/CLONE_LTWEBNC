document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('editContentForm');
    const titleInput = document.getElementById('title');
    const categoryInput = document.getElementById('category');
    const descriptionInput = document.getElementById('description');

    if (!form) return;

    form.addEventListener('submit', function (event) {
        const title = titleInput.value.trim();
        const category = categoryInput.value.trim();
        const description = descriptionInput.value.trim();

        if (title === '') {
            event.preventDefault();
            alert('Vui lòng nhập tiêu đề.');
            titleInput.focus();
            return;
        }

        if (category === '') {
            event.preventDefault();
            alert('Vui lòng nhập danh mục.');
            categoryInput.focus();
            return;
        }

        if (description === '') {
            event.preventDefault();
            alert('Vui lòng nhập mô tả.');
            descriptionInput.focus();
        }
    });
});