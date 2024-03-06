<?php

use yii\db\Migration;

/**
 * Class m240306_112827_gold_type
 */
class m240306_112827_gold_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('gold_type',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(255),
            'value'=>$this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240306_112827_gold_type cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240306_112827_gold_type cannot be reverted.\n";

        return false;
    }
    */
}
