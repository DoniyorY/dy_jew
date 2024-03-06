<?php

use yii\db\Migration;

/**
 * Class m240306_113037_sale
 */
class m240306_113037_sale extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sale',[
            'id'=>$this->primaryKey(),
            'created'=>$this->integer(),
            'updated'=>$this->integer(),
            'user_id'=>$this->integer(),
            'client_id'=>$this->integer(),
            'total_amount'=>$this->integer(),
            'status'=>$this->integer(),
            'token'=>$this->string(6),
            'is_deleted'=>$this->integer(),
            'deleted_user_id'=>$this->integer(),
            'deleted_time'=>$this->integer(),
            'content'=>$this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240306_113037_sale cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240306_113037_sale cannot be reverted.\n";

        return false;
    }
    */
}
