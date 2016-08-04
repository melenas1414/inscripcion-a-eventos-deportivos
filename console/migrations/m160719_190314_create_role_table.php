<?php

use yii\db\Migration;

/**
 * Handles the creation for table `role`.
 */
class m160719_190314_create_role_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        $this->createTable('role', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255) ->notNull(),
            'description' => $this -> text(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('role');
    }
}
