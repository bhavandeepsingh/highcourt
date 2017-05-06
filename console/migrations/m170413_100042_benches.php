<?php

use yii\db\Migration;
use yii\db\Schema;

class m170413_100042_benches extends Migration
{
    public function up()
    {
        $this->createTable('benches', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'type' => Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
         ]);
    }

    public function down()
    {       
        $this->dropTable("benches");        
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
