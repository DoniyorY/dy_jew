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
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
    $this->createTable('sale_item',[
        'sale_id'=>$this->integer(),
        'product_id'=>$this->integer(),
        'price'=>$this->integer(),
        'created'=>$this->integer(),
        'count'=>$this->integer(),
        'weight'=>$this->float(),
        'total_price'=>$this->integer(),
        'status'=>$this->integer(),
    ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('sale_item');
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
