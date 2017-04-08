<?php
use yii\db\Schema;
use yii\db\Migration;

class m170329_074702_judges_executives extends Migration
{
    public function up()
    {
        $this->createTable('judges_executives', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'designation' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_TEXT,
            'type' => Schema::TYPE_SMALLINT,
            'createdOn' => Schema::TYPE_DATETIME,
            'status' => Schema::TYPE_BOOLEAN,
        ]);
    }

    public function down()
    {
        $this->dropTable('judges_executives');
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
