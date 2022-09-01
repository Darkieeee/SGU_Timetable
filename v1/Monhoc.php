<?php

class Monhoc { //class data
    public $mamh;
    public $tenmh;
    public $malop;
    public $tiethoc;
    
    public function __construct($mamh = null, $tenmh = null, $malop = null,  $tiethoc = array()) {
        $this -> mamh = $mamh;
        $this -> tenmh = $tenmh;
        $this -> malop = $malop;
        $this -> tiethoc = $tiethoc;
    }
    
    public function themTiethoc(int $thu,string $phong,string $gv,int $tietbd,int $sotiet,string $ngayhoc) {
        array_push($this -> tiethoc, 
                   array(
                       "thu" => $thu,
                       "phong" => $phong,
                       "gv" => $gv,
                       "tietbd" => $tietbd,
                       "sotiet" => $sotiet,
                       "ngayhoc" => $ngayhoc
                   ));
    }
    
}
