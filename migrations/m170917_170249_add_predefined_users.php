<?php

use yii\db\Migration;

class m170917_170249_add_predefined_users extends Migration
{
    public function safeUp()
    {
        foreach (
            [
                'user' => '1',
                'manager' => '1',
                'admin' => '1'
            ] as $username => $password
        ) {
            $user = new \app\models\user\UserRecord();
            $user->attributes = compact('username', 'password');
            $user->save();
        }
    }

    public function safeDown()
    {
        $this->delete('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170917_170249_add_predefined_users cannot be reverted.\n";

        return false;
    }
    */
}
