<?php

/**
 * Description of User Controller
 *
 * @author NDalaba
 */
class Controller_User extends Controller {

    public function action_index() {
        if (Session::get('droit') >= 3) {
            return View::forge('users');
        }
    }

    public function action_loadUser() {
        if (Session::get('droit') >= 3) {
            $users = Model_User::find('all');
            print(Format::forge($users)->to_json());
        }
    }

    public function action_deleteuser() {
        $id=(int)Input::post('id');        
        DB::query("DELETE FROM admin WHERE id= ".$id)->execute();
    }

    public function action_saveuser() {
        if (Input::method() === 'POST') {          
            if (Input::post('id') == "") {
                $post=  array_slice(Input::post(), 1);//On supprimer l'id du tableau qui ne doit pas être affecté (auto increment)                          
                $user = Model_User::forge($post);                
                if (Model_User::checkUser($user->login)) {
                    print('Cet utilisateur existe!');
                } else {                   
                    $user->pwd = sha1(Input::post('pwd'));
                    $user->save();
                }
            } else {
                $user = Model_User::find(Input::post('id'));
                $user->login = Input::post('login');
                $user->nom = Input::post('nom');
                $user->droit = Input::post('droit');
                if (strlen(Input::post('pwd')) != 0)  //Nouveau mot de passe sinon on garde l'encien
                    $user->pwd = sha1(Input::post('pwd'));
                $user->save();
            }
        }
    }

    public function action_login() {
        if (Input::method() === 'POST') {
            $val = Validation::forge();
            $val->add('login', 'Votre login')->add_rule('required');
            $val->add('pwd', 'Mot de passe')->add_rule('required');
            if ($val->run()) {
                $admin = Model_User::connect(Input::post('login'), Input::post('pwd'));
                if (isset($admin)) {
                    $session = Session::instance();
                    $session->set('id', $admin->id);
                    $session->set('login', $admin->login);
                    $session->set('droit', $admin->droit);
                    $session->set('admin', TRUE);
                    Fuel\Core\Response::redirect("/");
                } else {
                    $data['error'] = "Login ou mot de passe incorrect";
                    return View::forge('template', $data);
                }
            } else {
                Fuel\Core\Response::redirect("/");
            }
        } else {
            Fuel\Core\Response::redirect("/");
        }
    }

    public function action_logout() {
        Session::destroy();
        $data['title'] = "Accueil";
        $view = Fuel\Core\View::forge('template', $data);
        return $view;
    }

}
