<?php

use yii\db\Migration;

/**
 * Handles the creation of table `Comments`.
 * Has foreign keys to the tables:
 *
 * - `Users`
 * - `Users`
 */
class m170423_040107_create_Comments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Comments', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'comment' => $this->string(1024)->notNull(),
            'creator' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-Comments-user_id',
            'Comments',
            'user_id'
        );

        // add foreign key for table `Users`
        $this->addForeignKey(
            'fk-Comments-user_id',
            'Comments',
            'user_id',
            'Users',
            'id',
            'CASCADE'
        );

        // creates index for column `creator`
        $this->createIndex(
            'idx-Comments-creator',
            'Comments',
            'creator'
        );

        // add foreign key for table `Users`
        $this->addForeignKey(
            'fk-Comments-creator',
            'Comments',
            'creator',
            'Users',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `Users`
        $this->dropForeignKey(
            'fk-Comments-user_id',
            'Comments'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-Comments-user_id',
            'Comments'
        );

        // drops foreign key for table `Users`
        $this->dropForeignKey(
            'fk-Comments-creator',
            'Comments'
        );

        // drops index for column `creator`
        $this->dropIndex(
            'idx-Comments-creator',
            'Comments'
        );

        $this->dropTable('Comments');
    }
}
