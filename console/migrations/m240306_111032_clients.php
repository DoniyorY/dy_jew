<?php

use yii\db\Migration;

/**
 * Class m240306_111032_clients
 */
class m240306_111032_clients extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('client',[
            'id'=>$this->primaryKey(),
            'fullname'=>$this->string(255),
            'address'=>$this->string(255),
            'phone'=>$this->string(13),
            'balance'=>$this->integer(),
            'created'=>$this->integer(),
            'updated'=>$this->integer(),
            'status'=>$this->integer(),
            'client_type_id'=>$this->integer(),
            'token'=>$this->string(6),
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
        echo "m240306_111032_clients cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240306_111032_clients cannot be reverted.\n";

        return false;
    }
    */
}
