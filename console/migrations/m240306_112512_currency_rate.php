<?php

use yii\db\Migration;

/**
 * Class m240306_112512_currency_rate
 */
class m240306_112512_currency_rate extends Migration
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
        $this->createTable('currency_rate', [
            'id' => $this->primaryKey(),
            'created' => $this->integer(),
            'updated' => $this->integer(),
            'amount' => $this->integer(),
            'status' => $this->smallInteger()
        ],
        $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('currency_rate');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240306_112512_currency_rate cannot be reverted.\n";

        return false;
    }
    */
}
