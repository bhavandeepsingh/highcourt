<?php

use yii\db\Migration;
use yii\db\Schema;

class m170413_100018_judges extends Migration
{
    public function up()
    {
         $this->createTable('judges', [
            'id'         => Schema::TYPE_PK,
            'name'       => Schema::TYPE_STRING,
            'address'    => Schema::TYPE_STRING,
            'dob'        => Schema::TYPE_DATE,
            'ext_no' =>  Schema::TYPE_STRING,
            'court_room' => Schema::TYPE_INTEGER,
            'date_of_appointment' => Schema::TYPE_DATE,
            'date_of_retirement' => Schema::TYPE_DATE,
            'bio_graphy' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {        
        $this->dropTable("judges");       
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
