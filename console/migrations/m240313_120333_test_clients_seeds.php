<?php

use yii\db\Migration;

/**
 * Class m240313_120333_test_clients_seeds
 */
class m240313_120333_test_clients_seeds extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $faker = \Faker\Factory::create('ru_RU');

        for ($i = 1; $i <= 50; $i++) {
            $this->insert('client', [
                //'id' => $i + 1,
                'fullname' => $faker->name,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'balance' => 0,
                'created' => time() + $i,
                'updated' => time() + $i,
                'status' => 0,
                'client_type_id' => 0,
                'token' => Yii::$app->security->generateRandomString(6),
                'is_deleted' => 0,
                'deleted_time' => 0,
                'deleted_user_id' => 0,
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $model = \common\models\Clients::find()->orderBy(['id' => 3])->limit(50)->all();
        foreach ($model as $item) {
            $item->delete();
        }
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240313_120333_test_clients_seeds cannot be reverted.\n";

        return false;
    }
    */
}
