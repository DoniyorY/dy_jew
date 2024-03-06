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
    public function safeUp()
    {
        $this->createTable('currency_rate', [
            'id' => $this->primaryKey(),
            'created' => $this->integer(),
            'updated' => $this->integer(),
            'amount' => $this->integer(),
            'status' => $this->smallInteger()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240306_112512_currency_rate cannot be reverted.\n";

        return false;
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
