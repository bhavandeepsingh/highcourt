<?php

use yii\db\Migration;
use yii\db\Schema;
class m170425_101806_add_notification_table extends Migration
{
    public function up()
    {
        $this->createTable("notification", [
            'id'    =>Schema::TYPE_PK,
            'title'   => Schema::TYPE_STRING,
            'description'   => Schema::TYPE_TEXT,
            'sender_id'   => Schema::TYPE_INTEGER,
            'reciever_id'   => Schema::TYPE_INTEGER,
            'created_at'   => Schema::TYPE_INTEGER,
            'updated_at'   => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable('notification');
    }
}
