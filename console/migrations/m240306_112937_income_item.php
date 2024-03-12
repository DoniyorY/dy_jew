<?php

use yii\db\Migration;

/**
 * Class m240306_112937_income_item
 */
class m240306_112937_income_item extends Migration
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

        $this->createTable('income_item',[
            'id'=>$this->primaryKey(),
            'product_id'=>$this->integer()->notNull(),
            'count'=>$this->integer()->notNull(),
            'unit_amount'=>$this->integer()->notNull(),
            'income_id'=>$this->integer()->notNull(),
            'is_deleted'=>$this->integer(),
            'deleted_time'=>$this->integer(),
            'deleted_user_id'=>$this->integer(),

        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('income_item');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240306_112937_income_item cannot be reverted.\n";

        return false;
    }
    */
}
