<?php

/**
 * Description of Message
 *
 * @author NDalaba
 */
use Orm\Model;

class Model_Message extends Model {

    protected static $_table_name = 'sendfacture';
    protected static $_properties = array('id', 'facture_id', 'admin_id', 'ajout','note');        
}
