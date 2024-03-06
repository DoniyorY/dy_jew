<?php

use yii\db\Migration;

/**
 * Class m240306_112043_client_phone
 */
class m240306_112043_client_phone extends Migration
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
        $this->createTable('client_phone',[
            'id'=>$this->primaryKey(),
            'client_id'=>$this->integer(),
            'phone'=>$this->string(13),
            'content'=>$this->string(255),
            'created'=>$this->integer()
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('client_phone');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240306_112043_client_phone cannot be reverted.\n";

        return false;
    }
    */
}
