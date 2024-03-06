<?php

use yii\db\Migration;

/**
 * Class m240306_113045_sale_item
 */
class m240306_113045_sale_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    $this->createTable('sale_item',[
        'sale_id'=>$this->integer(),
        'product_id'=>$this->integer(),
        'price'=>$this->integer(),
        'created'=>$this->integer(),
        'count'=>$this->integer(),
        'weight'=>$this->float(),
        'total_price'=>$this->integer(),
        'status'=>$this->integer(),
    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240306_113045_sale_item cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240306_113045_sale_item cannot be reverted.\n";

        return false;
    }
    */
}
