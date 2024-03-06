<?php

use yii\db\Migration;

/**
 * Class m240306_112937_income_item
 */
class m240306_112937_income_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('income_item',[
            'id'=>$this->primaryKey(),
            'product_id'=>$this->integer(),
            'count'=>$this->integer(),
            'unit_amount'=>$this->integer(),
            'income_id'=>$this->integer(),
            'is_deleted'=>$this->integer(),
            'deleted_time'=>$this->integer(),
            'deleted_user_id'=>$this->integer(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240306_112937_income_item cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240306_112937_income_item cannot be reverted.\n";

        return false;
    }
    */
}
