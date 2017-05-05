<?php

use yii\db\Migration;

class m170503_073428_adding_weight_to_profile extends Migration
{
    public function up()
    {
        $this->addColumn('profile', 'weight', $this->integer()." default 0");
    }

    public function down()
    {
        $this->dropColumn('profile', 'weight');
    }
    
}
