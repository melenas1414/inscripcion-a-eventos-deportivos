<?php

use yii\db\Migration;

/**
 * Handles the creation for table `event_user`.
 */
class m160719_190450_create_event_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
       $this->createTable('event_user', [
            'id' => $this->primaryKey(), 
            'user_id' => $this->integer()-> notNull(),
            'role_id' => $this->integer()-> notNull(),
            'event_id' => $this->integer()-> notNull(),      
        ], $tableOptions);
        $this->createIndex(
            'event_user-user_id',
            'event_user',
            'user_id'
        );
        $this->addForeignKey(
            'fk-event_user-user_id',
            'event_user',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'event_user-role_id',
            'event_user',
            'role_id'
        );
        $this->addForeignKey(
            'fk-event_user-role_id',
            'event_user',
            'role_id',
            'role',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'event_user-event_id',
            'event_user',
            'event_id'
        );
        $this->addForeignKey(
            'fk-event_user-event_id',
            'event_user',
            'event_id',
            'event',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-event_user-user_id',
            'event_user'
        );
        $this->dropForeignKey(
            'fk-event_user-role_id',
            'event_user'
        );
        $this->dropForeignKey(
            'fk-event_user-event_id',
            'event_user'
        );
        $this->dropIndex(
            'event_user-user_id',
            'event_user'
        );

        $this->dropIndex(
            'event_user-role_id',
            'event_user'
        );
        $this->dropIndex(
            'event_user-event_id',
            'event_user'
        );
        $this->dropTable('event_user');
    }
}
