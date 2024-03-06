<?php

use yii\db\Migration;

/**
 * Class m240306_113249_s_request
 */
class m240306_113249_s_request extends Migration
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

        $this->createTable('s_request',[
            'id'=>$this->primaryKey(),
            'client_id'=>$this->integer(),
            'created'=>$this->integer(),
            'status'=>$this->integer(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('s_request');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240306_113249_s_request cannot be reverted.\n";

        return false;
    }
    */
}
