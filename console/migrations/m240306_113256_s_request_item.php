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
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('s_request_item', [
            'id' => $this->primaryKey(),
            's_request_id' => $this->integer(),
            'product_id' => $this->integer(),
            'gold_type_id' => $this->integer(),
            'count' => $this->integer(),
            'status' => $this->integer(),
            'created' => $this->integer(),
            'content' => $this->string()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('s_request_item');
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
