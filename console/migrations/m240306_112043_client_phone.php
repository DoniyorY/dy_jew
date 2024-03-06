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
    public function safeUp()
    {
        $this->createTable('client_phone',[
            'id'=>$this->primaryKey(),
            'client_id'=>$this->integer(),
            'phone'=>$this->string(13),
            'content'=>$this->string(255),
            'created'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240306_112043_client_phone cannot be reverted.\n";

        return false;
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
