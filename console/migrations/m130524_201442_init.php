<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'fullname' => $this->string()->notNull(),
            'username' => $this->string()->notNull()->unique(),
            'role_id' => $this->integer(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('{{%user}}', [
            'id' => 1,
            'fullname' => 'Admin Admin',
            'username' => 'admin',
            'role_id' => 0,
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'password_reset_token' => Yii::$app->security->generateRandomString(),
            'email' => 'admin@email.com',
            'status' => 10,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
