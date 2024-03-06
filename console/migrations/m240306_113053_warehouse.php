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
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('warehouse', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'gold_type_id' => $this->integer(),
            'updated' => $this->integer(),
            'user_id' => $this->integer(),
            'status' => $this->integer(),
            'count' => $this->integer(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
     $this->dropTable('warehouse');
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
