<?php

/**
 * Description of Config Controller
 *
 * @author NDalaba
 */
class Controller_Config extends Controller {

    public function before() {
        if (!Session::get('droit'))
            \Fuel\Core\Response::redirect(Uri::create('user/logout'));
    }

    public function action_loadClient() {
        if (Session::get('droit') >= 3) {
            $clients = Model_Client::find('all');
            print(Format::forge($clients)->to_json());
        }
    }

    public function action_loadClientType() {
        if (Session::get('droit') >= 3) {
            $types = DB::query("SELECT * from typeclient")->as_object()->execute();
            print(Format::forge($types)->to_json());
        }
    }

    public function action_getClient($id) {
        $id = (int) $id;
        if (Session::get('droit') >= 3) {
            $client = Model_Client::find($id);
            print(Format::forge($client)->to_json());
        }
    }

    public function action_deleteclient() {
        $id = (int) Input::post('id');
        DB::query("DELETE FROM client WHERE id= " . $id)->execute();
    }

    public function action_saveclient() {
        if (Input::method() === 'POST') {
            if (Input::post('id') == "") {
                $post = array_slice(Input::post(), 1); //On supprimer l'id du tableau qui ne doit pas être affecté (auto increment)                          
                $client = Model_Client::forge($post);
                $client->ajout = time();
                $client->save();
                print(\Fuel\Core\Format::forge(Model_Client::find("last"))->to_json());
            } else {
                $client = Model_Client::find(Input::post('id'));
                $client->nom = Input::post('nom');
                $client->email = Input::post('email');
                $client->type = Input::post('type');
                $client->adresse = Input::post('adresse');
                $client->note = Input::post('note');
                $client->save();
            }
        }
    }

    public function action_loadservices() {
        if (Session::get('droit') >= 3) {
            $services = Model_Service::find('all');
            print(Format::forge($services)->to_json());
        }
    }

    public function action_getService($id) {
        $id = (int) $id;
        if (Session::get('droit') >= 3) {
            $service = Model_Service::find($id);
            print(Format::forge($service)->to_json());
        }
    }

    public function action_deleteservice() {
        $id = (int) Input::post('id');
        DB::query("DELETE FROM service WHERE id= " . $id)->execute();
    }

    public function action_saveservice() {
        if (Input::method() === 'POST') {
            if (Input::post('id') == "") {
                $post = array_slice(Input::post(), 1); //On supprimer l'id du tableau qui ne doit pas être affecté (auto increment)
                $service = Model_Service::forge($post);
                $service->ajout = time();
                $service->save();
            } else {
                $service = Model_Service::find(Input::post('id'));
                $service->service = Input::post('service');
                $service->montant = Input::post('montant');
                $service->note = Input::post('note');
                $service->save();
            }
        }
    }

    public function action_loadvoyage() {
        if (Session::get('droit') >= 3) {
            $voyages = Model_Voyage::getVoyages();
            $i = 0;
            $voyages_lenght = count($voyages);
            $vo = array();
            for ($i; $i < $voyages_lenght; $i++) {
                $vo[] = array(
                    "voyage" => $voyages[$i],
                    "carriers" => $voyages[$i]->carriers,
                    "chtr" => $voyages[$i]->getChtr()
                );
            }
            print(Format::forge($vo)->to_json());
        }
    }

    public function action_getVoyage($id) {
        $voyageid = (int) $id;
        $voyage = Model_Voyage::find($voyageid);
        print(Format::forge($voyage)->to_json());
    }

    public function action_deletevoyage() {
        $id = (int) Input::post('id');
        $sql = "DELETE FROM facturation WHERE facture_id=(SELECT id FROM facture WHERE voyage_id=$id);";
        $sql.="DELETE FROM facture WHERE id=(SELECT id FROM facture WHERE voyage_id=$id);";
        $sql.="DELETE FROM participer WHERE voyage voyage_id=$id;";
        $sql.="DELETE FROM voyage WHERE id=$id;";
        DB::query($sql)->execute();
    }

    public function action_savevoyage() {
        if (Input::method() === 'POST') {
            if (Input::post('id') == "") {
                $post = array_slice(Input::post(), 1); //On supprimer l'id du tableau qui ne doit pas être affecté (auto increment)                          
                $voyage = Model_Voyage::forge($post);
                $voyage->ajout = time();
                $voyage->facture = "NON ENVOYEE";
                $voyage->save();
                $voyage = Model_Voyage::find('last');
                $carriers = Input::post('carrier_id');
                for ($i = 0; $i < count($carriers); $i++)
                    $voyage->$carriers[$i] = Model_Client::find($carriers[$i]);
                $voyage->save();
            } else {
                $id = (int) Input::post('id');
                $voyage = Model_Voyage::find($id);
                $voyage->voyage = Input::post('voyage');
                $voyage->destination = Input::post('destination');
                $voyage->departure = Input::post('departure');
                $voyage->arrival = Input::post('arrival');
                $voyage->vld = Input::post('vld');
                $voyage->laycan = Input::post('laycan');
                $voyage->nor = Input::post('nor');
                $voyage->sail_time = Input::post('sail_time');
                $voyage->fixed = Input::post('fixed');
                $voyage->rate = Input::post('rate');
                $voyage->tonnage = Input::post('tonnage');
                $voyage->bateau = Input::post('bateau');
                $voyage->chtr_id = Input::post('chtr_id');
                $voyage->description = Input::post('description');

                $carriers = array_slice(Input::post('carrier_id'), 1); //le premier element du select est selectionner à cause du reset chosen!

                DB::query("DELETE FROM participer WHERE voyage_id=" . $id)->execute();
                for ($i = 0; $i < count($carriers); $i++)
                    $voyage->carriers[$i] = Model_Client::find($carriers[$i]);
                $voyage->save();
            }
        }
    }

}
