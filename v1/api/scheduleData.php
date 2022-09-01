<?php
    include '../simple_html_dom.php';
    include '../Monhoc.php';
    include '../Date.php';
    if(!isset($_GET['mssv']) || !$_GET['mssv'] || !preg_match("/^31\d{8}$/", $_GET['mssv'])) {
        echo json_encode(array(
            "status" => "fail",
            "message" => "Mã sinh viên không hợp lệ"
        ), JSON_UNESCAPED_UNICODE);
    }
    else {
        $mssv = $_GET['mssv'];
        $url = "http://thongtindaotao.sgu.edu.vn/Default.aspx?page=thoikhoabieu&sta=1&id=$mssv";
        $html = file_get_html($url);
        
        if(count($html -> find("#ctl00_ContentPlaceHolder1_ctl00_pnlTKB")) > 0) {
            //Data1: [Tên sinh viên - Ngày sinh: xx/xx/xxxx]
            $data1 = explode(" - ", $html -> getElementById("ctl00_ContentPlaceHolder1_ctl00_lblContentTenSV") -> plaintext);
            $tensv = $data1[0];
            $ngaysinh = substr($data1[1], strpos($data1[1], ":") + 1, strlen($data1[1]));
            
            $lop = $html -> getElementById("ctl00_ContentPlaceHolder1_ctl00_lblContentLopSV") -> plaintext;
            
            $hocky_namhoc = $html -> getElementById("ctl00_ContentPlaceHolder1_ctl00_ddlChonNHHK") -> find("option[selected]", 0) -> value;
            
            $data2 = $html -> getElementById("ctl00_ContentPlaceHolder1_ctl00_lblNote") -> plaintext;
            preg_match("/\d{2}\/\d{2}\/\d{4}/", $data2, $matches);
            $ngaybd_hocky = $matches[0];
            
            $dsmh = array();
            foreach($html -> find("div.grid-roll2 > table > tr") as $monhocDOM) {
                $mamh = $monhocDOM -> children(0) -> plaintext;
                $tenmh = trim($monhocDOM -> children(1) -> plaintext);
                $malop = $monhocDOM -> children(4) -> plaintext;

                $monhoc = new Monhoc($mamh, $tenmh, $malop);

                $sobuoihoc = count($monhocDOM -> children(8) -> find("div, table.body-table"));

                for($i = 0; $i < $sobuoihoc; $i++) {
                    $thu = $monhocDOM -> children(8) -> find("div, table.body-table", $i) -> plaintext;
                    $phong = $monhocDOM -> children(11) -> find("div, table.body-table", $i) -> plaintext;
                    $gv = $monhocDOM -> children(12) -> find("div, table.body-table", $i) -> plaintext;
                    $tietbd = $monhocDOM -> children(9) -> find("div, table.body-table", $i) -> plaintext;
                    $sotiet = $monhocDOM -> children(10) -> find("div, table.body-table", $i) -> plaintext;
                    $ngayhoc = $monhocDOM -> children(13) -> find("div, table.body-table", $i) -> plaintext;

                    $monhoc -> themTiethoc(Date::convertDatetoInt($thu, Date::$LOCALE_VN), 
                                           $phong, 
                                           $gv, 
                                           $tietbd, 
                                           $sotiet, 
                                           $ngayhoc);

                }

                $dsmh[] = $monhoc;
            }

            echo json_encode(array(
                "status" => "success",
                "tensv" => $tensv,
                "ngaysinh" => $ngaysinh,
                "lop" => $lop,
                "hocky_namhoc" => $hocky_namhoc,
                "ngaybd_hocky" => $ngaybd_hocky,
                "dsmh" => $dsmh,
            ), JSON_UNESCAPED_UNICODE);
        }
        else {
            echo json_encode(array(
                "status" => "fail",
                "message" => "Không tìm thấy thông tin sinh viên"
            ), JSON_UNESCAPED_UNICODE);
        }
    }
