<?php

use yii\db\Migration;
use yii\db\Schema;

class m170413_120609_blood_groups extends Migration
{
    public function up()
    {
        $this->createTable('blood_groups', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ]);
        
        $this->insert('blood_groups', ['name' => 'A+', 'created_at' => 0, 'updated_at' => 0]);
        $this->insert('blood_groups', ['name' => 'A-', 'created_at' => 0, 'updated_at' => 0]);
        $this->insert('blood_groups', ['name' => 'B+', 'created_at' => 0, 'updated_at' => 0]);
        $this->insert('blood_groups', ['name' => 'B-', 'created_at' => 0, 'updated_at' => 0]);
        $this->insert('blood_groups', ['name' => 'AB+', 'created_at' => 0, 'updated_at' => 0]);
        $this->insert('blood_groups', ['name' => 'AB-', 'created_at' => 0, 'updated_at' => 0]);
        $this->insert('blood_groups', ['name' => 'O+', 'created_at' => 0, 'updated_at' => 0]);
        $this->insert('blood_groups', ['name' => 'O-', 'created_at' => 0, 'updated_at' => 0]);
        
    }

    public function down()
    {
       $this->dropTable('blood_groups');      
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
