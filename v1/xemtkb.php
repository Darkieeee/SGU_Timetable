<html lang="vi">
    <head>
        <meta charset="UTF-8"/>
        
        <title>Xem thời khoá biểu</title>
        
        <!--Link-->
        <link rel="stylesheet" href="css/index.css">        
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/xemtkb.css">
        
        <!--Script-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/f1b5fd7c3a.js" crossorigin="anonymous"></script>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <input type="hidden" id="mssv" value="<?php echo $_POST['mssv']?>"/>
        
        <a class="link" href="index.php"><i class="fa fa-angle-left"></i> Trở về trang chính</a>
        
        <div class="container">
            <div class="student-info">
                <div>
                    <strong>Mã số sinh viên</strong>
                    <div>
                        <span id="student-code"></span>
                    </div>
                </div>
                <div>
                    <strong>Họ tên sinh viên</strong>
                    <div>
                        <span id="student-name"></span>
                    </div>
                </div>
                <div>
                    <strong>Ngày sinh</strong>
                    <div>
                        <span id="student-birth"></span>
                    </div>
                </div>
                <div>
                    <strong>Lớp</strong>
                    <div>
                        <span id="student-class"></span>
                    </div>
                </div>
                <div class="image-container">
                    <img alt="Sweet couple cats" src="images/couple_cats.png"/>
                </div>
            </div>
            
            <button type="button" id='btn-save_timetable' onclick="saveTimeTableAsImage()">Lưu thời khoá biểu</button>
            
            <p id='semester-title'></p>
            
            <table class="timetable-view" id='timetable' cellpadding="0" cellspacing="0">
            </table>
        </div>
        <div class="loading-modal" role="dialog">
            <div class="loading-modal-container">
                <div class="spinner"></div>
                <div class="text"></div>
            </div>
        </div>
    </body>
    <script src="js/timetable.js"></script>
</html>
    

