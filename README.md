Software Requirement Specification (SRS)
Chức năng: Quản lý người dùng

Mã chức năng: ADMIN-USER-01
Trạng thái: Draft / Review
Người soạn thảo: Nhóm 2 / Nguyễn Dương Thế Bảo, Nguyễn Huy Phúc, Nguyễn Duy Khánh
Vai trò: Developer / Analyst

1. Mô tả tổng quan (Description)

Cung cấp chức năng cho quản trị viên quản lý toàn bộ tài khoản người dùng trên hệ thống website truyện tranh. Admin có thể xem danh sách người dùng, tìm kiếm, cập nhật thông tin, khóa/mở khóa tài khoản và xóa tài khoản khi cần thiết.

2. Luồng nghiệp vụ (User Workflow)
Bước	Hành động người dùng	Phản hồi hệ thống
1	Admin truy cập trang /admin/users	Hiển thị danh sách tài khoản người dùng.
2	Admin chọn tìm kiếm, xem chi tiết hoặc chỉnh sửa người dùng	Hệ thống hiển thị kết quả tương ứng.
3	Admin cập nhật trạng thái hoặc thông tin tài khoản	Hệ thống kiểm tra dữ liệu hợp lệ.
4	Dữ liệu hợp lệ	Hệ thống lưu thay đổi vào Database.
5	Có lỗi dữ liệu hoặc tài khoản không hợp lệ	Hệ thống hiển thị thông báo lỗi.
3. Yêu cầu dữ liệu (Data Requirements)
3.1. Dữ liệu đầu vào (Input Fields)
UserID: int, bắt buộc, định danh người dùng.
FullName: string, bắt buộc.
Email: string, đúng định dạng email, bắt buộc.
Phone: string, tùy chọn.
Status: boolean / enum, trạng thái hoạt động hoặc bị khóa.
3.2. Dữ liệu lưu trữ (Database - Bảng users)
id: khóa chính.
full_name: tên người dùng.
email: unique.
password: mật khẩu đã mã hóa.
phone: số điện thoại.
status: trạng thái tài khoản.
created_at: thời gian tạo.
updated_at: thời gian cập nhật.
4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
Chỉ tài khoản có quyền Admin mới được truy cập chức năng này.
Toàn bộ thao tác cập nhật/xóa phải được ghi log.
Thông tin người dùng phải được bảo vệ và không hiển thị mật khẩu gốc.
Hệ thống phải kiểm tra quyền trước khi cho phép sửa hoặc xóa.
5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
Trường hợp: Admin tìm kiếm người dùng không tồn tại.
Xử lý: Hiển thị thông báo "Không tìm thấy người dùng phù hợp".
Trường hợp: Email cập nhật bị trùng với tài khoản khác.
Xử lý: Hiển thị lỗi "Email đã tồn tại trong hệ thống".
Trường hợp: Admin xóa người dùng đang có đơn hàng.
Xử lý: Không cho phép xóa cứng, chỉ cho phép khóa tài khoản.
6. Giao diện (UI/UX)
Hiển thị bảng danh sách người dùng rõ ràng, có phân trang.
Có ô tìm kiếm nhanh theo tên hoặc email.
Có nút thao tác: Xem, Sửa, Khóa/Mở khóa, Xóa.
Thiết kế dễ sử dụng trên Desktop.
Software Requirement Specification (SRS)
Chức năng: Quản lý danh mục truyện

Mã chức năng: ADMIN-CATE-02
Trạng thái: Draft / Review
Người soạn thảo: Nhóm 2 / Nguyễn Dương Thế Bảo, Nguyễn Huy Phúc, Nguyễn Duy Khánh
Vai trò: Developer / Analyst

1. Mô tả tổng quan (Description)

Cho phép quản trị viên thêm mới, chỉnh sửa, xóa và quản lý các danh mục truyện trên hệ thống như hành động, tình cảm, học đường, kinh dị, phiêu lưu,...

2. Luồng nghiệp vụ (User Workflow)
Bước	Hành động người dùng	Phản hồi hệ thống
1	Admin truy cập trang /admin/categories	Hiển thị danh sách danh mục truyện.
2	Admin chọn thêm mới hoặc chỉnh sửa danh mục	Hệ thống hiển thị form nhập dữ liệu.
3	Admin nhập tên danh mục và lưu	Hệ thống kiểm tra trùng lặp và tính hợp lệ.
4	Dữ liệu hợp lệ	Hệ thống lưu vào Database.
5	Dữ liệu không hợp lệ	Hiển thị thông báo lỗi.
3. Yêu cầu dữ liệu (Data Requirements)
3.1. Dữ liệu đầu vào (Input Fields)
CategoryName: string, bắt buộc.
Description: string, tùy chọn.
Status: boolean, trạng thái hiển thị.
3.2. Dữ liệu lưu trữ (Database - Bảng categories)
id: khóa chính.
name: tên danh mục, unique.
description: mô tả.
status: trạng thái hoạt động.
created_at: thời gian tạo.
4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
Chỉ Admin mới có quyền thao tác.
Không cho phép tạo danh mục trùng tên.
Khi xóa danh mục đang có truyện liên kết, hệ thống phải kiểm tra ràng buộc dữ liệu.
5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
Trường hợp: Tên danh mục bị để trống.
Xử lý: Hiển thị lỗi "Tên danh mục không được để trống".
Trường hợp: Danh mục đã tồn tại.
Xử lý: Hiển thị lỗi "Danh mục đã tồn tại".
Trường hợp: Danh mục đang chứa truyện.
Xử lý: Không cho phép xóa hoặc yêu cầu chuyển dữ liệu trước khi xóa.
6. Giao diện (UI/UX)
Bảng danh mục hiển thị ngắn gọn, dễ nhìn.
Có nút Thêm, Sửa, Xóa.
Có hộp thoại xác nhận trước khi xóa.
Software Requirement Specification (SRS)
Chức năng: Quản lý truyện tranh

Mã chức năng: ADMIN-BOOK-03
Trạng thái: Draft / Review
Người soạn thảo: Nhóm 2 / Nguyễn Dương Thế Bảo, Nguyễn Huy Phúc, Nguyễn Duy Khánh
Vai trò: Developer / Analyst

1. Mô tả tổng quan (Description)

Cho phép Admin quản lý thông tin truyện tranh trên hệ thống, bao gồm thêm truyện mới, chỉnh sửa, xóa, cập nhật giá bán, số lượng, hình ảnh, tác giả, nhà xuất bản và danh mục truyện.

2. Luồng nghiệp vụ (User Workflow)
Bước	Hành động người dùng	Phản hồi hệ thống
1	Admin truy cập trang /admin/comics	Hiển thị danh sách truyện tranh.
2	Admin chọn thêm mới hoặc chỉnh sửa truyện	Hiển thị form nhập thông tin truyện.
3	Admin nhập đầy đủ thông tin và lưu	Hệ thống kiểm tra dữ liệu hợp lệ.
4	Dữ liệu hợp lệ	Hệ thống lưu vào Database.
5	Dữ liệu lỗi	Hiển thị thông báo lỗi cho Admin.
3. Yêu cầu dữ liệu (Data Requirements)
3.1. Dữ liệu đầu vào (Input Fields)
ComicName: string, bắt buộc.
Author: string, bắt buộc.
CategoryID: int, bắt buộc.
Price: decimal, bắt buộc.
Quantity: int, bắt buộc.
Image: file/string, tùy chọn.
Description: text, tùy chọn.
3.2. Dữ liệu lưu trữ (Database - Bảng comics)
id: khóa chính.
name: tên truyện.
author: tác giả.
category_id: khóa ngoại danh mục.
price: giá bán.
quantity: tồn kho.
image_url: đường dẫn ảnh.
description: mô tả.
created_at: thời gian tạo.
4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
Dữ liệu giá và số lượng phải là số hợp lệ.
Ảnh tải lên phải đúng định dạng cho phép.
Chỉ Admin được phép thêm, sửa, xóa truyện.
5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
Trường hợp: Thiếu tên truyện hoặc giá bán.
Xử lý: Hiển thị lỗi yêu cầu nhập đầy đủ.
Trường hợp: Giá hoặc số lượng âm.
Xử lý: Từ chối lưu và hiển thị lỗi.
Trường hợp: Upload ảnh sai định dạng.
Xử lý: Báo lỗi và yêu cầu tải lại ảnh hợp lệ.
6. Giao diện (UI/UX)
Form quản lý truyện rõ ràng, hỗ trợ xem trước ảnh.
Danh sách truyện có tìm kiếm, lọc theo danh mục.
Hiển thị phân trang để dễ quản lý.
Software Requirement Specification (SRS)
Chức năng: Quản lý đơn hàng

Mã chức năng: ADMIN-ORDER-04
Trạng thái: Draft / Review
Người soạn thảo: Nhóm 2 / Nguyễn Dương Thế Bảo, Nguyễn Huy Phúc, Nguyễn Duy Khánh
Vai trò: Developer / Analyst

1. Mô tả tổng quan (Description)

Cho phép Admin theo dõi và xử lý các đơn hàng của khách hàng, bao gồm xem chi tiết đơn, cập nhật trạng thái đơn hàng, xác nhận giao hàng hoặc hủy đơn.

2. Luồng nghiệp vụ (User Workflow)
Bước	Hành động người dùng	Phản hồi hệ thống
1	Admin truy cập trang /admin/orders	Hiển thị danh sách đơn hàng.
2	Admin chọn xem chi tiết một đơn hàng	Hệ thống hiển thị thông tin chi tiết đơn hàng.
3	Admin cập nhật trạng thái đơn	Hệ thống kiểm tra điều kiện cập nhật.
4	Cập nhật hợp lệ	Lưu trạng thái mới vào Database.
5	Có lỗi	Hiển thị thông báo lỗi.
3. Yêu cầu dữ liệu (Data Requirements)
3.1. Dữ liệu đầu vào (Input Fields)
OrderID: int, bắt buộc.
Status: enum, bắt buộc. Ví dụ: Chờ xác nhận, Đang giao, Hoàn thành, Đã hủy.
Note: string, tùy chọn.
3.2. Dữ liệu lưu trữ (Database - Bảng orders)
id: khóa chính.
user_id: mã người dùng.
total_amount: tổng tiền.
status: trạng thái đơn hàng.
payment_status: trạng thái thanh toán.
created_at: thời gian đặt hàng.
4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
Chỉ Admin mới được cập nhật trạng thái đơn.
Không cho phép cập nhật trái logic quy trình đơn hàng.
Mọi thay đổi trạng thái phải được lưu log.
5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
Trường hợp: Đơn hàng không tồn tại.
Xử lý: Hiển thị lỗi "Đơn hàng không tồn tại".
Trường hợp: Đơn hàng đã hoàn thành nhưng tiếp tục sửa trạng thái.
Xử lý: Hạn chế cập nhật hoặc yêu cầu quyền đặc biệt.
Trường hợp: Lỗi kết nối cơ sở dữ liệu.
Xử lý: Hiển thị thông báo hệ thống bận.
6. Giao diện (UI/UX)
Có bộ lọc trạng thái đơn hàng.
Có trang chi tiết đơn hàng dễ theo dõi.
Màu sắc trạng thái đơn hàng cần trực quan.
Software Requirement Specification (SRS)
Chức năng: Quản lý thanh toán

Mã chức năng: ADMIN-PAY-05
Trạng thái: Draft / Review
Người soạn thảo: Nhóm 2 / Nguyễn Dương Thế Bảo, Nguyễn Huy Phúc, Nguyễn Duy Khánh
Vai trò: Developer / Analyst

1. Mô tả tổng quan (Description)

Chức năng này giúp Admin quản lý thông tin thanh toán của đơn hàng, kiểm tra trạng thái thanh toán online, đối soát các giao dịch thành công, thất bại hoặc đang chờ xử lý.

2. Luồng nghiệp vụ (User Workflow)
Bước	Hành động người dùng	Phản hồi hệ thống
1	Admin truy cập trang /admin/payments	Hiển thị danh sách giao dịch thanh toán.
2	Admin chọn xem chi tiết giao dịch	Hiển thị thông tin phương thức và trạng thái thanh toán.
3	Admin đối chiếu trạng thái giao dịch	Hệ thống truy xuất dữ liệu giao dịch.
4	Giao dịch hợp lệ	Hiển thị kết quả thành công.
5	Giao dịch lỗi	Hiển thị trạng thái thất bại hoặc chờ xử lý.
3. Yêu cầu dữ liệu (Data Requirements)
3.1. Dữ liệu đầu vào (Input Fields)
PaymentID: int, bắt buộc.
OrderID: int, bắt buộc.
Method: string, ví dụ: Momo, VNPAY, COD.
Status: enum, bắt buộc.
3.2. Dữ liệu lưu trữ (Database - Bảng payments)
id: khóa chính.
order_id: mã đơn hàng.
method: phương thức thanh toán.
status: trạng thái giao dịch.
transaction_code: mã giao dịch.
paid_at: thời gian thanh toán.
4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
Dữ liệu thanh toán phải được bảo mật.
Chỉ Admin mới được truy cập màn hình quản lý thanh toán.
Kết nối với cổng thanh toán phải đảm bảo an toàn.
5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
Trường hợp: Không tìm thấy giao dịch.
Xử lý: Hiển thị thông báo phù hợp.
Trường hợp: Giao dịch chưa hoàn tất.
Xử lý: Hiển thị trạng thái "Đang xử lý".
Trường hợp: Sai lệch dữ liệu đơn hàng và thanh toán.
Xử lý: Gắn cờ để Admin kiểm tra thủ công.
6. Giao diện (UI/UX)
Bảng giao dịch dễ theo dõi.
Có bộ lọc theo phương thức và trạng thái.
Hỗ trợ xem chi tiết từng giao dịch.
Software Requirement Specification (SRS)
Chức năng: Thống kê / Báo cáo

Mã chức năng: ADMIN-REPORT-06
Trạng thái: Draft / Review
Người soạn thảo: Nhóm 2 / Nguyễn Dương Thế Bảo, Nguyễn Huy Phúc, Nguyễn Duy Khánh
Vai trò: Developer / Analyst

1. Mô tả tổng quan (Description)

Chức năng này hỗ trợ Admin xem số liệu thống kê về doanh thu, đơn hàng, số lượng truyện bán ra, truyện bán chạy và người dùng hoạt động trên hệ thống.

2. Luồng nghiệp vụ (User Workflow)
Bước	Hành động người dùng	Phản hồi hệ thống
1	Admin truy cập trang /admin/reports	Hiển thị giao diện thống kê tổng quan.
2	Admin chọn khoảng thời gian hoặc loại báo cáo	Hệ thống tải dữ liệu tương ứng.
3	Hệ thống xử lý dữ liệu	Hiển thị biểu đồ và bảng thống kê.
4	Admin xem hoặc xuất báo cáo	Hệ thống hỗ trợ xuất file nếu có.
3. Yêu cầu dữ liệu (Data Requirements)
3.1. Dữ liệu đầu vào (Input Fields)
FromDate: date, bắt buộc.
ToDate: date, bắt buộc.
ReportType: string, loại báo cáo.
3.2. Dữ liệu lưu trữ
Dữ liệu tổng hợp từ bảng orders, order_details, payments, users, comics.
4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
Chỉ Admin được quyền xem báo cáo.
Dữ liệu thống kê phải đúng và nhất quán.
Thời gian tải báo cáo không quá chậm.
5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
Trường hợp: Khoảng thời gian không hợp lệ.
Xử lý: Báo lỗi yêu cầu chọn lại.
Trường hợp: Không có dữ liệu trong khoảng thời gian đã chọn.
Xử lý: Hiển thị thông báo "Không có dữ liệu".
Trường hợp: Lỗi truy vấn dữ liệu.
Xử lý: Hiển thị thông báo hệ thống.
6. Giao diện (UI/UX)
Có biểu đồ trực quan.
Có bộ lọc thời gian.
Có bảng dữ liệu chi tiết bên dưới.
Software Requirement Specification (SRS)
Chức năng: Trang chủ

Mã chức năng: USER-HOME-07
Trạng thái: Draft / Review
Người soạn thảo: Nhóm 2 / Nguyễn Dương Thế Bảo, Nguyễn Huy Phúc, Nguyễn Duy Khánh
Vai trò: Developer / Analyst

1. Mô tả tổng quan (Description)

Trang chủ là nơi hiển thị thông tin tổng quan về website truyện tranh, bao gồm danh sách truyện nổi bật, truyện mới cập nhật, truyện theo danh mục và các chương trình khuyến mãi nếu có.

2. Luồng nghiệp vụ (User Workflow)
Bước	Hành động người dùng	Phản hồi hệ thống
1	User truy cập /	Hiển thị trang chủ.
2	User xem danh sách truyện nổi bật	Hệ thống tải dữ liệu truyện từ Database.
3	User chọn một truyện bất kỳ	Chuyển đến trang chi tiết truyện.
3. Yêu cầu dữ liệu (Data Requirements)
3.1. Dữ liệu đầu vào
Không bắt buộc nhập dữ liệu.
3.2. Dữ liệu hiển thị
Danh sách truyện mới.
Danh sách truyện nổi bật.
Danh mục truyện.
Banner hoặc thông báo nổi bật.
4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
Trang phải tải nhanh.
Hỗ trợ tốt trên desktop và mobile.
Nội dung hiển thị phải lấy từ dữ liệu hợp lệ.
5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
Trường hợp: Không có dữ liệu truyện.
Xử lý: Hiển thị thông báo phù hợp.
Trường hợp: Lỗi tải dữ liệu.
Xử lý: Hiển thị trang lỗi hoặc nội dung thay thế.
6. Giao diện (UI/UX)
Thiết kế đẹp, dễ nhìn.
Các khu vực truyện được phân chia rõ ràng.
Có thanh menu, banner và danh mục nổi bật.
Software Requirement Specification (SRS)
Chức năng: Đăng ký / Đăng nhập

Mã chức năng: USER-AUTH-08
Trạng thái: Draft / Review
Người soạn thảo: Nhóm 2 / Nguyễn Dương Thế Bảo, Nguyễn Huy Phúc, Nguyễn Duy Khánh
Vai trò: Developer / Analyst

1. Mô tả tổng quan (Description)

Cho phép người dùng tạo tài khoản mới hoặc đăng nhập vào hệ thống để thực hiện mua hàng, quản lý đơn hàng và cập nhật thông tin cá nhân.

2. Luồng nghiệp vụ (User Workflow)
Bước	Hành động người dùng	Phản hồi hệ thống
1	User truy cập /login hoặc /register	Hiển thị form đăng nhập hoặc đăng ký.
2	User nhập thông tin và gửi form	Hệ thống kiểm tra tính hợp lệ của dữ liệu.
3	Dữ liệu đúng	Tạo tài khoản mới hoặc xác thực đăng nhập thành công.
4	Đăng nhập thành công	Chuyển hướng về trang chủ hoặc tài khoản cá nhân.
5	Có lỗi	Hiển thị thông báo lỗi tương ứng.
3. Yêu cầu dữ liệu (Data Requirements)
3.1. Dữ liệu đầu vào (Input Fields)
FullName: string, bắt buộc khi đăng ký.
Email: string, bắt buộc, đúng định dạng.
Password: string, bắt buộc.
ConfirmPassword: string, bắt buộc khi đăng ký.
3.2. Dữ liệu lưu trữ (Database - Bảng users)
full_name
email
password
status
created_at
4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
Mật khẩu phải được mã hóa.
Có validate phía client và server.
Không cho phép email trùng lặp.
Phiên đăng nhập phải được bảo mật.
5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
Trường hợp: Email sai định dạng.
Xử lý: Hiển thị lỗi tại trường nhập.
Trường hợp: Mật khẩu xác nhận không khớp.
Xử lý: Hiển thị thông báo lỗi.
Trường hợp: Tài khoản bị khóa.
Xử lý: Từ chối đăng nhập và báo lý do.
6. Giao diện (UI/UX)
Form đơn giản, dễ dùng.
Có hiển thị/ẩn mật khẩu.
Hỗ trợ tốt trên điện thoại và máy tính.
Software Requirement Specification (SRS)
Chức năng: Tìm kiếm truyện

Mã chức năng: USER-SEARCH-09
Trạng thái: Draft / Review
Người soạn thảo: Nhóm 2 / Nguyễn Dương Thế Bảo, Nguyễn Huy Phúc, Nguyễn Duy Khánh
Vai trò: Developer / Analyst

1. Mô tả tổng quan (Description)

Cho phép người dùng tìm kiếm truyện theo tên truyện, tác giả, thể loại hoặc từ khóa liên quan để nhanh chóng tiếp cận nội dung mong muốn.

2. Luồng nghiệp vụ (User Workflow)
Bước	Hành động người dùng	Phản hồi hệ thống
1	User nhập từ khóa vào ô tìm kiếm	Hệ thống nhận dữ liệu tìm kiếm.
2	User nhấn nút tìm kiếm	Hệ thống truy vấn dữ liệu.
3	Có kết quả phù hợp	Hiển thị danh sách truyện tương ứng.
4	Không có kết quả	Hiển thị thông báo không tìm thấy.
3. Yêu cầu dữ liệu (Data Requirements)
3.1. Dữ liệu đầu vào (Input Fields)
Keyword: string, bắt buộc.
Category: string/int, tùy chọn.
Author: string, tùy chọn.
3.2. Dữ liệu truy xuất
Dữ liệu từ bảng comics, categories, authors nếu có.
4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
Tìm kiếm phải trả kết quả nhanh.
Cần chống lỗi nhập liệu bất thường.
Hỗ trợ tìm kiếm gần đúng nếu có.
5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
Trường hợp: Người dùng để trống từ khóa.
Xử lý: Hiển thị gợi ý nhập từ khóa.
Trường hợp: Không có kết quả.
Xử lý: Thông báo không tìm thấy truyện phù hợp.
6. Giao diện (UI/UX)
Ô tìm kiếm dễ nhìn, dễ dùng.
Kết quả tìm kiếm hiển thị dạng danh sách hoặc lưới.
Có bộ lọc thể loại nếu cần.
Software Requirement Specification (SRS)
Chức năng: Giỏ hàng

Mã chức năng: USER-CART-10
Trạng thái: Draft / Review
Người soạn thảo: Nhóm 2 / Nguyễn Dương Thế Bảo, Nguyễn Huy Phúc, Nguyễn Duy Khánh
Vai trò: Developer / Analyst

1. Mô tả tổng quan (Description)

Cho phép người dùng thêm truyện vào giỏ hàng, cập nhật số lượng, xóa sản phẩm khỏi giỏ và xem tổng tiền trước khi thanh toán.

2. Luồng nghiệp vụ (User Workflow)
Bước	Hành động người dùng	Phản hồi hệ thống
1	User chọn truyện và nhấn "Thêm vào giỏ"	Hệ thống thêm sản phẩm vào giỏ hàng.
2	User mở trang giỏ hàng	Hiển thị danh sách sản phẩm đã chọn.
3	User cập nhật số lượng hoặc xóa sản phẩm	Hệ thống cập nhật lại tổng tiền.
4	User chọn thanh toán	Chuyển sang trang thanh toán.
3. Yêu cầu dữ liệu (Data Requirements)
3.1. Dữ liệu đầu vào
ComicID: int, bắt buộc.
Quantity: int, bắt buộc.
3.2. Dữ liệu lưu trữ
Giỏ hàng lưu theo session hoặc theo tài khoản đăng nhập.
Dữ liệu gồm mã sản phẩm, tên, giá, số lượng, thành tiền.
4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
Không cho phép số lượng nhỏ hơn 1.
Không cho phép vượt quá tồn kho.
Dữ liệu giỏ hàng phải đồng bộ chính xác.
5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
Trường hợp: Sản phẩm hết hàng.
Xử lý: Không cho thêm vào giỏ.
Trường hợp: User nhập số lượng lớn hơn tồn kho.
Xử lý: Báo lỗi và yêu cầu nhập lại.
Trường hợp: Giỏ hàng trống.
Xử lý: Hiển thị thông báo phù hợp.
6. Giao diện (UI/UX)
Giao diện giỏ hàng rõ ràng.
Có nút tăng/giảm số lượng.
Tổng tiền được cập nhật ngay sau thao tác.
Software Requirement Specification (SRS)
Chức năng: Thanh toán online

Mã chức năng: USER-PAY-11
Trạng thái: Draft / Review
Người soạn thảo: Nhóm 2 / Nguyễn Dương Thế Bảo, Nguyễn Huy Phúc, Nguyễn Duy Khánh
Vai trò: Developer / Analyst

1. Mô tả tổng quan (Description)

Cho phép người dùng thanh toán đơn hàng thông qua các phương thức online như Momo, VNPAY hoặc COD nếu hệ thống hỗ trợ.

2. Luồng nghiệp vụ (User Workflow)
Bước	Hành động người dùng	Phản hồi hệ thống
1	User vào trang thanh toán	Hệ thống hiển thị thông tin đơn hàng.
2	User nhập địa chỉ nhận hàng và chọn phương thức thanh toán	Hệ thống kiểm tra dữ liệu hợp lệ.
3	User xác nhận thanh toán	Hệ thống tạo đơn hàng và chuyển tới cổng thanh toán nếu cần.
4	Thanh toán thành công	Hiển thị thông báo đặt hàng thành công.
5	Thanh toán thất bại	Hiển thị thông báo lỗi hoặc cho phép thử lại.
3. Yêu cầu dữ liệu (Data Requirements)
3.1. Dữ liệu đầu vào
ReceiverName: string, bắt buộc.
Address: string, bắt buộc.
Phone: string, bắt buộc.
PaymentMethod: string, bắt buộc.
3.2. Dữ liệu lưu trữ
Thông tin đơn hàng.
Phương thức thanh toán.
Trạng thái thanh toán.
Mã giao dịch nếu có.
4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
Kết nối cổng thanh toán phải an toàn.
Dữ liệu cá nhân và thanh toán phải được bảo vệ.
Không tạo trùng đơn hàng do bấm nhiều lần.
5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
Trường hợp: Thiếu địa chỉ hoặc số điện thoại.
Xử lý: Hiển thị lỗi yêu cầu bổ sung thông tin.
Trường hợp: Thanh toán online thất bại.
Xử lý: Cập nhật trạng thái thất bại và cho phép thử lại.
Trường hợp: Mất kết nối với cổng thanh toán.
Xử lý: Báo lỗi và lưu trạng thái chờ xử lý nếu cần.
6. Giao diện (UI/UX)
Bố cục rõ ràng, dễ nhập.
Hiển thị đầy đủ sản phẩm, phí và tổng tiền.
Có nút xác nhận thanh toán nổi bật.
Software Requirement Specification (SRS)
Chức năng: Quản lý đơn hàng của người dùng

Mã chức năng: USER-ORDER-12
Trạng thái: Draft / Review
Người soạn thảo: Nhóm 2 / Nguyễn Dương Thế Bảo, Nguyễn Huy Phúc, Nguyễn Duy Khánh
Vai trò: Developer / Analyst

1. Mô tả tổng quan (Description)

Cho phép người dùng xem lịch sử đơn hàng, kiểm tra trạng thái xử lý đơn, xem chi tiết từng đơn hàng và theo dõi tiến trình mua hàng.

2. Luồng nghiệp vụ (User Workflow)
Bước	Hành động người dùng	Phản hồi hệ thống
1	User truy cập trang /my-orders	Hiển thị danh sách đơn hàng của người dùng.
2	User chọn một đơn hàng	Hệ thống hiển thị chi tiết đơn hàng.
3	User theo dõi trạng thái đơn hàng	Hệ thống hiển thị trạng thái mới nhất.
3. Yêu cầu dữ liệu (Data Requirements)
3.1. Dữ liệu truy xuất
order_id
created_at
total_amount
status
payment_status
4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
Người dùng chỉ được xem đơn hàng của chính mình.
Dữ liệu phải được xác thực theo tài khoản đăng nhập.
5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
Trường hợp: Người dùng chưa có đơn hàng.
Xử lý: Hiển thị thông báo chưa có lịch sử mua hàng.
Trường hợp: User cố truy cập đơn của người khác.
Xử lý: Từ chối truy cập.
6. Giao diện (UI/UX)
Danh sách đơn hàng rõ ràng.
Có hiển thị trạng thái đơn bằng nhãn màu.
Có nút xem chi tiết.
Software Requirement Specification (SRS)
Chức năng: Cập nhật thông tin cá nhân

Mã chức năng: USER-PROFILE-13
Trạng thái: Draft / Review
Người soạn thảo: Nhóm 2 / Nguyễn Dương Thế Bảo, Nguyễn Huy Phúc, Nguyễn Duy Khánh
Vai trò: Developer / Analyst

1. Mô tả tổng quan (Description)

Cho phép người dùng chỉnh sửa thông tin cá nhân như họ tên, số điện thoại, địa chỉ, ảnh đại diện và đổi mật khẩu.

2. Luồng nghiệp vụ (User Workflow)
Bước	Hành động người dùng	Phản hồi hệ thống
1	User truy cập trang /profile	Hệ thống hiển thị thông tin cá nhân hiện tại.
2	User chỉnh sửa thông tin	Hệ thống nhận dữ liệu mới.
3	User nhấn lưu	Hệ thống kiểm tra dữ liệu hợp lệ.
4	Dữ liệu đúng	Hệ thống cập nhật vào Database.
5	Có lỗi	Hiển thị thông báo lỗi.
3. Yêu cầu dữ liệu (Data Requirements)
3.1. Dữ liệu đầu vào
FullName: string, bắt buộc.
Phone: string, tùy chọn.
Address: string, tùy chọn.
Avatar: file/string, tùy chọn.
NewPassword: string, tùy chọn.
3.2. Dữ liệu lưu trữ
full_name
phone
address
avatar
password
updated_at
4. Ràng buộc kỹ thuật & Bảo mật (Technical Constraints)
Người dùng chỉ được cập nhật tài khoản của chính mình.
Mật khẩu mới phải được mã hóa.
Ảnh đại diện phải đúng định dạng cho phép.
5. Trường hợp ngoại lệ & Xử lý lỗi (Edge Cases)
Trường hợp: Số điện thoại sai định dạng.
Xử lý: Hiển thị lỗi tại trường nhập.
Trường hợp: Mật khẩu mới quá ngắn.
Xử lý: Từ chối cập nhật và báo lỗi.
Trường hợp: Upload ảnh không hợp lệ.
Xử lý: Hiển thị thông báo lỗi.
6. Giao diện (UI/UX)
Form thông tin cá nhân dễ nhìn.
Có ảnh đại diện và nút đổi ảnh.
Có nút lưu thay đổi rõ ràng.
