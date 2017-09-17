<?php

use app\models\user\UserRecord;
use yii\db\Migration;

class m170917_170940_create_roles_for_predefined_users extends Migration
{
    public function safeUp()
    {
        $rbac = Yii::$app->authManager;

        $guest = $rbac->createRole('guest');
        $guest->description = 'Гость';
        $rbac->add($guest);

        $user = $rbac->createRole('user');
        $user->description = 'Может использовать пользовательский интерфейс запроса и ничего больше';
        $rbac->add($user);

        $manager = $rbac->createRole('manager');
        $manager->description = 'Может управлять объектами в базе данных, но не для пользователей';
        $rbac->add($manager);

        $admin = $rbac->createRole('admin');
        $admin->description = 'Может делать что угодно, включая управление пользователями';
        $rbac->add($admin);

        $rbac->addChild($admin, $manager);
        $rbac->addChild($manager, $user);
        $rbac->addChild($user, $guest);

        $rbac->assign(
            $user,
            UserRecord::findOne(['username' => 'user'])->id
        );
        $rbac->assign(
            $manager,
            UserRecord::findOne(['username' => 'manager'])->id
        );
        $rbac->assign(
            $admin,
            UserRecord::findOne(['username' => 'admin'])->id
        );
    }

    public function safeDown()
    {
        $manager = Yii::$app->authManager;
        $manager->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170917_170940_create_roles_for_predefined_users cannot be reverted.\n";

        return false;
    }
    */
}
