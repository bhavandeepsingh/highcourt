<?php

use yii\db\Migration;
use yii\db\Schema;

class m170424_105906_case_law extends Migration
{
    public function up()
    {
        $this->createTable("case_law", [
            'id'    =>Schema::TYPE_PK,
            'discription'   => Schema::TYPE_STRING,
            'title'   => Schema::TYPE_STRING,
            'created_at'    => Schema::TYPE_INTEGER,
            'updated_at'    => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable('case_law');
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
