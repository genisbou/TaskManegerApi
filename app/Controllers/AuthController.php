<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

// No CRUD no Controller REST

class AuthController extends BaseController
{
    public function index()
    {
        //
    }

    public function register()
    {
        // Font : https://codeigniter.com/user_guide/outgoing/response.html

        $rules = [
            'username' => 'required|min_length[3]|max_length[255]',
            'email'    => 'required|valid_email|max_length[255]|is_unique[users.email]',
            'password' => 'required|min_length[6]|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setStatusCode(400 , 'Bad Request')
                ->setJSON([
                    'status'   => 400,
                    'messages' => 'Validation Error',
                ]);      
        }

        $model = new UsersModel();
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        $data = $model->add($username, $email, $password);

        return $this->response->setStatusCode(201 , 'Created')
            ->setJSON([
                'status'   => 201,
                'messages' => 'User Registered Successfully',
            ]);

    }

    public function login()
    {
        helper(['from', 'jwt_helper']);
        // Generar token al Login -> Uusari és qui diu ser Exemple : entrada d'un cinema | Login = comprar entrada

        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setStatusCode(400 , 'Bad Request')
                ->setJSON([
                    'status'   => 400,
                    'messages' => 'Validation Error',
                ]);      
        }
        $model = new UsersModel();
        $usrname = $this->request->getPost('username');
        $modelData = $model->getByUsername($usrname);

        // Usuari no existeix
        if (!$modelData) {
            return $this->response->setStatusCode(401 , 'Unauthorized')
                ->setJSON([
                    'status'   => 401,
                    'messages' => 'Invalid Credentials',
                ]); 
    }
    // Usuari existeix, password incorrecte
    // font : https://www.phptutorial.net/php-tutorial/php-password_verify/
 
        /*
        $user = find_user_by_username($username);

        if ($user && password_verify($password, $user['password'])) {
            // log the user in
            session_regenerate_id();
            $_SESSION['user_id'] = $user['id'];
        } else {
            echo 'Invalid username or password';
        }
        */

        $password = $this->request->getPost('password');
        if (!password_verify($password, $modelData['password'])) {
            return $this->response->setStatusCode(401 , 'Unauthorized')
                ->setJSON([
                    'status'   => 401,
                    'messages' => 'Invalid Credentials',
                ]);
        
        // Credencials correctes, generar token

        
        
}
}
}