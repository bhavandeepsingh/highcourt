<?php

use yii\db\Migration;

class m170506_091445_add_date_to_rosters extends Migration
{
    public function up()
    {
        $this->addColumn('roster', 'date', $this->date());
        $this->alterColumn('roster', 'description', $this->text());
    }

    public function down()
    {
        $this->dropColumn('roster', 'date');
    }
    
}
