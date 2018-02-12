<?php

/**
 * Description of Facture
 *
 * @author NDalaba
 */
use Orm\Model;

class Model_Facture extends Model {

    protected static $_table_name = "facture";
    protected static $_properties = array('id', 'numero', 'client_id', 'voyage_id', 'ajout', 'validite', 'remise', 'note', 'montant', 'recu', 'reception');
    protected static $_many_many = array(
        'services' => array(
            'key_from' => 'id',
            'key_through_from' => 'facture_id',
            'table_through' => 'facturation',
            'key_through_to' => 'service_id',
            'model_to' => 'Model_Service',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false,
        )
    );

    public static function  getFactures($i = 0, $n = 0) {
        $n = ($n == 0) ? 100 : 0;
        $sql = "SELECT *, FROM_UNIXTIME(ajout) AS ajout, FROM_UNIXTIME(validite) AS validite FROM facture ORDER BY id DESC LIMIT $i,$n";
        $query = \Fuel\Core\DB::query($sql)->as_object("Model_Facture")->execute();
        return $query;
    }

    public static function getOne($id) {
        $sql = "SELECT *, DATE_FORMAT(FROM_UNIXTIME(ajout),'%d-%b-%Y') AS ajout, DATE_FORMAT(FROM_UNIXTIME(validite),'%d-%b-%Y') AS validite FROM facture WHERE id=" . $id;
        $result = \Fuel\Core\DB::query($sql)->as_object("Model_Facture")->execute();
        return $result[0];
    }

    public function getVoyage() {
        return Model_Voyage::find($this->voyage_id);
    }

    public function getClient() {
        return Model_Client::find($this->client_id);
    }

    public static function updateState($voyageId, $state, $recu, $reception) {
        $sql = "UPDATE voyage SET facture='$state' WHERE id=$voyageId;";
        $sql.="UPDATE facture SET recu=$recu, reception='$reception' WHERE voyage_id=$voyageId";
        DB::query($sql)->execute();
    }

    //Voyage dont la facture n'a pas été envoyée
    public static function getNotSend() {
        $sql="SELECT id, voyage, bateau, arrival FROM voyage WHERE facture='NON ENVOYEE'";
        return DB::query($sql)->as_object()->execute();
    }

    //facture envoyée non payée
    public static function getSendNotPayed() {
        $sql = "SELECT facture.id AS id,voyage_id, sendfacture.ajout AS ajout, bateau,voyage, arrival FROM facture"
                . " INNER JOIN sendfacture ON facture.id=sendfacture.facture_id "
                . "INNER JOIN voyage ON voyage.id=facture.voyage_id "
                . "WHERE voyage.facture='ENVOYEE NON PAYEE' GROUP BY sendfacture.facture_id";
        return DB::query($sql)->as_object()->execute();
    }

    public static function remove($id, $voyage_id = 0) {
        $sql = "DELETE FROM facturation WHERE facture_id=$id; DELETE FROM facture WHERE id=$id; ";
        $sql.="UPDATE voyage SET facture='NON ENVOYEE' WHERE id=$voyage_id;";
        return DB::query($sql)->execute();
    }

}
