<?php

class Controller_Facture extends Controller {

    public function before() {
        if (!Session::get('droit'))
            \Fuel\Core\Response::redirect(Uri::create('user/logout'));
    }

    public function action_save() {
        $fact = DB::query('SELECT id FROM facture WHERE voyage_id=' . Fuel\Core\Input::post('voyage_id'))->as_object()->execute();
        $factureid = ($fact[0] == NULL) ? 0 : $fact[0]->id;
        Model_Facture::remove($factureid);
        $facture = Model_Facture::forge(Input::post());
        $facture->ajout = time();
        $facture->validite = time() + 864000;
        $facture->save();
        $lastfacture = Model_Facture::find("last");
        $services = Input::post('services');
        foreach ($services as $value) {
            $facture_id = $lastfacture->id;
            $service_id = $value['id'];
            $montant = $value['montant'];
            DB::query("INSERT INTO facturation value($service_id,$facture_id,$montant)")->execute();
        }
        $facture = self::getFacture($lastfacture->id);
        print(Format::forge($facture)->to_json());
    }

    public function action_updateState() {
        $voyage = Input::post();
        Model_Facture::updateState($voyage['id'], $voyage['facture'], $voyage['recu'], $voyage['reception']);
    }

    public function action_loadFacture() {
        if (Session::get('droit') >= 3) {
            $factures = Model_Facture::getFactures();
            $i = 0;
            $factures_lenght = count($factures);
            $fact = array();
            for ($i; $i < $factures_lenght; $i++) {
                $fact[] = array(
                    "facture" => $factures[$i],
                    "voyage" => $factures[$i]->getVoyage(),
                    "client" => $factures[$i]->getClient()
                );
            }
            print(Format::forge($fact)->to_json());
        }
    }

    public function action_getOne($id) {
        $facture = self::getFacture($id);
        print(Format::forge($facture)->to_json());
    }

    public function action_getLast() {
        $fature = Model_Facture::find("last");
        print(\Fuel\Core\Format::forge($fature)->to_json());
    }

    public function action_deletefacture($id, $voyage_id) {
        Model_Facture::remove($id, $voyage_id);
    }

    public function action_send() {
        if (isset($_FILES['fichier']) AND $_FILES['fichier']['error'] == 0) {
            $tp_name = $_FILES['fichier']['tmp_name'];
            $file_name = $_FILES['fichier']['name'];
            move_uploaded_file($tp_name, DOCROOT . 'factures/' . $file_name);

            $email = Email::forge();
            $email->from('my@email.me', Input::post('exp'));
            $email->to(Input::post('destination'), Input::post('client'));
            $email->bcc('facture@afrimarine.com', "Afrimarine Facturation Kamsar");
            $email->subject(Input::post('sujet'));
            $email->body(Input::post('message'));
            $email->attach(DOCROOT . 'factures/' . $file_name);
            try {
                $email->send();
                $message = Model_Message::forge();
                $message->admin_id = Session::get('id');
                $message->ajout = time();
                $message->facture_id = Fuel\Core\Input::post('facture_id');
                $message->note = Fuel\Core\Input::post('message');
                $message->save();
                DB::query("UPDATE voyage SET FACTURE='ENVOYEE NON PAYEE' WHERE id=" . Input::post('voyage_id'))->execute();
                echo '<script type="text/javascript">
                    window.top.window.uploadEnd("1","Message envoyé avec succès");
               </script>';
            } catch (\EmailValidationFailedException $e) {
                echo '<script type="text/javascript">
                    window.top.window.uploadEnd("0","Adresse email client invalide");
               </script>';
            } catch (\EmailSendingFailedException $e) {
                echo '<script type="text/javascript">
                    window.top.window.uploadEnd("0","Erreur envoi messageS");
               </script>';
            }
        }
    }

    public function action_getNotSend() {
        $voyage = Model_Facture::getNotSend();
        print(Fuel\Core\Format::forge($voyage)->to_json());
    }

    public function action_getSendNotPayed() {
        $facture = Model_Facture::getSendNotPayed();
        print(Fuel\Core\Format::forge($facture)->to_json());
    }

    // Transformer en pdf. non utilisé
    /* public function action_topdf() {
      require_once(DOCROOT . "dompdfdompdf_config.inc.php");

      $html = '<html><body>' .
      '<p>Put your html here, or generate it with your favourite ' .
      'templating system.</p>' .
      '</body></html>';

      $dompdf = new DOMPDF();
      $dompdf->load_html($html);
      $dompdf->render();
      $dompdf->stream("sample.pdf");
      } */

    /* private static function deletefacture($id) {
      $sql="DELETE FROM facturation WHERE facture_id=$id; DELETE FROM facture WHERE id=$id";
      DB::query($sql)->execute();
      } */

    private static function getFacture($id) {
        $f = Model_Facture::getOne($id);
        $facture = array(
            "facture" => $f,
            "services" => $f->services,
            "voyage" => $f->getVoyage(),
            "client" => $f->getclient()
        );
        return $facture;
    }

}
