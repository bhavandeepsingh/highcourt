<?php

use yii\db\Migration;
use yii\db\Schema;
class m170426_074646_highcourts_table extends Migration
{
    public function up()
    {
        $this->createTable("highcourts", [
            'id'    =>Schema::TYPE_PK,
            'name'   => Schema::TYPE_STRING,
        ]);
        $this->execute("insert into highcourts (`id`, `name`) VALUES (NULL, 'Chandigarh Highcourt'),(NULL, 'Haryana Highcourt');");
    }

    public function down()
    {
        $this->dropTable("highcourts");
    }
}
