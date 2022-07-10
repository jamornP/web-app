<?php
namespace App\Model\Sciday;

use App\Database\DbSciDay;

class Round extends DbSciDay {
    public function InsertRound($data) {
        $sql = "
            INSERT INTO tb_round (
                id, 
                project_id, 
                activity_id, 
                level_id, 
                link_video, 
                num,
                score
            ) VALUES (
                NULL, 
                :project_id, 
                :activity_id, 
                :level_id, 
                :link_video, 
                :num,
                NULL
            )
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $this->pdo->lastInsertId();

    }
    public function getRound2ByLevel($level) {
        $sql = "
        SELECT
            p.id, 
            p.project_name,
            p.school,
            p.student_id,
            p.teacher_id,
            p.file_register,
            p.user_id,
            l.name,
            r.num,
            r.link_video,
            r.score,
            r.level_id,
            r.project_id,
            r.activity_id
        FROM 
            tb_round AS r
            LEFT JOIN tb_project AS p ON r.project_id = p.id
            LEFT JOIN tb_level AS l ON r.level_id = l.id
        WHERE
            r.level_id = ? AND r.num = 2
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$level]);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function checkRound2ById($id) {
        $sql = "
        SELECT
            p.id, 
            p.project_name,
            p.school,
            p.student_id,
            p.teacher_id,
            p.file_register,
            p.user_id,
            l.name,
            r.num,
            r.link_video,
            r.score,
            r.level_id,
            r.project_id,
            r.activity_id 
        FROM 
            tb_round AS r
            LEFT JOIN tb_project AS p ON r.project_id = p.id
            LEFT JOIN tb_level AS l ON r.level_id = l.id
        WHERE
            r.project_id = ? AND r.num = 2
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
    public function getRound2ById($id) {
        $sql = "
        SELECT
            p.id, 
            p.artifact_name,
            p.school,
            p.student_id,
            p.teacher_id,
            p.file_register,
            p.user_id,
            l.name,
            r.num,
            r.link_video,
            r.score,r.level_id,
            r.project_id,
            r.activity_id 
        FROM 
            tb_round AS r
            LEFT JOIN tb_artifact AS p ON r.project_id = p.id
            LEFT JOIN tb_level AS l ON r.level_id = l.id
        WHERE
            r.project_id = ? AND r.num = 2
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetchAll();
        return $data[0];
        
    }

    public function getRound3ByLevel($level) {
        $sql = "
        SELECT
            p.id, 
            p.project_name,
            p.school,
            p.student_id,
            p.teacher_id,
            p.file_register,
            p.user_id,
            l.name,
            r.num,
            r.link_video,
            r.level_id,
            r.project_id,
            r.activity_id 
        FROM 
            tb_round AS r
            LEFT JOIN tb_project AS p ON r.project_id = p.id
            LEFT JOIN tb_level AS l ON r.level_id = l.id
        WHERE
            r.level_id = ? AND r.num = 3
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$level]);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function checkRound3ById($id) {
        $sql = "
        SELECT
            p.id, 
            p.project_name,
            p.school,
            p.student_id,
            p.teacher_id,
            p.file_register,
            p.user_id,
            l.name,
            r.num,
            r.link_video,
            r.level_id,
            r.project_id,
            r.activity_id 
        FROM 
            tb_round AS r
            LEFT JOIN tb_project AS p ON r.project_id = p.id
            LEFT JOIN tb_level AS l ON r.level_id = l.id
        WHERE
            r.project_id = ? AND r.num = 3
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
public function getRound3ById($id) {
        $sql = "
        SELECT
            p.id, 
            p.project_name,
            p.school,
            p.student_id,
            p.teacher_id,
            p.file_register,
            p.user_id,
            l.name,
            r.num,
            r.link_video,
            r.score,
            r.level_id,
            r.project_id,
            r.activity_id 
        FROM 
            tb_round AS r
            LEFT JOIN tb_project AS p ON r.project_id = p.id
            LEFT JOIN tb_level AS l ON r.level_id = l.id
        WHERE
            r.project_id = ? AND r.num = 3
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetchAll();
        return $data[0];
        
    }
    public function getRoundById($id,$num) {
        $sql = "
        SELECT
            p.id, 
            p.project_name,
            p.school,
            p.student_id,
            p.teacher_id,
            p.file_register,
            p.user_id,
            l.name,
            r.num,
            r.link_video,
            r.level_id,
            r.project_id,
            r.activity_id 
        FROM 
            tb_round AS r
            LEFT JOIN tb_project AS p ON r.project_id = p.id
            LEFT JOIN tb_level AS l ON r.level_id = l.id
        WHERE
            r.project_id = ? AND r.num = '".$num."' 
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetchAll();
        return $data;
        
    }
    public function UpdateVideo($data) {
        $sql = "
        UPDATE 
            tb_round 
        SET 
            link_video= :link_video
        WHERE     
            project_id= :project_id AND
            activity_id= :activity_id AND
            level_id= :level_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return true;

    }
    // check ทีมที่เข้ารอบ ว่ามีใน Database หรือไม่
    public function checkRound($id,$num,$activity,$level) {
        $sql ="
            SELECT 
                *
            FROM
                tb_round
            WHERE
                project_id = ? AND
                activity_id = ".$activity." AND
                level_id = ".$level." AND
                num = ".$num."
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
// answer
    public function getAnswerRound2ByLevel($level) {
        $sql = "
        SELECT
            p.id, 
            p.school,
            p.student_id,
            p.teacher_id,
            p.file_register,
            p.user_id,
            p.tel,
            l.name,
            r.num,
            r.link_video,
            r.score,
            r.level_id,
            r. project_id,
            r.activity_id 
        FROM 
            tb_round AS r
            LEFT JOIN tb_answer AS p ON r.project_id = p.id
            LEFT JOIN tb_level AS l ON r.level_id = l.id
        WHERE
            r.level_id = ? AND r.num = 2
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$level]);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getRound($id,$num,$activity,$level) {
        $sql ="
            SELECT 
                *
            FROM
                tb_round
            WHERE
                project_id = ? AND
                activity_id = ".$activity." AND
                level_id = ".$level." AND
                num = ".$num."
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetchAll();
        return $data[0];
        
    }
    public function getRoundByLevel($level,$num,$activity) {
        $sql ="
            SELECT
                p.id, 
                p.artifact_name,
                p.school,
                p.student_id,
                p.teacher_id,
                p.file_register,
                p.user_id,
                l.name,
                r.num,
                r.link_video,
                r.level_id,
                r.activity_id 
            FROM 
                tb_round AS r
                LEFT JOIN tb_artifact AS p ON r.project_id = p.id
                LEFT JOIN tb_level AS l ON r.level_id = l.id
            WHERE
                r.level_id = ? AND
                r.num = ".$num." AND
                r.activity_id = ".$activity." 
                
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$level]);
        $data = $stmt->fetchAll();
        return $data;
        
    }
    public function delRound($id,$num,$activity,$level) {
        $sql ="
            DELETE
            FROM
                tb_round
            WHERE
                project_id = ? AND
                activity_id = ".$activity." AND
                level_id = ".$level." AND
                num = ".$num."
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return true;
        
    }
    // Answer
    public function getRoundByLevelAnswer($level,$num,$activity) {
        $sql ="
            SELECT
                p.id, 
                p.school,
                p.student_id,
                p.teacher_id,
                p.file_register,
                p.user_id,
                p.tel,
                l.name,
                r.num,
                r.link_video,
                r.level_id,
                r.activity_id, 
                r.project_id
            FROM 
                tb_round AS r
                LEFT JOIN tb_answer AS p ON r.project_id = p.id
                LEFT JOIN tb_level AS l ON r.level_id = l.id
            WHERE
                r.level_id = ? AND
                r.num = ".$num." AND
                r.activity_id = ".$activity." 
                
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$level]);
        $data = $stmt->fetchAll();
        return $data;
        
    }
    // Artifact
    public function getRoundByLevelArtifact($level,$num,$activity) {
        $sql ="
            SELECT
                p.id, 
                p.artifact_name,
                p.school,
                p.student_id,
                p.teacher_id,
                p.file_register,
                p.user_id,
                l.name,
                r.num,
                r.link_video,
                r.level_id,
                r.activity_id, 
                r.project_id
            FROM 
                tb_round AS r
                LEFT JOIN tb_artifact AS p ON r.project_id = p.id
                LEFT JOIN tb_level AS l ON r.level_id = l.id
            WHERE
                r.level_id = ? AND
                r.num = ".$num." AND
                r.activity_id = ".$activity." 
                
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$level]);
        $data = $stmt->fetchAll();
        return $data;
        
    }
    // Project
    public function getRoundByLevelProject($level,$num,$activity) {
        $sql ="
            SELECT
                p.id, 
                p.project_name,
                p.school,
                p.student_id,
                p.teacher_id,
                p.file_register,
                p.user_id,
                l.name,
                r.num,
                r.link_video,
                r.level_id,
                r.activity_id, 
                r.project_id
            FROM 
                tb_round AS r
                LEFT JOIN tb_project AS p ON r.project_id = p.id
                LEFT JOIN tb_level AS l ON r.level_id = l.id
            WHERE
                r.level_id = ? AND
                r.num = ".$num." AND
                r.activity_id = ".$activity." 
                
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$level]);
        $data = $stmt->fetchAll();
        return $data;
        
    }
    // Iot
    public function getRoundByLevelIot($level,$num,$activity) {
        $sql ="
            SELECT
                p.id, 
                p.iot_name,
                p.school,
                p.student_id,
                p.teacher_id,
                p.file_register,
                p.user_id,
                l.name,
                r.num,
                r.link_video,
                r.level_id,
                r.activity_id, 
                r.project_id
            FROM 
                tb_round AS r
                LEFT JOIN tb_iot AS p ON r.project_id = p.id
                LEFT JOIN tb_level AS l ON r.level_id = l.id
            WHERE
                r.level_id = ? AND
                r.num = ".$num." AND
                r.activity_id = ".$activity." 
                
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$level]);
        $data = $stmt->fetchAll();
        return $data;
        
    }
    // micro
    public function getRoundByLevelMicro($level,$num,$activity) {
        $sql ="
            SELECT
                p.id, 
                p.micro_name,
                p.school,
                p.student_id,
                p.teacher_id,
                p.file_register,
                p.user_id,
                l.name,
                r.num,
                r.link_video,
                r.level_id,
                r.activity_id, 
                r.project_id
            FROM 
                tb_round AS r
                LEFT JOIN tb_micro AS p ON r.project_id = p.id
                LEFT JOIN tb_level AS l ON r.level_id = l.id
            WHERE
                r.level_id = ? AND
                r.num = ".$num." AND
                r.activity_id = ".$activity." 
                
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$level]);
        $data = $stmt->fetchAll();
        return $data;
        
    }
}