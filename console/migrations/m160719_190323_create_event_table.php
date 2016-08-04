<?php

use yii\db\Migration;

/**
 * Handles the creation for table `event`.
 */
class m160719_190323_create_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        $this->createTable('event', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'date_event' => $this->date()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('event');
    }
}
