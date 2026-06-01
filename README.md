# Báo cáo Đồ án Web Nâng Cao - MangaStore

## 1. Tên đề tài
Xây dựng Website bán truyện tranh (MangaStore).

## 2. Giới thiệu website/hệ thống
MangaStore là một nền tảng thương mại điện tử chuyên cung cấp và bán truyện tranh trực tuyến. Hệ thống cho phép người dùng tìm kiếm, xem chi tiết truyện, quản lý giỏ hàng và thanh toán trực tuyến nhanh chóng thông qua cổng thanh toán VNPAY. Giao diện được thiết kế hiện đại, thân thiện, hỗ trợ chuyển đổi giao diện sáng tối (Light/Dark mode).

## 3. Danh sách thành viên, MSSV & Phân công nhiệm vụ cụ thể

| STT | Họ và tên sinh viên | MSSV | Phân công nhiệm vụ cụ thể | Mức độ đóng góp |
|---|---|---|---|---|
| 1 | Nguyễn Duy Khánh | 23810310131 | Khởi tạo dự án & thiết kế Database. Code Admin: Quản lý người dùng, danh mục, truyện. | 100% |
| 2 | Nguyễn Huy Phúc | 23810310141 | Code Admin: Quản lý đơn hàng, thanh toán, thống kê/báo cáo. Code User: Đặt hàng & Thanh toán online (VNPAY). | 100% |
| 3 | Nguyễn Dương Thế Bảo | 23810310087 | Thiết kế giao diện UI/UX. Code User: Trang chủ, tìm kiếm, đăng nhập, giỏ hàng, thông tin cá nhân. | 100% |

## 4. Công nghệ sử dụng
- **Backend:** PHP thuần (Native PHP)
- **Frontend:** HTML, CSS (Tailwind CSS, tự xây dựng CSS Variables), JavaScript
- **Cơ sở dữ liệu:** MySQL
- **Môi trường ảo hóa & Triển khai:** Docker, Docker Compose
- **Tích hợp mở rộng:** VNPAY Sandbox API (Cổng thanh toán online)

## 5. Hướng dẫn cài đặt & Hướng dẫn chạy project

### Cách 1: Sử dụng Docker (Khuyên dùng)
Dự án cung cấp sẵn cấu hình `docker-compose.yml` và `Dockerfile` để triển khai nhanh chóng trên môi trường ảo hóa:
```bash
# Chạy dự án với Docker
docker-compose up -d
```
Ứng dụng sẽ tự động khởi tạo PHP/Apache trên cổng `8080` và kết nối với cơ sở dữ liệu MySQL chạy nền. Truy cập vào `http://localhost:8080`.

### Cách 2: Sử dụng XAMPP/WAMP
1. Clone dự án về thư mục `htdocs` của XAMPP:
```bash
git clone https://github.com/Phucnguyen8625/BCCD_Lap_trinh_web_nang_cao_Nhom_2.git
```
2. Tạo database mới trong phpMyAdmin với tên `ban_truyen_tranh`.
3. Import file `database.sql` (và `seed.sql` nếu cần dữ liệu mẫu) vào database vừa tạo.
4. (Tùy chọn) Chạy file `setup_database.php` trên trình duyệt (`http://localhost/BCCD_Lap_trinh_web_nang_cao_Nhom_2/setup_database.php`) để hệ thống tự động kiểm tra và thêm tài khoản Admin nếu chưa có.
5. Truy cập trình duyệt vào `http://localhost/BCCD_Lap_trinh_web_nang_cao_Nhom_2/`

## 6. Tài khoản demo
- **Quản trị viên (Admin):** 
  - Tài khoản: `admin`
  - Mật khẩu: `admin123`
- **Khách hàng (User):** Bạn có thể sử dụng tính năng "Đăng ký" trên website để tạo tài khoản trải nghiệm thực tế hoặc sử dụng tài khoản tạo sẵn trong database.

## 7. Hình ảnh minh họa hệ thống
*(Thay thế link ảnh dưới đây bằng ảnh chụp màn hình thực tế của website)*
![Trang chủ](https://via.placeholder.com/800x400.png?text=Hinh+Anh+Minh+Hoa+Website)

## 8. Video Demo & Link Deploy
- **Link repository GitHub:** [BCCD_Lap_trinh_web_nang_cao_Nhom_2](https://github.com/Phucnguyen8625/BCCD_Lap_trinh_web_nang_cao_Nhom_2.git)
- **Link video demo:** `[Cập nhật link Youtube/Drive tại đây]`
- **Link online đã deploy:** `[Cập nhật link hosting/deploy tại đây (nếu có)]`

---

## 9. Mục lục Software Requirement Specification (SRS)

- [Quản lý người dùng](docs/srs/quan_ly_nguoi_dung.md)
- [Quản lý danh mục truyện](docs/srs/quan_ly_danh_muc_truyen.md)
- [Quản lý truyện tranh](docs/srs/quan_ly_truyen_tranh.md)
- [Quản lý đơn hàng](docs/srs/quan_ly_don_hang.md)
- [Quản lý thanh toán](docs/srs/quan_ly_thanh_toan.md)
- [Thống kê / Báo cáo](docs/srs/thong_ke_bao_cao.md)
- [Trang chủ](docs/srs/trang_chu.md)
- [Đăng ký / Đăng nhập](docs/srs/dang_ky_dang_nhap.md)
- [Tìm kiếm truyện](docs/srs/tim_kiem_truyen.md)
- [Giỏ hàng](docs/srs/gio_hang.md)
- [Thanh toán online](docs/srs/thanh_toan_online.md)
- [Quản lý đơn hàng của người dùng](docs/srs/quan_ly_don_hang_cua_nguoi_dung.md)
- [Cập nhật thông tin cá nhân](docs/srs/cap_nhat_thong_tin_ca_nhan.md)

---

## 10. Báo cáo chuyên đề: Các tính năng tối ưu hệ thống

Dự án này đã được tối ưu để đáp ứng các tiêu chuẩn của báo cáo chuyên đề **Phần mềm mã nguồn mở** và **Lập trình web nâng cao**.

### 10.1. Tùy biến Skin (Dark Mode)
Giao diện người dùng được trang bị tính năng chuyển đổi **Light/Dark Mode** (nút bấm ở góc phải Header). 
Tính năng này tự động lưu trạng thái vào `localStorage` và ghi đè CSS Variables bằng class `.dark` của Tailwind CSS, minh chứng cho khả năng tùy biến giao diện linh hoạt.

### 10.2. Kiến trúc Plugin/Module
Toàn bộ nghiệp vụ Admin (Orders, Payments, Reports) được gói gọn trong thư mục `phuc_modules`. Đây là kiến trúc cho phép dễ dàng cắm (plug) hoặc tháo (unplug) các tính năng nghiệp vụ mà không ảnh hưởng sâu đến core của hệ thống.

### 10.3. Môi trường Ảo hóa (Docker)
*(Chi tiết cách khởi động bằng Docker đã được đề cập ở mục 5. Hướng dẫn cài đặt)*

### 10.4. License
Dự án được phân phối dưới giấy phép **MIT License** (xem file `LICENSE`), cho phép sử dụng, sửa đổi và phân phối tự do.
