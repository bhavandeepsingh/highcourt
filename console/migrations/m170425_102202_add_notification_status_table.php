<?php

use yii\db\Migration;
use yii\db\mssql\Schema;

class m170425_102202_add_notification_status_table extends Migration
{
    public function up()
    {
        $this->createTable("notification_status", [
            'id'    => Schema::TYPE_PK,
            'notification_id'   => Schema::TYPE_INTEGER,
            'user_id'   => Schema::TYPE_INTEGER,
            'status'   => Schema::TYPE_BOOLEAN." default 0 not null",
            'created_at'    => Schema::TYPE_INTEGER,
            'updated_at'    => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable('notification_status');
    }
}
