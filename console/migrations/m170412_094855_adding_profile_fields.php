<?php

use yii\db\Migration;

class m170412_094855_adding_profile_fields extends Migration
{
    private $table="profile";
    public function up()
    {
        $this->addColumn($this->table, 'designation', $this->integer(4)->defaultValue(0));
        $this->addColumn($this->table, 'profile', $this->string(50));
        $this->addColumn($this->table, 'enrollment_number', $this->string(50));
        $this->addColumn($this->table, 'membership_number', $this->string(50));
        $this->addColumn($this->table, 'landline', $this->string(15));
        $this->addColumn($this->table, 'mobile', $this->string(15));
        $this->addColumn($this->table, 'residential_address', $this->text());
        $this->addColumn($this->table, 'court_address', $this->text());
        $this->addColumn($this->table, 'blood_group', $this->string(10));
        $this->addColumn($this->table, 'lat1', $this->double(9,6));
        $this->addColumn($this->table, 'long1', $this->double(9,6));
        $this->addColumn($this->table, 'lat2', $this->double(9,6));
        $this->addColumn($this->table, 'long2', $this->double(9,6));
    }

    public function down()
    {
        $this->dropColumn($this->table, "designation");
        $this->dropColumn($this->table, "profile");
        $this->dropColumn($this->table, "enrollment_number");
        $this->dropColumn($this->table, "membership_number");
        $this->dropColumn($this->table, "landline");
        $this->dropColumn($this->table, "mobile");
        $this->dropColumn($this->table, "residential_address");
        $this->dropColumn($this->table, "court_address");
        $this->dropColumn($this->table, "blood_group");
        $this->dropColumn($this->table, "lat1");
        $this->dropColumn($this->table, "long1");
        $this->dropColumn($this->table, "lat2");
        $this->dropColumn($this->table, "long2");
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
