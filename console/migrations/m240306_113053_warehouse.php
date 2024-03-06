<?php

use yii\db\Migration;

/**
 * Class m240306_113053_warehouse
 */
class m240306_113053_warehouse extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('warehouse', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'gold_type_id' => $this->integer(),
            'updated' => $this->integer(),
            'user_id' => $this->integer(),
            'status' => $this->integer(),
            'count' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240306_113053_warehouse cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240306_113053_warehouse cannot be reverted.\n";

        return false;
    }
    */
}
