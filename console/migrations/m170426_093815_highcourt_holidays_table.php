<?php

use yii\db\Migration;
use yii\db\Schema;
class m170426_093815_highcourt_holidays_table extends Migration
{
    public function up()
    {
        $this->createTable("highcourt_holidays", [
            'id'    =>Schema::TYPE_PK,
            'highcourt_id'   => Schema::TYPE_INTEGER,
            'holiday_id'   => Schema::TYPE_INTEGER,
            'status'   => Schema::TYPE_BOOLEAN." default 0 not null ",
            'created_at'   => Schema::TYPE_INTEGER,
            'updated_at'   => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable("highcourt_holidays");
    }
}
