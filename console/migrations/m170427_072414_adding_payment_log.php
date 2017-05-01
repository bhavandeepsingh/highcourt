<?php

use yii\db\Migration;
use yii\db\Schema;
class m170427_072414_adding_payment_log extends Migration
{
    public function up()
    {
        $this->createTable("payment_log", [
            'id'            =>  Schema::TYPE_PK,
            'order_id'      =>  Schema::TYPE_INTEGER,
            'payment_type'  =>  Schema::TYPE_INTEGER,
            'payment_token' =>  Schema::TYPE_STRING,
            'status'        =>  Schema::TYPE_BOOLEAN,
            'response'      =>  Schema::TYPE_TEXT,
            'created_at'    =>  Schema::TYPE_INTEGER,
            'updated_at'    =>  Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable("payment_log");
    }
}