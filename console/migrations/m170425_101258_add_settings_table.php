<?php

use yii\db\Migration;
use yii\db\Schema;

class m170425_101258_add_settings_table extends Migration
{
    public function up()
    {
        $this->createTable("settings", [
            'id'    =>Schema::TYPE_PK,
            'name'   => Schema::TYPE_STRING,
            'value'   => Schema::TYPE_TEXT,
        ]);
    }

    public function down()
    {
        $this->dropTable("settings");
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
