<?php
namespace App\Model\Sciday;

use App\Database\DbSciDay;

class Micro extends DbSciDay {
    public function InsertMicro($micro) {
        $sql = "
            INSERT INTO tb_micro(
                id, 
                micro_name, 
                level_id, 
                school, 
                student_id, 
                teacher_id, 
                file_register, 
                images_id,
                user_id,
                year
            ) VALUES (
                NULL,
                :micro_name, 
                :level_id, 
                :school, 
                :student_id, 
                :teacher_id, 
                :file_register, 
                :images_id,
                :user_id,
                '2022'
            )
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($micro);
        return $this->pdo->lastInsertId();

    }
    public function getMicroByUser($user) {
        $sql = "
            SELECT 
                p.id,
                p.micro_name,
                p.school,
                p.student_id,
                p.teacher_id,
                p.file_register,
                p.user_id
            FROM
                tb_micro AS p
            WHERE
                p.user_id = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user]);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getMicroById($id) {
        $sql = "
            SELECT 
                p.id,
                p.micro_name,
                l.name AS level,
                p.level_id,
                p.school,
                p.student_id,
                p.teacher_id,
                p.file_register,
                p.images_id,
                p.user_id,
                p.level_id
            FROM
                tb_micro AS p
                LEFT JOIN tb_level AS l ON p.level_id = l.id 
            WHERE
                p.id = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetchAll();
        return $data[0];
    }
    public function UpdateMicro($micro) {
        $sql = "
            UPDATE 
                tb_micro 
            SET 
                micro_name = :micro_name,
                level_id = :level_id,
                school = :school,
                student_id = :student_id,
                teacher_id = :teacher_id,
                file_register = :file_register,
                images_id = :images_id
            WHERE 
                id = :micro_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($micro);
        return true;


    }
    public function delMicroById($id) {
        $sql ="
            DELETE
            FROM
                tb_micro
            WHERE
                id = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return true;
        
    }
    public function getMicroByLevel($level) {
        $sql = "
            SELECT 
                p.id,
                p.micro_name,
                l.name AS level,
                p.level_id,
                p.school,
                p.student_id,
                p.teacher_id,
                p.file_register,
                p.images_id,
                p.user_id
            FROM
                tb_micro AS p
                LEFT JOIN tb_level AS l ON p.level_id = l.id 
            WHERE
                p.level_id = ?
            ORDER BY 
                date_at
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$level]);
        $data = $stmt->fetchAll();
        return $data;
    }
}