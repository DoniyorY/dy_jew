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
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('payment',[
            'id'=>$this->primaryKey(),
            'created'=>$this->integer()->notNull(),
            'amount'=>$this->integer()->notNull(),
            'amount_type'=>$this->integer()->notNull(),
            'rate_amount'=>$this->integer()->notNull(),
            'rate_date'=>$this->integer()->notNull(),
            'method_id'=>$this->integer()->notNull(),
            'payment_type'=>$this->integer()->notNull(),
            'client_id'=>$this->integer()->notNull(),
            'content'=>$this->string(255)->notNull(),
            'token'=>$this->string(6)->notNull(),
            'is_deleted'=>$this->integer(),
            'deleted_time'=>$this->integer(),
            'deleted_user_id'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
      $this->dropTable('payment');
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
