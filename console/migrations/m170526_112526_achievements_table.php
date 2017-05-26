<?php

use yii\db\Migration;
use yii\db\Schema;

class m170526_112526_achievements_table extends Migration
{
    public function safeUp()
    {
        $this->createTable("achievements", [
            'id'                =>  Schema::TYPE_PK,
            'title'             =>  Schema::TYPE_TEXT,
            'description'       =>  Schema::TYPE_TEXT,
            'destination'       =>  Schema::TYPE_TEXT,
            'achievement_year'  =>  Schema::TYPE_INTEGER,
            'created_at'        =>  Schema::TYPE_INTEGER,
            'updated_at'        =>  Schema::TYPE_INTEGER,
        ]);
    }

    public function safeDown()
    {
        $this->dropTable("achievements");
    }
}
