<?php

use yii\db\Migration;

/**
 * Class m240313_081040_payment_add_gld_input
 */
class m240313_081040_payment_add_gld_input extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('payment','gld_weight',$this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240313_081040_payment_add_gld_input cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240313_081040_payment_add_gld_input cannot be reverted.\n";

        return false;
    }
    */
}
