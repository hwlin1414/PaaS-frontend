<?php

use yii\db\Migration;

/**
 * Handles the creation of table `GroupPerms`.
 * Has foreign keys to the tables:
 *
 * - `Groups`
 */
class m170422_190934_create_GroupPerms_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('GroupPerms', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->notNull(),
            'permission' => $this->string(64)->notNull(),
        ]);

        // creates index for column `group_id`
        $this->createIndex(
            'idx-GroupPerms-group_id',
            'GroupPerms',
            'group_id'
        );

        // add foreign key for table `Groups`
        $this->addForeignKey(
            'fk-GroupPerms-group_id',
            'GroupPerms',
            'group_id',
            'Groups',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `Groups`
        $this->dropForeignKey(
            'fk-GroupPerms-group_id',
            'GroupPerms'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-GroupPerms-group_id',
            'GroupPerms'
        );

        $this->dropTable('GroupPerms');
    }
}
