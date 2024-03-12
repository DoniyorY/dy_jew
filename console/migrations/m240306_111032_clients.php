<?php

use yii\db\Migration;

/**
 * Class m240306_111032_clients
 */
class m240306_111032_clients extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('client',[
            'id'=>$this->primaryKey(),
            'fullname'=>$this->string(255)->notNull(),
            'address'=>$this->string(255)->notNull(),
            'phone'=>$this->string(13)->notNull(),
            'balance'=>$this->integer()->notNull(),
            'created'=>$this->integer()->notNull(),
            'updated'=>$this->integer()->notNull(),
            'status'=>$this->integer()->notNull(),
            'client_type_id'=>$this->integer()->notNull(),
            'token'=>$this->string(6)->notNull(),
            'is_deleted'=>$this->integer(),
            'deleted_time'=>$this->integer(),
            'deleted_user_id'=>$this->integer(),
        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable('client');
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
