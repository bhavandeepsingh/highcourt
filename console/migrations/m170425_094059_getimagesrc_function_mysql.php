<?php

use yii\db\Migration;

class m170425_094059_getimagesrc_function_mysql extends Migration
{
    public function up()
    {
        $this->execute('DROP FUNCTION IF EXISTS getImageSrc;');
        $this->execute('CREATE DEFINER=`root`@`localhost` FUNCTION `getImageSrc`(`src` TEXT, `id` INT) RETURNS text CHARSET latin1
               NO SQL
            return Concat(src, concat(id, "/image.jpg"))');
    }

    public function down()
    {
        $this->execute('DROP FUNCTION IF EXISTS getImageSrc;');
    }
}
