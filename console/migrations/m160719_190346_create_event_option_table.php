<?php

use yii\db\Migration;

/**
 * Handles the creation for table `event_option`.
 */
class m160719_190346_create_event_option_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        $this->createTable('event_option', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'price' => $this->float(7,2)->notNull()->defaultValue(0.0),
        ], $tableOptions);
        $this->createIndex(
            'event_option-event_id',
            'event_option',
            'event_id'
        );
        $this->addForeignKey(
            'fk-event_option-event_id',
            'event_option',
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
            'fk-event_option-event_id',
            'event_option'
        );
        $this->dropIndex(
            'event_option-event_id',
            'event_option'
        );
        $this->dropTable('event_option');
    }
}
