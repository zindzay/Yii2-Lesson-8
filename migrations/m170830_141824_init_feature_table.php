<?php

use yii\db\Migration;

class m170830_141824_init_feature_table extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            'feature',
            [
                'id' => 'pk',
                'id_product' => 'int',
                'name' => 'string',
                'value' => 'string',
            ]
        );

        $this->addForeignKey('product_feature', 'feature',
            'id_product', 'product', 'id');
    }

    public function safeDown()
    {
        echo "m170830_141824_init_feature_table cannot be reverted.\n";

        $this->dropForeignKey('product_feature', 'feature');
        $this->dropTable('feature');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170830_141824_init_feature_table cannot be reverted.\n";

        return false;
    }
    */
}
