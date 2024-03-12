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
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('gold_type',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(255)->notNull(),
            'value'=>$this->float()->notNull(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('gold_type');
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
