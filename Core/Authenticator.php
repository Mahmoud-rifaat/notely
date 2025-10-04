<?php

namespace Core;

class Authenticator
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }


    public function attempt($credentials)
    {
        $user = $this->db->query(
            "SELECT * FROM users WHERE email = :email",
            [
                "email" => $credentials['email']
            ]
        )->find();

        if ($user && password_verify($credentials['password'], $user['password'])) {
            $this->login([
                'name' => $user['name'],
                'id' => $user['id'],
                'email' => $user['email']
            ]);

            return true;
        }

        return false;
    }

    public function login($user)
    {
        $_SESSION['user'] = [
            'name' => $user['name'],
            'id' => $user['id'],
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}
