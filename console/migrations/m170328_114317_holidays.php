<?php
use yii\db\Schema;
use yii\db\Migration;

class m170328_114317_holidays extends Migration
{
    public function up()
    {
        $this->createTable('holidays', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'date' => Schema::TYPE_DATE,
            'status' => Schema::TYPE_BOOLEAN,
        ]);
    }

    public function down()
    {
        $this->dropTable('holidays');
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
