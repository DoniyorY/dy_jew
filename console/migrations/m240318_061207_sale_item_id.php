<?php

use yii\db\Migration;

/**
 * Class m240318_061207_sale_item_id
 */
class m240318_061207_sale_item_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('sale_item','id',$this->primaryKey());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240318_061207_sale_item_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240318_061207_sale_item_id cannot be reverted.\n";

        return false;
    }
    */
}
