<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `test`.
 */
class m170422_043712_create_test_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('test', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'dob' => Schema::TYPE_DATE,
            'int' => Schema::TYPE_INTEGER,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('test');
    }
}
