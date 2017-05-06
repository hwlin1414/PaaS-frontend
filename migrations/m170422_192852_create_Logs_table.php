<?php

use yii\db\Migration;

/**
 * Handles the creation of table `Logs`.
 * Has foreign keys to the tables:
 *
 * - `Users`
 */
class m170422_192852_create_Logs_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Logs', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'ip' => $this->string(64)->notNull(),
            'level' => $this->string(15)->notNull(),
            'action' => $this->string(63)->notNull(),
            'description' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-Logs-user_id',
            'Logs',
            'user_id'
        );

        // add foreign key for table `Users`
        $this->addForeignKey(
            'fk-Logs-user_id',
            'Logs',
            'user_id',
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
            'fk-Logs-user_id',
            'Logs'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-Logs-user_id',
            'Logs'
        );

        $this->dropTable('Logs');
    }
}
