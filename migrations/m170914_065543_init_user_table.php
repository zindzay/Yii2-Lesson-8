<?php

use yii\db\Migration;

class m170914_065543_init_user_table extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            'user',
            [
                'id' => 'pk',
                'username' => 'string UNIQUE',
                'password' => 'string',
                'auth_key' => 'string UNIQUE',
            ]
        );
    }

    public function safeDown()
    {
        echo "m170914_065543_init_user_table cannot be reverted.\n";

        $this->dropTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170914_065543_init_user_table cannot be reverted.\n";

        return false;
    }
    */
}
