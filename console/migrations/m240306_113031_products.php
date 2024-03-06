<?php

use yii\db\Migration;

/**
 * Class m240306_113031_products
 */
class m240306_113031_products extends Migration
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

        $this->createTable('products',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(255),
            'gold_type_id'=>$this->integer(),
            'created'=>$this->integer(),
            'status'=>$this->integer(),
            'updated'=>$this->integer(),
            'is_deleted'=>$this->integer(),
            'deleted_time'=>$this->integer(),
            'deleted_user_id'=>$this->integer(),
            'code'=>$this->string(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('products');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240306_113031_products cannot be reverted.\n";

        return false;
    }
    */
}
