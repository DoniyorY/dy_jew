<?php

use yii\db\Migration;

/**
 * Class m240306_112907_income
 */
class m240306_112907_income extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('income',[
            'id'=>$this->primaryKey(),
            'token'=>$this->string(6),
            'created'=>$this->integer(),
            'user_id'=>$this->integer(),
            'status'=>$this->integer(),
            'total_amount'=>$this->integer(),
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
        echo "m240306_112907_income cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240306_112907_income cannot be reverted.\n";

        return false;
    }
    */
}
