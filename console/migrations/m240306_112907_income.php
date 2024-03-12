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
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('income',[
            'id'=>$this->primaryKey(),
            'token'=>$this->string(6)->notNull(),
            'created'=>$this->integer()->notNull(),
            'user_id'=>$this->integer()->notNull(),
            'status'=>$this->integer()->notNull(),
            'total_amount'=>$this->integer()->notNull(),
            'is_deleted'=>$this->integer(),
            'deleted_time'=>$this->integer(),
            'deleted_user_id'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('income');
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
