<?php
namespace App\Model\Sciday;

use App\Database\DbSciDay;

class Esports extends DbSciDay {
    public function InsertEsports($esports) {
        $sql = "
            INSERT INTO tb_esports (
                id, 
                school, 
                team, 
                student_id, 
                teacher_id, 
                tel, 
                file_register, 
                user_id, 
                year
                
            ) VALUES (
                NULL,
                :school, 
                :team, 
                :student_id, 
                :teacher_id, 
                :tel, 
                :file_register, 
                :user_id,
                '2022'
            )
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($esports);
        return $this->pdo->lastInsertId();

    }
    public function getEsportsById($id) {
        $sql = "
            SELECT 
                p.id,
                p.team,
                p.school,
                p.student_id,
                p.teacher_id,
                p.tel,
                p.file_register,
                p.user_id
            FROM
                tb_Esports AS p
                
            WHERE
                p.id = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetchAll();
        return $data[0];
    }
    public function UpdateEsports($esports) {
        $sql = "
            UPDATE 
                tb_esports 
            SET 
                team = :team,
                school = :school,
                student_id = :student_id,
                teacher_id = :teacher_id,
                tel = :tel,
                file_register = :file_register
            WHERE 
                id = :esports_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($esports);
        return true;

    }
    // ใช้กับ navbar
    public function getEsportsByUser($user) {
        $sql = "
            SELECT 
                p.id,
                p.team,
                p.school,
                p.student_id,
                p.teacher_id,
                p.tel,
                p.file_register,
                p.user_id
            FROM
                tb_esports AS p
            WHERE
                p.user_id = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user]);
        $data = $stmt->fetchAll();
        return $data;
    }
}
?>