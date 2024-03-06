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
    public function safeUp()
    {
        $this->createTable('s_request',[
            'id'=>$this->primaryKey(),
            'client_id'=>$this->integer(),
            'created'=>$this->integer(),
            'status'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240306_113249_s_request cannot be reverted.\n";

        return false;
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
