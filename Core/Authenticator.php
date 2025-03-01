<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {

        $user = (App::resolve(Database::class))->query('SELECT * FROM users WHERE email = :email', ['email' => $email])->find();

        if ($user) {
            if (password_verify($password, $user['password'])) {

                $this->login([
                    'email' => $email,
                    'name' => $user['name'],
                    'image_url' => $user['image_url'],
                    'role' => $user['role_id'] == 1 ? 'admin' : 'customer'

                ]);
                return true;
            }
        }

        return false;
    }

    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email'],
            'name' => $user['name'],
            'image_path' => $user['image_url'],
            'role' => $user['role_id'] == 1 ? 'admin' : 'customer'
        ];
        session_regenerate_id();

    }
    public function logout()
    {
        Session::destroy();
    }
}
