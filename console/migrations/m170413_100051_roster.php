<?php

use yii\db\Migration;
use yii\db\Schema;

class m170413_100051_roster extends Migration
{
    public function up()
    {
        $this->createTable('roster', [
            'id' => Schema::TYPE_BIGPK,
            'title' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_STRING,
            'bench_id' => Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {        
        $this->dropTable('roster');         
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
