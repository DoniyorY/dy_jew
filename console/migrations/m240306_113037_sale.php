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
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('sale',[
            'id'=>$this->primaryKey(),
            'created'=>$this->integer()->notNull(),
            'updated'=>$this->integer()->notNull(),
            'user_id'=>$this->integer()->notNull(),
            'client_id'=>$this->integer()->notNull(),
            'total_amount'=>$this->integer()->notNull(),
            'status'=>$this->integer()->notNull(),
            'token'=>$this->string(6)->notNull(),
            'is_deleted'=>$this->integer(),
            'deleted_user_id'=>$this->integer(),
            'deleted_time'=>$this->integer(),
            'content'=>$this->string(255),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sale');
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
