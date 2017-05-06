<?php
use yii\db\Schema;
use yii\db\Migration;

class m170328_114307_banners extends Migration
{
    public function up()
    {
        $this->createTable('banners', [
            'id' => Schema::TYPE_PK,
            'url' => Schema::TYPE_STRING . ' NOT NULL',
            'index' => Schema::TYPE_INTEGER,
            'status' => Schema::TYPE_BOOLEAN,
        ]);
    }

    public function down()
    {
        $this->dropTable('banners');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
