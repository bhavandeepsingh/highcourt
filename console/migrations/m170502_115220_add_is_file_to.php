<?php

use yii\db\Migration;
use yii\db\Schema;
class m170502_115220_add_is_file_to extends Migration
{
    public function up()
    {
        $this->addColumn('notification', 'is_file', $this->boolean()." default 0");
    }

    public function down()
    {
        $this->dropColumn('notification', 'is_file');
    }
}
