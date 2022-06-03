<?php

namespace App\Controller;

use PDO;
use PDOException;

class DatabaseController
{
    public function connectToDatabase(): PDO
    {
        $dsn = "mysql:host=" . $_SESSION['ini_array']['host'] . ";dbname=" . $_SESSION['ini_array']['db'] . ";charset=" . $_SESSION['ini_array']['charset'];
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $pdo = new PDO($dsn, $_SESSION['ini_array']['user'], $_SESSION['ini_array']['pass'], $opt);
            return $pdo;
        } catch (PDOException $e) {
            print "Has errors: " . $e->getMessage();
            die();
        }
    }

    public function getPostsFromDatabase(PDO $pdo, int $limit): array
    {
        $posts = [];

        $query = 'SELECT `id_post`, `name`,  `date_added` FROM `post_file` ORDER BY `id_post` DESC LIMIT :limit';
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'limit' => $limit
        ]);
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            $post = [
                'id_post' => $row->id_post,
                'name' => $row->name,
                'date_added' => $row->date_added
            ];
            $posts[] = $post;
        }

        return $posts;
    }

    public function getMorePosts(PDO $pdo, int $endpoint, int $limit): array
    {
        $posts = [];

        $query = 'SELECT `id_post`, `name`,  `date_added` FROM `post_file` WHERE `id_post` < :endpoint ORDER BY `id_post` DESC LIMIT :limit';
        if (!empty($pdo)) {
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                'endpoint' => $endpoint,
                'limit' => $limit
            ]);
            while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                $post = [
                    'id_post' => $row->id_post,
                    'name' => $row->name,
                    'date_added' => $row->date_added
                ];
                $posts[] = $post;
            }
        }
        return $posts;
    }

    public function checkUserPhone(PDO $pdo, string $name, string $email, string $tel, string $password)
    {
        $query = 'SELECT * FROM `user` WHERE `phone` = :phone;';
        $params = [
            'phone' => $tel
        ];
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        if ($stmt->rowCount() == 0) {
            $this->regUser($pdo, $name, $email, $tel, $password);
        } else {
            $_SESSION['user'] = [
                'status' => 0,
                'message' => 'Такой телефон уже существует'
            ];
        }
    }

    private function regUser(PDO $pdo, string $name, string $email, string $phone, string $password)
    {
        $query = "INSERT INTO `user` (`user_name`, `email`, `phone`, `password`, `token`) VALUES ( :name_users, :email, :phone, :password, :token)";
        $params = [
            'name_users' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'token' => 'token'
        ];
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $this->getUser($pdo, $phone, $password);
    }

    public function getUser(PDO $pdo, string $telephone, string $password)
    {
        $stmt = $pdo->prepare("SELECT `id_user`, `id_role`, `user_name`, `date_of_last_visit`, `password`, `email` FROM `user` WHERE `phone` = ?");
        $stmt->execute([
            $telephone
        ]);
        $row = $stmt->fetch(PDO::FETCH_LAZY);
        if ($stmt->rowCount() == 0 || !password_verify($password, $row->password)) {
            $_SESSION['user'] = [
                "status" => 0,
                "message" => 'Неверный логин или пароль'
            ];
        } else {
            $stmt = $pdo->prepare("UPDATE `user` SET `date_of_last_visit`= now() WHERE `phone` = :phone");
            $stmt->execute([
                $telephone
            ]);
            $_SESSION['user'] = [
                "status" => 1,
                "id_user" => $row->id_user,
                "id_role" => $row->id_role,
                "user_name" => $row->user_name,
                "phone" => $telephone,
                "email" => $row->email,
                "last_visit" => date('d.m.Y H:i')
            ];
            $token = $this->generateToken();
            $this->updateUserToken($pdo, $_SESSION['user']['id_user'], $token);
        }
    }

    private function generateToken(int $length = 64, string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
    {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[rand(0, $max)];
        }
        return implode('', $pieces);
    }

    private function updateUserToken(PDO $pdo, int $userId, string $token): void
    {
        $query = 'UPDATE `user` SET `token` = :token WHERE `id_user` = :id_user';
        $params = [
            'token' => $token,
            'id_user' => $userId
        ];
        $pdo->prepare($query)->execute($params);
        setcookie('token', $token);
        $_SESSION['token'] = $token;
    }

    public function getPostDetailPage(PDO $pdo, int $id_post): array
    {
        $post = [];
        $query = 'SELECT `user_name`, `name`, `date_added`, `description`, `link` FROM `post_file` `pf`, `user` `u` WHERE `id_post` = :id_post AND `u`.`id_user` = `pf`.`id_user`';
        $params = [
            'id_post' => $id_post
        ];
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            $post = [
                'user_name' => $row->user_name,
                'name' => $row->name,
                'date_added' => $row->date_added,
                'description' => $row->description,
                'link' => $row->link
            ];
        }
        return $post;
    }

    public function getUserAllPosts(PDO $pdo): array
    {
        $all_posts = [];

        $query = 'SELECT `id_post`, `name`,  `date_added` FROM `post_file` WHERE `id_user` = :id_user ORDER BY `id_post` DESC';
        if (!empty($pdo)) {
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                'id_user' => $_SESSION['user']['id_user']
            ]);
            while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                $post = [
                    'id_post' => $row->id_post,
                    'name' => $row->name,
                    'date_added' => $row->date_added
                ];

                $all_posts[] = $post;
            }
        }

        return $all_posts;
    }

    public function addPostToDatabase(PDO $pdo, string $name, string $description): array
    {
        $path_file = 'uploads/' . time() . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $path_file);
        $query = 'INSERT INTO `post_file`(
            `id_file`,
            `id_discipline`,
            `id_user`,
            `name`,
            `expansion`,
            `link`,
            `description`
        ) 
        VALUES(:id_file, :id_discipline, :id_user, :name_post, :expansion, :link, :description)';
        $params = [
            'id_file' => 1,
            'id_discipline' => 9,
            'id_user' => $_SESSION['user']['id_user'],
            'name_post' => $name,
            'expansion' => $_FILES['file']['type'],
            'link' => $path_file,
            'description' => $description
        ];
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return [
            'status' => 1
        ];
    }
}
