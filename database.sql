-- Tạo Database nếu chưa có (Hãy thay đổi tên database phù hợp nếu cần)
CREATE DATABASE IF NOT EXISTS ban_truyen_tranh CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ban_truyen_tranh;

-- Bảng lưu trữ Danh mục truyện (Categories)
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    description TEXT,
    status TINYINT(1) DEFAULT 1 COMMENT '1: Hoạt động, 0: Ẩn',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Bảng lưu trữ Truyện (Comics) - Dùng để liên kết với danh mục
CREATE TABLE IF NOT EXISTS comics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    author VARCHAR(150),
    price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    quantity INT NOT NULL DEFAULT 0,
    image_url VARCHAR(255),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT
);

-- Dữ liệu mẫu ban đầu cho Categories
INSERT IGNORE INTO categories (id, name, description, status) VALUES 
(1, 'Hành Động', 'Truyện phiêu lưu, võ thuật, cảnh hành động mãn nhãn', 1),
(2, 'Tình Cảm', 'Truyện lãng mạn, học đường', 1),
(3, 'Kinh Dị', 'Truyện rùng rợn, giật gân, ám ảnh', 1);

-- Bảng lưu trữ đơn hàng
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(150) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    customer_email VARCHAR(150),
    address TEXT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    status ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Bảng chi tiết đơn hàng
CREATE TABLE IF NOT EXISTS order_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    comic_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (comic_id) REFERENCES comics(id) ON DELETE RESTRICT
);

-- Bảng lưu trữ giao dịch thanh toán
CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    payment_method VARCHAR(50) NOT NULL COMMENT 'e.g., cod, vnpay',
    amount DECIMAL(10,2) NOT NULL,
    payment_status ENUM('pending', 'success', 'failed') DEFAULT 'pending',
    transaction_id VARCHAR(100) NULL COMMENT 'Mã giao dịch từ gateway',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);
