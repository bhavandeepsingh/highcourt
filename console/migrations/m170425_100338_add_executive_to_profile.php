<?php

use yii\db\Migration;
use yii\db\Schema;
class m170425_100338_add_executive_to_profile extends Migration
{
    public function up()
    {
        $this->addColumn('profile', 'executive', $this->boolean()." default 0 not null");
    }

    public function down()
    {
        $this->dropColumn('profile', 'executive');
    }
}
