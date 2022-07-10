<?php
namespace App\Model\Sciday;

use App\Database\DbSciDay;

class Showround extends DbSciDay {
    public function ShowByActivity($activity,$round) {
        $sql ="
            SELECT * 
            FROM
                tb_show
            WHERE
                activity_id = ? AND
                round = ".$round
        ;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$activity]);
        $data = $stmt->fetchAll();
        return $data[0];
    }
    public function getAllShowByRound($round) {
        $sql ="
            SELECT * 
            FROM
                tb_show
            WHERE
                round = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$round]);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function UpdateDateshow($data) {
        $sql ="
            UPDATE 
                tb_show 
            SET 
                date_show = :date_show 
            WHERE 
                id = :id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return true;
    }
    public function UpdateShowround($data) {
        $sql ="
            UPDATE 
                tb_show 
            SET 
                showround = :showround 
            WHERE 
                id = :id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return true;
    }
    public function UpdateData($data) {
        $sql ="
            UPDATE 
                tb_show 
            SET 
                edit_data = :edit_data 
            WHERE 
                id = :id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return true;
    }
    public function UpdateVideo($data) {
        $sql ="
            UPDATE 
                tb_show 
            SET 
                edit_video = :edit_video 
            WHERE 
                id = :id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return true;
    }
    public function ckShowroundById($id) {
        $sql ="
            SELECT * 
            FROM
                tb_show
            WHERE
                id = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetchColumn();
        if($data>0){
            return true;
        }else{
            return false;
        }
    }
    public function getAllShowround() {
        $sql ="
            SELECT * 
            FROM
                tb_show
            ORDER BY
                id
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }

}

?>