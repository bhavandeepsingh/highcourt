<?php

use yii\db\Migration;
use yii\db\Schema;

class m170425_091954_judges_biography_to_text extends Migration
{
    public function up()
    {
        $this->alterColumn("judges", "bio_graphy", $this->text());
    }

    public function down()
    {
        $this->alterColumn("judges", "bio_graphy", $this->string(255));
    }
}
