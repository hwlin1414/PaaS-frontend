<?php

use yii\db\Migration;

/**
 * Handles the creation of table `Groups`.
 */
class m170422_190917_create_Groups_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Groups', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull()->unique(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('Groups');
    }
}
