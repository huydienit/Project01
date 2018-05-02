## Hướng dẫn cài đặt CMS
####Chuẩn bị các yêu cầu cần thiết

1. Máy đã cài đặt PHP phiên bản >= 5.6.4 (Nếu các bạn cài bản Wamp mới nhất lên window thì bạn đã có sẵn phiên bản PHP đạt yêu cầu)

2. Mở các extension cần thiết như sau :
    - OpenSSL PHP Extension
    - PDO PHP Extension
    - Mbstring PHP Extension
    - Tokenizer PHP Extension
    - XML PHP Extension

3. Cài đặt Composer

        Các bạn vào link sau : https://getcomposer.org/Composer-Setup.exe . Tải về phiên bản Composer mới nhất, double click để cài đặt như một phần mềm bình thường. Trong quá trình cài đặt composer, một thông báo sẽ hiện lên hỏi bạn chọn thư mục chứa file php.exe.
        
        Đối với wamp, nó sẽ nằm ở đường dẫn giống thế này C:\wamp\bin\php\phpx.x.x\php.exe hoặc đối với xampp thì là thế này c:\xampp\php\php.x.x.x
        
        Sau đó ấn Next -> Next -> Install để tiến hành cài đặt Composer lên máy.

4. Cấu hình

        Sửa file .env.example thành .env
        
        Chạy lệnh (1) để cập nhật phiên bản mới nhất của các packages.
        
        Thêm config cho domain tại packages\adtech\application\src\configs\
        
        Mở file app.php, ở đây có một số mục bạn cần chú ý như :
        
        app.debug bật debug chi tiết giúp bạn dễ dàng kiểm soát lỗi. Nếu giá trị false thì chỉ có một thông báo ngắn với lỗi 500 được xuất ra (Internal Servel Error)
        
        'url' => 'http://dev.test.vn',
        
        'timezone' => 'Asia/Ho_Chi_Minh'
        
        (Chỉnh thành giờ Việt Nam)
        
        File session.php có mục: 'domain' => 'dev.test.vn',
        
        File site.php chứa khai báo template + module sử dụng trong project.

5. Khai báo database + import

        Thiết lập kết nối database tại packages\adtech\application\src\configs\domain\database.php
        
        Sử dụng lệnh (2) để import database

####Lệnh thường dùng

        (1) commposer update: để cập nhật phiên bản mới nhất của các packages.
        
        (2) php artisan migrate: để chạy toàn bộ file Migrations 
        
        (3) composer dump-autoload: sinh ra lại các file cần thêm vào trong project thông qua autoload_classmap.php.
        
        (4) commposer install: để cài đặt các packages.
        
        (5) php artisan key:generate  : tạo application key ngẫu nhiên
        
        (6) php artisan view:clear  
        
        (7) php artisan config:clear