<?php

use yii\db\Migration;

class m170422_205030_init_data extends Migration
{
    public function up()
    {
        $this->insert('Configs', [
            'key' => 'defaultUserGroup',
            'value' => '1',
        ]);
        $this->insert('Groups', [
                'name' => '管理員',
        ]);
        $this->insert('Groups', [
                'name' => '使用者',
        ]);
        $this->insert('GroupPerms', [
                'group_id' => '1',
                'permission' => '*'
        ]);
        $this->insert('Logs', [
            'ip' => '0.0.0.0',
            'level' => 'info',
            'user_id' => null,
            'action' => 'app',
            'description' => '系統初始化',
        ]);
    }

    public function down()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        $this->truncateTable('Configs');
        $this->truncateTable('Groups');
        $this->truncateTable('GroupPerms');
        $this->truncateTable('IpPools');
        $this->truncateTable('Jails');
        $this->truncateTable('Logs');
        $this->truncateTable('Users');
        $this->execute('SET FOREIGN_KEY_CHECKS = 1;');
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
