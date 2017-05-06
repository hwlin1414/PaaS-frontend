<?php

use yii\db\Migration;

/**
 * Handles the creation of table `Users`.
 * Has foreign keys to the tables:
 *
 * - `Groups`
 */
class m170422_192551_create_Users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Users', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull()->unique(),
            'amount' => $this->integer()->notNull(),
            'group_id' => $this->integer()->notNull(),
            'enabled' => $this->boolean()->notNull(),
            'authkey' => $this->string(16)->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // creates index for column `group_id`
        $this->createIndex(
            'idx-Users-group_id',
            'Users',
            'group_id'
        );

        // add foreign key for table `Groups`
        $this->addForeignKey(
            'fk-Users-group_id',
            'Users',
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
            'fk-Users-group_id',
            'Users'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-Users-group_id',
            'Users'
        );

        $this->dropTable('Users');
    }
}
