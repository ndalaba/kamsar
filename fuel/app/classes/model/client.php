<?php

/**
 * Description of Client
 *
 * @author NDalaba
 */
use Orm\Model;

class Model_Client extends Model {

    protected static $_table_name = 'client';
    protected static $_properties = array('id', 'nom', 'adresse','ajout','email','type','note');
    protected static $_many_many = array(
        'voyages' => array(
            'key_from' => 'id',
            'key_through_from' => 'client_id',
            'table_through' => 'participer',
            'key_through_to' => 'voyage_id',
            'model_to' => 'Model_Voyage',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false,
        )
    );


}
