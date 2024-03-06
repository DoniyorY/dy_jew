<?php

use yii\db\Migration;

/**
 * Class m240306_113256_s_request_item
 */
class m240306_113256_s_request_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('s_request_item', [
            'id' => $this->primaryKey(),
            's_request_id' => $this->integer(),
            'product_id' => $this->integer(),
            'gold_type_id' => $this->integer(),
            'count' => $this->integer(),
            'status' => $this->integer(),
            'created' => $this->integer(),
            'content' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240306_113256_s_request_item cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240306_113256_s_request_item cannot be reverted.\n";

        return false;
    }
    */
}
