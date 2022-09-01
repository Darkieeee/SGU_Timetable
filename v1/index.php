<html lang="vi">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Thời khoá biểu SGU</title>
        
        <!--Link-->
        <link rel="stylesheet" href="css/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="css/main.css">
        
        <!--Script-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" anonymous></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    </head>
    <body>
        
<!--        Nav will display here  -->
        
        <div class="container">
            <div class="alert alert-warning" role="alert" id="warning-box">
                <span>Dữ liệu thời khoá biểu được hiển thị dựa trên danh sách các môn học đã được đăng ký của học kỳ hiện tại
                      trên trang <a href='http://thongtindaotao.sgu.edu.vn'>thongtindaotao.sgu.edu.vn</a> do đó tình trạng
                      giật lag có thể xảy ra. Các bạn sinh viên nên đọc <a href="gioithieu.php">lưu ý</a> trước khi xem thời khoá biểu.</span>
            </div>
            <form action="xemtkb.php" method="POST">
                <label for="mssv">Nhập mã số sinh viên của bạn</label>
                <input type="text" id="mssv" name="mssv"/>
                <input type="submit" class="btn btn-primary" id="btn-submit" value="OK"/>
            </form>
        </div>
    </body>
    <script type="text/javascript" src="js/index.js"></script>
</html>
