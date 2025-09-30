<?php

namespace Core;

class Authenticator
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }


    public function attempt($email, $password)
    {
        $user = $this->db->query(
            "SELECT * FROM users WHERE email = :email",
            [
                "email" => $email
            ]
        )->find();

        if ($user && password_verify($password, $user['password'])) {
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
        // clear out the super global, so it can't be referenced anymore
        $_SESSION = [];

        // delete the session file on the server
        session_destroy();

        // delete the cookie
        $params = session_get_cookie_params();
        setcookie(
            'PHPSESSID',
            '',
            time() - 3600,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }
}
