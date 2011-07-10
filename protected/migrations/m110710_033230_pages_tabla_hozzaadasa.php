<?php
class m110710_033230_pages_tabla_hozzaadasa extends CDbMigration
{
	public function up()
	{
		$this->createTable(
			'pages',
			array(
				'id' 		=> 'pk',
				'title' 	=> 'varchar(125)',
				'body'		=> 'text',
				'revision' 	=> 'int',
				'created'	=> 'int'
			)
		);
	}

	public function down()
	{
		$this->dropTable( 'pages' );
	}
}
