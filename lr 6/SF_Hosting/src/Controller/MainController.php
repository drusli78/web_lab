<?php

namespace App\Controller;

use PDO;
use Symfony\Component\HttpFoundation\Response;

class MainController extends BaseController
{
    private DatabaseController $databaseController;

    public function __construct()
    {
        $this->databaseController = new DatabaseController();
    }

    public function notAuthorisedHomepage(): Response
    {
        $pdo = $this->databaseController->connectToDatabase();
        $posts = $this->databaseController->getPostsFromDatabase($pdo, 2);

        return $this->renderTemplate('not_authorised.main_page.php', $posts);
    }

    public function authorisedHomepage()
    {
        if ($_SESSION['user']['id_user'] !== null) {
            $pdo = $this->databaseController->connectToDatabase();
            $posts = $this->databaseController->getPostsFromDatabase($pdo, 2);
            $user_name = $_SESSION['user']['user_name'];
            return $this->renderTemplate('authorised.main_page.php',
                ['posts' => $posts, 'user_name' => $user_name]);
        } else {
            header('Location: /');
            die();
        }
    }

    public function exitUser(): Response
    {
        $_SESSION['user']['status'] = null;
        $_SESSION['user']['id_user'] = null;
        $_SESSION['user']['id_role'] = null;
        $_SESSION['user']['user_name'] = null;
        $_SESSION['user']['email'] = null;
        $_SESSION['user']['phone'] = null;
        $_SESSION['user']['last_visit'] = null;
        $_SESSION['token'] = null;
        $_COOKIE['token'] = null;
        return $this->renderTemplate('info.log.php', $_SESSION['user']);
    }

    public function showMorePostsPage1(): Response
    {
        $endpoint =  (int)($this->clear_string($_GET['endpoint']));
        $pdo = $this->databaseController->connectToDatabase();
        $posts = $this->databaseController->getMorePosts($pdo, $endpoint, 2);
        return $this->renderTemplate('more_posts.page1.php', $posts);
    }

    public function showMorePostsPage2(): Response
    {
        $endpoint =  (int)($this->clear_string($_GET['endpoint']));
        $pdo = $this->databaseController->connectToDatabase();
        $posts = $this->databaseController->getMorePosts($pdo, $endpoint, 2);
        return $this->renderTemplate('more_posts.page2.php', $posts);
    }

    public function registrationUser(): Response
    {
        $name =  $this->clear_string($_POST['name']);
        $email =  $this->clear_string($_POST['email_reg']);
        $tel =  $this->clear_string($_POST['tel']);
        $password =  $this->clear_string($_POST['password_reg']);
        $password_confirm =  $this->clear_string($_POST['password_confirm']);
        $pdo = $this->databaseController->connectToDatabase();
        if (!empty($name) && !empty($email) && !empty($tel) && !empty($password) && !empty($password_confirm)) {
            $this->databaseController->checkUserPhone($pdo, $name, $email, $tel, $password);
        }
        return $this->renderTemplate('info.log.php', $_SESSION['user']);
    }

    public function authorisationUser(): Response
    {
        $telephone = (string)($this->clear_string($_POST['tel_auth']));
        $password =  (string)($this->clear_string($_POST['password_auth']));
        $pdo = $this->databaseController->connectToDatabase();
        $this->databaseController->getUser($pdo, $telephone, $password);
        return $this->renderTemplate('info.log.php', $_SESSION['user']);
    }

    public function checkLog(): Response
    {
        return $this->renderTemplate('info.log.php', $_SESSION['user']);
    }

    private function clear_string(string $str): string
    {
        return trim(($this->filter_string_polyfill($str)));
    }

    private function filter_string_polyfill(string $string): string
    {
        $str = preg_replace('/\x00|<[^>]*>?/', '', $string);
        return str_replace(["'", '"'], ['&#39;', '&#34;'], $str);
    }
    public function postDetailPage()
    {
        $id_post = $_GET['id_post'];
        $pdo = $this->databaseController->connectToDatabase();
        $detail_page = $this->databaseController->getPostDetailPage($pdo, $id_post);
        return $this->renderTemplate('post.detail_page.php', $detail_page);
    }

    public function userDetailPage()
    {
        if($_SESSION['user']['id_user'] !== null) {
            if ($_SESSION['user']['id_role'] == 1) {
                $role = 'Модератор';
            } else {
                $role = 'Пользователь';
            }
            $user = [
                'role' => $role,
                'user_name' => $_SESSION['user']['user_name'],
                'phone' => $_SESSION['user']['phone'],
                'email' => $_SESSION['user']['email']
            ];
            return $this->renderTemplate('user.detail_page.php', $user);
        } else {
            header('Location: /');
            die();
        }
    }

    public function userAllPosts()
    {
         if($_SESSION['user']['id_user'] !== null) {
             $pdo = $this->databaseController->connectToDatabase();
             $allPosts = $this->databaseController->getUserAllPosts($pdo);
             return $this->renderTemplate('user.all_posts.php', $allPosts);
         } else {
             header('Location: /');
             die();
         }
    }

    public function addPost()
    {
        if($_SESSION['user']['id_user'] !== null) {
            $name = $this->clear_string($_POST['name']);
            $description = $this->clear_string($_POST['description']);

            if (!empty($name) && !empty($description) && $this->check_valid()) {
                $pdo = $this->databaseController->connectToDatabase();
                $result = $this->databaseController->addPostToDatabase($pdo, $name, $description);
                return $this->renderTemplate('info.log.php', $result);
            }
        } else {
            header('Location: /');
            die();
        }
    }

    private function check_valid()
    {
        $mimetype = mime_content_type($_FILES['file']['tmp_name']);
        if (!(in_array($mimetype, array('image/jpeg','image/png', 'application/zip', 'application/msword', 'application/x-tex', 'application/pdf', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')))) {
            $_SESSION['user'] = [
                'status' => 0,
                'message' => 'Проверьте mime-type загружаемого файла'
            ];
            return false;
        }

        if (!(in_array($this->getExtension($_FILES['file']['name']), array('jpeg','png','jpg', 'zip', 'doc', 'docx', 'pdf', 'tex', 'xlsx')))) {
            $_SESSION['user'] = [
                'status' => 0,
                'message' => 'Проверьте тип файла'
            ];
            return false;
        }
        return true;
    }

    private function getExtension($filename)
    {
        $path_info = pathinfo($filename);
        return $path_info['extension'];
    }
}
