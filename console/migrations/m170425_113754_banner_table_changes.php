<?php

use yii\db\Migration;

class m170425_113754_banner_table_changes extends Migration
{
    public function up()
    {
        $this->dropColumn('banners', 'url');
    }

    public function down()
    {
        $this->addColumn("banners", "url", $this->string(255));
    }
}
