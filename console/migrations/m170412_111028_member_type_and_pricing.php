<?php

use yii\db\Migration;
use yii\db\Schema;

class m170412_111028_member_type_and_pricing extends Migration
{
    public function up()
    {
        $this->createTable('membership_types', [
            'id'         => Schema::TYPE_PK,
            'name'       => Schema::TYPE_STRING,
            'amount'     => Schema::TYPE_STRING,
            'status'     => Schema::TYPE_BOOLEAN,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable("membership_types");
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
