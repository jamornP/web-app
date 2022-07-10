<?php
namespace App\Model;
use App\Database\Db;

class Certificate extends Db {

    public function getAllPerson() {
        $sql ="
            SELECT
                ca.*,
                pdf.address
            FROM
                tb_certificate_data AS ca
                LEFT JOIN tb_certificate_pdf AS pdf ON ca.t_num = pdf.t_num AND ca.project = pdf.project
            ORDER BY
                ca.project,    
                ca.t_num
            LIMIT 3
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getAllPersonProject($project) {
        $sql ="
            SELECT
                ca.*,
                pdf.address
            FROM
                tb_certificate_data AS ca
                LEFT JOIN tb_certificate_pdf AS pdf ON ca.t_num = pdf.t_num AND ca.project = pdf.project
            WHERE
                ca.project ='{$project}'
            ORDER BY
                ca.project,    
                ca.t_num
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getAllCA() {
        $sql ="
            SELECT
                project
            FROM
                tb_certificate_data
            GROUP BY
                project
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function addPDF($data) {
        $sql = "
            INSERT INTO tb_certificate_pdf (
                id,
                project,
                t_num,
                address
            ) VALUES (
                NULL,
                :project,
                :t_num,
                :address
            )
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $this->pdo->lastInsertId();
    }

    public function getPersonByName($name) {
        $sql = "
            SELECT 
                ca.*,
                pdf.address 
            FROM
                tb_certificate_data AS ca
                LEFT JOIN tb_certificate_pdf AS pdf ON ca.t_num = pdf.t_num AND ca.project = pdf.project
            WHERE 
                name ='".$name."'
        ";
        $stmt = $this->pdo->query($sql);
        $stmt->execute(); 
        $data = $stmt->fetchAll();
        return $data;
    }
}
?>