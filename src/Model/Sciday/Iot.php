<?php
namespace App\Model\Sciday;

use App\Database\DbSciDay;

class Iot extends DbSciDay {

    public function InsertIot($iot) {
        $sql = "
            INSERT INTO tb_iot(
                id, 
                iot_name, 
                school, 
                student_id, 
                teacher_id, 
                tel, 
                file_register, 
                user_id, 
                level_id,
                year
                
            )VALUES (
                NULL,
                :iot_name,
                :school,
                :student_id,
                :teacher_id,
                :tel,
                :file_register,
                :user_id,
                :level_id,
                '2022'
            )
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($iot);
        return $this->pdo->lastInsertId();

    }
    public function getIotByUser($user) {
        $sql = "
            SELECT 
                a.id,
                a.school,
                a.iot_name,
                a.student_id,
                a.teacher_id,
                a.tel,
                a.file_register,
                a.user_id
            FROM
                tb_iot AS a 
            WHERE
                user_id = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user]);
        $data = $stmt->fetchAll();
        return $data;
    }

    public function getIotById($id) {
        $sql = "
            SELECT 
                p.id,
                p.iot_name,
                p.school,
                p.student_id,
                p.teacher_id,
                p.tel,
                p.level_id,
                p.file_register,
                p.user_id
            FROM
                tb_iot AS p
            WHERE
                p.id = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetchAll();
        return $data[0];
    }
    public function UpdateIot($iot) {
        $sql = "
        UPDATE 
            tb_iot 
        SET 
            iot_name=:iot_name,
            school=:school,
            student_id=:student_id,
            teacher_id=:teacher_id,
            tel=:tel,
            file_register=:file_register
        WHERE 
            id=:iot_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($iot);
        return true;
    }
    public function delIotById($id) {
        $sql ="
            DELETE
            FROM
                tb_iot
            WHERE
                id = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return true;
        
    }
    public function getIotByLevel($level) {
        $sql = "
            SELECT 
                a.id,
                a.school,
                a.iot_name,
                a.student_id,
                a.teacher_id,
                a.tel,
                a.level_id,
                a.file_register,
                a.user_id
            FROM
                tb_iot AS a 
            WHERE
                level_id = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$level]);
        $data = $stmt->fetchAll();
        return $data;
    }

}

?>