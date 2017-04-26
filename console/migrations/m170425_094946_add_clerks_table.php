<?php

use yii\db\Migration;
use yii\db\Schema;
class m170425_094946_add_clerks_table extends Migration
{
    public function up()
    {
        $this->createTable('clerks', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER,
            'name' => Schema::TYPE_STRING,
            'phone' => Schema::TYPE_STRING,
            'status' => Schema::TYPE_BOOLEAN,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable('clerks');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
