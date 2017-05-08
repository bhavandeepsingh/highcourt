<?php

use yii\db\Migration;

class m170506_091330_add_gender_to_judges extends Migration
{
    public function up()
    {
        $this->addColumn('judges', 'gender', $this->integer()." default 1");
    }

    public function down()
    {
        $this->dropColumn('judges', 'gender');
    }
}
