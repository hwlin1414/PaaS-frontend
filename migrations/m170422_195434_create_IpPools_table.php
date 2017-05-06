<?php

use yii\db\Migration;

/**
 * Handles the creation of table `IpPools`.
 */
class m170422_195434_create_IpPools_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('IpPools', [
            'id' => $this->primaryKey(),
            'ip' => $this->string(64)->notNull()->unique(),
            'host' => $this->string(64)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('IpPools');
    }
}
