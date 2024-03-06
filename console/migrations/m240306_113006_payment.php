<?php

use yii\db\Migration;

/**
 * Class m240306_113006_payment
 */
class m240306_113006_payment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('payment',[
            'id'=>$this->primaryKey(),
            'created'=>$this->integer(),
            'amount'=>$this->integer(),
            'amount_type'=>$this->integer(),
            'rate_amount'=>$this->integer(),
            'rate_date'=>$this->integer(),
            'method_id'=>$this->integer(),
            'payment_type'=>$this->integer(),
            'client_id'=>$this->integer(),
            'content'=>$this->string(255),
            'token'=>$this->string(6),
            'is_deleted'=>$this->integer(),
            'deleted_time'=>$this->integer(),
            'deleted_user_id'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240306_113006_payment cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240306_113006_payment cannot be reverted.\n";

        return false;
    }
    */
}
