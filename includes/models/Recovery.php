<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-26
 * Time: 11:17 AM
 */
class _Recovery extends Model
{
    /**
     * _Recovery constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getUIDFromEmail($email)
    {
        $res = $this->db->select("SELECT `user_id` FROM `users` WHERE email = :email ", array(':email' => $email));

        if (count($res) == 1)
            return $res[0]['user_id'];
        else
            return false;
    }

    private function getName($uid)
    {
        return $this->db->select("SELECT first_name, last_name FROM users WHERE user_id = :id", array(':id' => $uid))[0];
    }

    private function getUIDFromKey($key)
    {
        $res = $this->db->select("SELECT `user_id` FROM `password_recovery` WHERE `reset_key` = :key ", array(':key' => $key));

        if (count($res) == 1)
            return $res[0]['user_id'];
        else
            return false;
    }

    public function newRequest($email)
    {
        $key = md5(microtime() . rand()); //generate a random and unique key to identify the reset request

        $uid = $this->getUIDFromEmail($email);

        if ($uid === false) {
            //Email doesn't exist error;
            return 0;
        }

        if (!$this->db->insert('password_recovery', array('reset_key' => $key, 'user_id' => $uid))) {
            //Generic error
            return -1;
        }

        $name = $this->getName($uid);

        if ($this->sendRecovery($email, $key, $name['first_name'], $name['last_name']))
            return 1;
        else
            return -1;
    }

    public function sendRecovery($email, $key, $fname, $lname)
    {
        $mail = new PHPMailer();

        $mail->isSMTP();
        //$mail->SMTPDebug =3;
        $mail->Host = EMAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL_USER;
        $mail->Password = EMAIL_PASS;
        $mail->Port = EMAIL_PORT;

        $mail->setFrom(EMAIL_USER, 'Bana Account Recovery');
        $mail->addAddress($email, $fname . ' ' . $lname);

        $mail->isHTML(true);

        $mail->Subject = 'Dammit, you forgot your password again?';
        $mail->Body = $this->makeMessage($key, $email, $fname . ' ' . $lname);

        if (!$mail->send()) {
//            echo 'Message could not be sent.';
//            echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        } else {
            return true;
        }

    }

    private function makeMessage($key, $email, $name)
    {
        $url = URL . 'auth/doReset?email=' . $email . '&key=' . $key;

        $htmlFile = file_get_contents(PATH . 'views/mail/recovery.php');
        $htmlFile = str_replace("{URL}", $url, $htmlFile);
        $htmlFile = str_replace("{NAME}", $name, $htmlFile);

        return $htmlFile;
    }

    public function validateRequest($uid, $key)
    {
        if ($uid != $this->getUIDFromKey($key)) {
            return false;
        } else
            return $uid;

    }

    public function resetPassword($uid, $key, $password)
    {
        if ($this->validateRequest($uid, $key) === false)
            return false;
        else
            return $this->db->update('users', array('password' => $password), "`user_id` = $uid");
    }

}