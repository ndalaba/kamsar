<?php

/**
 * Description of Page 
 *
 * @author NDalaba
 */
class Controller_Page extends Controller {
    public function action_index() {
        $data['title'] = "Accueil";       
        $view = View::forge('template', $data);
        return $view;
    }
    public function action_route($page = NULL) {       
       return View::forge($page);
    }    
}
