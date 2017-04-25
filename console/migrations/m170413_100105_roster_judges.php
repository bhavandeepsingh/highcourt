<?php

use yii\db\Migration;
use yii\db\Schema;

class m170413_100105_roster_judges extends Migration
{
    public function up()
    {
        $this->createTable('roster_judges', [
            'id' => Schema::TYPE_PK,
            'roster_id' => Schema::TYPE_INTEGER,
            'judge_id' => Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
       $this->dropTable('roster_judges');   
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
