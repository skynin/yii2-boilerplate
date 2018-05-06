<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

		$nameTable = $this->db->quoteTableName('{{%user}}');

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->tinyInteger()->notNull()->unsigned()->defaultValue(10),
			 'ext_info' => $this->json()
        ], $tableOptions);

		$password_hash = Yii::$app->security->generateRandomString();
		$auth_key = Yii::$app->security->generateRandomString();

$addTimeStampColumn = <<<SQL
	alter table $nameTable
	add column created_at timestamp default current_timestamp,
	add column updated_at timestamp default current_timestamp on update current_timestamp;

	insert into $nameTable set id = 1, username = '_system_', auth_key='$auth_key', password_hash='$password_hash', email='_@_._';

	alter table $nameTable auto_increment = 10;
SQL;

	$this->execute($addTimeStampColumn);
	}

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
