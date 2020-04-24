<?php


namespace Mail\Controllers;
use Mail\Core\View;
use Mail\Database\Db;
use PHPMailer\PHPMailer\PHPMailer;

class UserController extends Db
{

    public function index()
    {
        View::index('index.php');
    }

    public function registerPage()
    {
        View::index('register.php');
    }

    public function login()
    {
        $sql = $this->connectDB()->query("select * from users where user_email='{$_POST['email']}'");
        if ($sql->num_rows > 0) {
            $row = mysqli_fetch_assoc($sql);
            if ($row['is_confirmed'] == 1 && password_verify($_POST['password'], $row['user_password'])) {



                session_start();

                $_SESSION['email'] = $row['user_email'];


                $email = $_SESSION['email'];

                [$name] = explode('@', $email);

                header("location:/dashboard/{$name}");

            } else {
                header('location: /');
            }
        }else
        {
            header('location: /');
        }
    }

    public function registerUser()
    {

           $checkEmail =  $this->connectDB()->query("select id from users where user_email='{$_POST['email']}'");
            if ($checkEmail->num_rows > 0)
            {
                echo $msg = 'This email already exist';
            }
            else
            {

                $name = $_POST['name'];

                $string = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890!$()*';
                $string = str_shuffle($string);
                $token = substr($string, 0, 10);

                $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

                $this->connectDB()->query("insert into users (user_name,user_email,user_password,is_confirmed,token) values ('{$_POST['name']}', '{$_POST['email']}', '{$hashedPassword}', '0', '{$token}')");

                $mail = new PHPMailer();

                $mail->SMTPDebug = 3;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = '';                 // SMTP username
                $mail->Password = '';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;

                $mail->setFrom('akotikovs7@gmail.com', 'Arturs');
                $mail->addAddress($_POST['email'], $_POST['name']);
                $mail->Subject = "Please verify your email";
                $mail->isHTML(true);
                $mail->Body = "
                
                    Please click to this link to verify your email: <br><br>
                    <a href='localhost:8080/confirm/{$name}&token{$token}'>Copy this link to new blank: localhost:8080/confirm/{$name}&{$token}</a>
                
                ";

                if ($mail->send())
                {
                   echo  $msg = "You have been successfully registered";
                    header('location:/');
                }else
                {
                    echo $msg = "Something gone wrong please try letter";
                }

               echo  $msg = 'Check your email';
            }

        View::index('index.php');
    }

    public function confirm($vars)
    {
        $this->connectDB()->query("update users set is_confirmed='1' where token='{$vars['token']}'");

        $sql = $this->connectDB()->query("select user_email from users where user_email like '{$vars['userEmail']}%'");
        $row = mysqli_fetch_assoc($sql);

        [$name] = explode('@', $row['user_email']);

        $_SESSION['email'] = $name;
        View::index('dashboard.php', [$_SESSION['email']]);
    }

    public function dashboard($vars)
    {
            $sql = $this->connectDB()->query("select user_email from users where user_email like '{$vars['userEmail']}%'");
            $row = mysqli_fetch_assoc($sql);

            [$name] = explode('@', $row['user_email']);

            $_SESSION['email'] = $name;

            if ($vars['userEmail'] == $name)
            {
                $_SESSION['email'] = $name;
                View::index('dashboard.php', [$_SESSION['email']]);
            }else
            {
                header('location: /');
            }
    }
}