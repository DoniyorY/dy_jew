<?php

use yii\db\Migration;

/**
 * Class m240306_113031_products
 */
class m240306_113031_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('products',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(255),
            'gold_type_id'=>$this->integer(),
            'created'=>$this->integer(),
            'status'=>$this->integer(),
            'updated'=>$this->integer(),
            'is_deleted'=>$this->integer(),
            'deleted_time'=>$this->integer(),
            'deleted_user_id'=>$this->integer(),
            'code'=>$this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240306_113031_products cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240306_113031_products cannot be reverted.\n";

        return false;
    }
    */
}
