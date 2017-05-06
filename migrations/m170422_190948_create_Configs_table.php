<?php

use yii\db\Migration;

/**
 * Handles the creation of table `Configs`.
 */
class m170422_190948_create_Configs_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Configs', [
            'id' => $this->primaryKey(),
            'key' => $this->string(64)->notNull()->unique(),
            'value' => $this->string(256)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('Configs');
    }
}
