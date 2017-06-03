<?php

use yii\db\Migration;

/**
 * Handles the creation of table `Jails`.
 * Has foreign keys to the tables:
 *
 * - `Users`
 * - `Users`
 */
class m170422_194303_create_Jails_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Jails', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'hostname' => $this->string(16)->notNull(),
            'ip' => $this->string(64)->notNull(),
            'quota' => $this->string(16)->notNull(),
            'enabled' => $this->boolean(),
            'enabledby' => $this->integer(),
            'description' => $this->string(255)->notNull(),
            'sshkey' => $this->string(1024)->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'enabled_at' => $this->timestamp()->defaultValue(null),
            'expired_at' => $this->timestamp()->defaultValue(null),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-Jails-user_id',
            'Jails',
            'user_id'
        );

        // add foreign key for table `Users`
        $this->addForeignKey(
            'fk-Jails-user_id',
            'Jails',
            'user_id',
            'Users',
            'id',
            'CASCADE'
        );

        // creates index for column `enabledby`
        $this->createIndex(
            'idx-Jails-enabledby',
            'Jails',
            'enabledby'
        );

        // add foreign key for table `Users`
        $this->addForeignKey(
            'fk-Jails-enabledby',
            'Jails',
            'enabledby',
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
            'fk-Jails-user_id',
            'Jails'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-Jails-user_id',
            'Jails'
        );

        // drops foreign key for table `Users`
        $this->dropForeignKey(
            'fk-Jails-enabledby',
            'Jails'
        );

        // drops index for column `enabledby`
        $this->dropIndex(
            'idx-Jails-enabledby',
            'Jails'
        );

        $this->dropTable('Jails');
    }
}
