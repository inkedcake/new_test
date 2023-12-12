<?php
class Register_Model extends Model
{
    public function __construct() {
        parent::__construct();
    }
    public function run() {
        header('Content-Type: application/json'); 
        if (
            (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            && ($_POST['password'] == $_POST['password2'])
            && self::validatePhoneNumber($_POST['phone'])
        ) {
            if (!self::userExist($_POST['email'], $_POST['phone'])) {
                $sth = $this->db->prepare(
                    "INSERT INTO users (email, password, phone) VALUES (:email, :password, :phone);"
                );
    
                $data = [
                    ':email' => $_POST['email'],
                    ':password' => MD5($_POST['password']),
                    ':phone' => $_POST['phone'],
                ];
    
                if ($sth->execute($data)) {
                    echo json_encode(['success' => true, 'message' => 'Дані збережені']);
                    exit;
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Email або номер телефону вже існують.']);
                exit;
            }
        }
    
        echo json_encode(['success' => false, 'message' => 'Некоректні дані']);
        exit;
    }

    private function userExist($email, $phone) {
        $checkExisting = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = :email OR phone = :phone");
        $checkExisting->execute([':email' => $email, ':phone' => $phone]);
        
        return (bool)$checkExisting->fetchColumn();
    }

    private function validatePhoneNumber($phoneNumber) {
        $pattern = '/^\+?\d{1,4}?[-. ]?\(?\d{1,5}?\)?[-. ]?\d{1,6}[-. ]?\d{1,5}[-. ]?\d{1,9}$/';

        return preg_match($pattern, $phoneNumber);
    }
    
}