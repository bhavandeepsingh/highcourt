<?php

use yii\db\Migration;
use yii\db\Schema;

class m170413_100028_members extends Migration
{
    public function up()
    {
        $this->createTable('members', [
            'id' => Schema::TYPE_BIGPK,
            'name' => Schema::TYPE_STRING,
            'enrollment_no' => Schema::TYPE_STRING,
            'membership_no' => Schema::TYPE_STRING,
            'email_id' => Schema::TYPE_STRING,
            'landline_no' => Schema::TYPE_STRING,
            'mobile_no' => Schema::TYPE_STRING,
            'residential_address' => Schema::TYPE_STRING,
            'court_address' => Schema::TYPE_STRING,
            'blood_group' => Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable("members");            
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
