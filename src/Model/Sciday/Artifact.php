<?php
namespace App\Model\Sciday;

use App\Database\DbSciDay;

class Artifact extends DbSciDay {
    public function InsertArtifact($artifact) {
        $sql = "
            INSERT INTO tb_artifact (
                id, 
                artifact_name, 
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
                :artifact_name, 
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
        $stmt->execute($artifact);
        return $this->pdo->lastInsertId();

    }
    public function getArtifactByLevel($level) {
        $sql = "
            SELECT 
                p.id,
                p.artifact_name,
                l.name AS level,
                p.level_id,
                p.school,
                p.student_id,
                p.teacher_id,
                p.file_register,
                p.images_id,
                p.user_id,
                u.tel
            FROM
                tb_artifact AS p
                LEFT JOIN tb_level AS l ON p.level_id = l.id 
                LEFT JOIN tb_users AS u ON p.user_id = u.id 
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
    public function getArtifactById($id) {
        $sql = "
            SELECT 
                p.id,
                p.artifact_name,
                l.name AS level,
                p.level_id,
                p.school,
                p.student_id,
                p.teacher_id,
                p.file_register,
                p.images_id,
                p.user_id
            FROM
                tb_artifact AS p
                LEFT JOIN tb_level AS l ON p.level_id = l.id 
            WHERE
                p.id = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetchAll();
        return $data[0];
    }

    public function getArtifactByUser($user) {
        $sql = "
            SELECT 
                p.id,
                p.artifact_name,
                l.name AS level,
                p.school,
                p.student_id,
                p.teacher_id,
                p.file_register,
                p.images_id,
                p.user_id
            FROM
                tb_artifact AS p
                LEFT JOIN tb_level AS l ON p.level_id = l.id 
            WHERE
                p.user_id = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user]);
        $data = $stmt->fetchAll();
        return $data;
    }

    public function UpdateArtifact($artifact) {
        $sql = "
            UPDATE 
                tb_artifact 
            SET 
                artifact_name = :artifact_name,
                level_id = :level_id,
                school = :school,
                student_id = :student_id,
                teacher_id = :teacher_id,
                file_register = :file_register,
                images_id = :images_id
                
            WHERE 
                id = :artifact_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($artifact);
        return true;

    }
    public function delArtifactById($id) {
        $sql ="
            DELETE
            FROM
                tb_artifact
            WHERE
                id = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return true;
        
    }

}