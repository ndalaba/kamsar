<?php

/**
 * Description of SERVICE
 *
 * @author NDalaba
 */
use Orm\Model;

class Model_Service extends Model {

    protected static $_table_name = 'service';
    protected static $_properties = array('id', 'service', 'montant', 'ajout','note');
    protected static $_many_many = array(
        'factures' => array(
            'key_from' => 'id',
            'key_through_from' => 'service_id',
            'table_through' => 'facturation',
            'key_through_to' => 'facture_id',
            'model_to' => 'Model_Facture',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false,
        )
    );

}
