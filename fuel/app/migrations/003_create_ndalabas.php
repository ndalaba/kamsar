<?php

namespace Fuel\Migrations;

class Create_ndalabas
{
	public function up()
	{
		\DBUtil::create_table('ndalabas', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'nom' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('ndalabas');
	}
}