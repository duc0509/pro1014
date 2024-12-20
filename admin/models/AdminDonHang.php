<?php
class AdminDonHang
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllDonHang()
    {
        try {
            $sql = 'SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai
            FROM don_hangs
            INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
            ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }

    }
    public function getDetailDonHang($id){
        try {
            $sql = 'UPDATE don_hangs
                    SET
                    ten_nguoi_nhan = :ten_nguoi_nhan,
                    sdt_nguoi_nhan = :sdt_nguoi_nhan,
                    email_nguoi_nhan = :email_nguoi_nhan,
                    dia_chi_nguoi_nhan = :dia_chi_nguoi_nhan,
                    ghi_chu = :ghi_chu,
                    trang_thai_id = :trang_thai_id
                    WHERE id = :id';
                    $stmt = $this->conn->prepare($sql);

                    $stmt->execute([
                        ':ten_nguoi_nhan' => $ten_nguoi_nhan,
                        ':sdt_nguoi_nhan' => $sdt_nguoi_nhan,
                        ':email_nguoi_nhan' => $email_nguoi_nhan,
                        ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
                        ':ghi_chu' => $ghi_chu,
                        ':trang_thai_id' => $trang_thai_id,
                        ':id' => $id
                    ]);
                    return true;
            
        } catch (Exception $e){
            echo "Error" . $e->getMessage();
        }
    }

    public function getDonHangFromKhachHang($id)
    {
        try {
            $sql = 'SELECT don_hang.*, trang_thai_don_hangs.ten_trang_thai
            FROM don_hangs
            INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
            WHERE don_hangs.tai_khoan_id = :id
            ';
            $stmt = $this->conn->prepare($sql);
            $stmt ->excute([
                ':id' => $id
            ]);
            return $stmt ->fetchAll();
        } catch (Exception $e){
            echo "Error" . $e->getMassage();
        }
    }
}
?>