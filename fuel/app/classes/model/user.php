<?php

/*
 * Description of User
 *
 * @author NDalaba
 */

use Orm\Model;

class Model_User extends Model {

    protected static $_table_name = "admin";
    protected static $_properties = array('id', 'login', 'nom', 'droit', 'pwd');

    public static function checkUser($login) {
        $query = self::find()->where(array('login' => $login));
        return $query->get_one();
    }

    public static function connect($login, $pwd) {
        $password = sha1($pwd);
        $query = self::find()->where(array('login' => $login, 'pwd' => $password));
        return $query->get_one();
    }

    public static function validAdmin($login, $nom) {// verification de l'existance d'un autre administrateur du même login
        $query = self::find()->where(array('login' => $login, 'nom' => $nom));
        if ($query->count > 0)
            return FALSE;
        else
            return TRUE;
    }

}