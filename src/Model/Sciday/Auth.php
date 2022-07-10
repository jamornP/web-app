<?php
namespace App\Model\Sciday;
use App\Database\DbSciDay;

 class Auth extends DbSciDay {
    public function checkUser($user) {
        $sql = "
        SELECT
            id,
            name,
            surname,
            email,
            tel,
            role,
            ck,
            activity_id,
            password
        FROM
            tb_users
        WHERE
            email = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user['email']]);
        $data = $stmt->fetchAll();
        $userDB = $data[0];
        if(password_verify($user['password'],$userDB['password'])) {
            session_start();
            $_SESSION['user_id'] = $userDB['id'];
            $_SESSION['name'] = $userDB['name'];
            $_SESSION['surname'] = $userDB['surname'];
            $_SESSION['email'] = $userDB['email'];
            // $_SESSION['p_id'] = $userDB['p_id'];
            // $_SESSION['d_id'] = $userDB['d_id'];
             $_SESSION['role'] = $userDB['role'];
            $_SESSION['activity'] = $userDB['activity_id'];
            $_SESSION['login'] = true;
            // $_SESSION['user_id'] = ;

            return true;
        } else {
            return false;
        }
    }
    public function createUser($user) {
        $user['password'] = password_hash($user['password'],PASSWORD_DEFAULT);

        $sql = "
        INSERT INTO tb_users (
            email,
            password, 
            name, 
            surname, 
            tel, 
            role, 
            ck
            
        ) VALUES (
            :email,
            :password, 
            :name, 
            :surname, 
            :tel, 
            'member', 
            :ck
        )
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($user);

        // session_start();
        // $id = $this->pdo->lastInsertId();
        // $SESSION['id'] = $id;
        // $_SESSION['name'] = $user['name'];
        // $_SESSION['surname'] = $user['surname'];
        // $_SESSION['email'] = $user['email'];
        // $_SESSION['tel'] = $user['tel'];
        // $_SESSION['ck'] = $user['ck'];
        // $_SESSION['role'] = 'member';
    //  $_SESSION['login'] = true;

        return true;
    }
    public function checkEmail($email) {
        $sql = "
            SELECT *
            FROM tb_users
            WHERE email=:email AND tel=:tel
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($email);
        $data = $stmt->fetchColumn();
        if($data>0){
            return true;
        }else{
            return false;
        }
    }
    public function ResetPassword($user) {
        $user['password'] = password_hash($user['password'],PASSWORD_DEFAULT);

        $sql = "
            UPDATE 
                tb_users 
            SET
                password=:password 
            WHERE
                email = :email AND
                tel = :tel
        ";
        $stmt = $this->pdo->prepare($sql);
        $ck = $stmt->execute($user);
        return true;
        
        
    }
}