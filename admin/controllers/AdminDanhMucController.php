<?php
 class AdminDanhMucController {
    public $modelDanhmuc;

    public function __construct(){
        $this->modelDanhmuc = new AdminDanhMuc();
    }

    public function danhSachDanhMuc(){
        $listDanhMuc = $this->modelDanhmuc->getAllDanhMuc();
        require_once('views/danhmuc/listDanhMuc.php');
    }

    public function formAddDanhMuc(){
        require_once('views/danhmuc/addDanhMuc.php');
    }
    public function postAddDanhMuc(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            $error = [];
            if(empty($ten_danh_muc)){
                $error['ten_danh_muc'] = 'Vui lòng nhập tên danh mục';
            }
            $_SESSION['error'] = $error;

            if(empty($error)){
                $this->modelDanhmuc->insertDanhMuc($ten_danh_muc, $mo_ta);
                header('Location: ' . BASE_URL_ADMIN .'danh-muc');
                exit();
            }else{
                require_once('views/danhmuc/addDanhMuc.php');
            }
        }
    }

    public function formEditDanhMuc(){
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhmuc->getDetailDanhMuc($id);
        if($danhMuc){
            require_once('views/danhmuc/editDanhMuc.php');
        }else{
            echo 'Danh mục không tồn tại';
            header('Location:' . BASE_URL_ADMIN . 'danh-muc');
            exit();
        }
    }

    public function postEditDanhMuc(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            // //tạo một mảng trống để chứa dữ liệu
            $error = [];
            if(empty($error)){
               $this -> modelDanhmuc -> updateDanhMuc($id, $ten_danh_muc, $mo_ta);
               header('Location: ' . BASE_URL_ADMIN . 'danh-muc');
               exit();
            }else{
                $danhMuc = ['id' => $id , 'ten_danh_muc' => $ten_danh_muc , 'mo_ta'=>$mo_ta];
                require_once('views/danhmuc/editDanhMuc.php');
            }
        }
    }

    public function deleteDanhMuc(){
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhmuc->getDetailDanhMuc($id);

        if($danhMuc){
            $this->modelDanhmuc->destroyDanhMuc($id);
        }
        header('Location: '. BASE_URL_ADMIN . 'danh-muc');
        exit();
    }
}
?>