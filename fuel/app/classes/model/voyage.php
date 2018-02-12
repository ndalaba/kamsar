<?php

/**
 * Description of Voyage
 *
 * @author NDalaba
 */
use Orm\Model;

class Model_Voyage extends Model {

    protected static $_table_name = 'voyage';
    protected static $_properties = array('id', 'voyage', 'departure', 'destination', 'arrival', 'vld', 'laycan', 'nor', 'sail_time', 'description', 'bateau', 'ajout', 'tonnage', 'chtr_id', 'facture', 'fixed', 'rate');
    protected static $_many_many = array(
        'carriers' => array(
            'key_from' => 'id',
            'key_through_from' => 'voyage_id',
            'table_through' => 'participer',
            'key_through_to' => 'carrier_id',
            'model_to' => 'Model_Client',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false,
        )
    );

    public static function validVoyage($voyage, $id) {

        $query = DB::query("SELECT id,voyage FROM voyage WHERE voyage='$voyage'")->as_object()->execute();
        if (count($query) > 0) {
            foreach ($query as $v) {
                if ($v->id != $id)
                    return FALSE;
            }
            return TRUE;
        } else
            return TRUE;
    }

    public static function getVoyages() {
        $sql = 'SELECT * FROM voyage ORDER BY id DESC';
        $query = \Fuel\Core\DB::query($sql)->as_object("Model_Voyage")->execute();
        return $query;
    }

    public function getChtr() {
        return Model_Client::find($this->chtr_id);
    }

}
