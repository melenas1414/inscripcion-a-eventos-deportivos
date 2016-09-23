<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'role' => $this->integer(1)->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);        
        $this->createTable('event_status', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()
        ], $tableOptions);
        $this->createTable('event', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'datet' => $this->date()->notNull(),
            'img' => $this->text(),
            'description' => $this->text(),
            'status_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
        ], $tableOptions);
        $this->createIndex(
            'event-status_id',
            'event',
            'status_id'
        );
        $this->addForeignKey(
            'fk-event-status_id',
            'event',
            'status_id',
            'event_status',
            'id',
            'CASCADE'
        );
        $this->createTable('event_category', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'price' => $this->float(7,2)->notNull()->defaultValue(0.0),
        ], $tableOptions);
        $this->createIndex(
            'event_category-event_id',
            'event_category',
            'event_id'
        );
        $this->addForeignKey(
            'fk-event_category-event_id',
            'event_category',
            'event_id',
            'event',
            'id',
            'CASCADE'
        );
        $this->createTable('event_option', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'option' => $this->text()
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
        $this->createTable('federado', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()
        ], $tableOptions);
        $this->createTable('inscrito', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'lastname' => $this->string(255)->notNull(),
            'category_id' => $this->integer()->notNull(),
            'sexo'=> $this->boolean()->notNull(),
            'born_date'=> $this->date()->notNull(),
            'type_identificacion'=> $this->integer()->notNull(),
            'id_identificacion' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'nacionalidad' => $this->integer()->notNull(),
            'phone' => $this->string(255),
            'cell-phone' => $this->string(255),
            'address' => $this->text()->notNull(),
            'city' => $this->string(255)->notNull(),
            'zipcode' => $this->integer(5)->notNull(),
            'country' => $this->integer()->notNull(),
            'provincia' => $this->integer()->notNull(),
            'federado_id'=> $this->integer()->notNull()
        ], $tableOptions);
        $this->createIndex(
            'inscrito-category_id',
            'inscrito',
            'category_id'
        );
        $this->addForeignKey(
            'fk-inscrito-category_id',
            'inscrito',
            'category_id',
            'event_category',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'inscrito-federado_id',
            'inscrito',
            'federado_id'
        );
        $this->addForeignKey(
            'fk-inscrito-federado_id',
            'inscrito',
            'federado_id',
            'federado',
            'id',
            'CASCADE'
        );

        $this->createTable('status_pago', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()
        ], $tableOptions);
        $this->createTable('pagos', [
            'id' => $this->primaryKey(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
            'status_id' => $this->integer()->notNull(),
            'transaction-id' => $this->integer(),
        ], $tableOptions);
        $this->createIndex(
            'pagos-status_id',
            'pagos',
            'status_id'
        );
        $this->addForeignKey(
            'fk-pagos-status_id',
            'pagos',
            'status_id',
            'status_pago',
            'id',
            'CASCADE'
        );
        $this->createTable('pago_item', [
            'id' => $this->primaryKey(),
            'pago_id' => $this->integer()->notNull(),
            'inscrito_id' => $this->integer()->notNull(),
            'description' => $this->text()
        ], $tableOptions);
        $this->createIndex(
            'pago_item-pago_id',
            'pago_item',
            'pago_id'
        );
        $this->addForeignKey(
            'fk-pago_item-pago_id',
            'pago_item',
            'pago_id',
            'pagos',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'pago_item-inscrito_id',
            'pago_item',
            'inscrito_id'
        );
        $this->addForeignKey(
            'fk-pago_item-inscrito_id',
            'pago_item',
            'inscrito_id',
            'inscrito',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('event_status');
        $this->dropForeignKey(
            'fk-event-status_id',
            'event'
        );
        $this->dropIndex(
            'event-status_id',
            'event'
        );
        $this->dropTable('event');
            $this->dropForeignKey(
            'fk-event_category-event_id',
            'event_category'
        );
        $this->dropIndex(
            'event_category-event_id',
            'event_category'
        );
        $this->dropTable('event_category');
        $this->dropForeignKey(
            'fk-event_option-event_id',
            'event_option'
        );
        $this->dropIndex(
            'event_option-event_id',
            'event_option'
        );
        $this->dropTable('event_option');
        $this->dropTable('federado');
        $this->dropForeignKey(
            'fk-inscrito-category_id',
            'inscrito'
        );
        $this->dropIndex(
            'inscrito-category_id',
            'inscrito'
        );
        $this->dropForeignKey(
            'fk-inscrito-federado_id',
            'inscrito'
        );
        $this->dropIndex(
            'inscrito-federado_id',
            'inscrito'
        );
        $this->dropTable('inscrito');
        $this->dropTable('status_pago');
        $this->dropForeignKey(
            'fk-pagos-status_id',
            'pagos'
        );
        $this->dropIndex(
            'pagos-status_id',
            'pagos'
        );
        $this->dropTable('pagos');
        $this->dropForeignKey(
            'fk-pago_item-pago_id',
            'pago_item'
        );
        $this->dropIndex(
            'pago_item-pago_id',
            'pago_item'
        );
        $this->dropForeignKey(
            'fk-pago_item-inscrito_id',
            'pago_item'
        );
        $this->dropIndex(
            'pago_item-inscrito_id',
            'pago_item'
        );
        $this->dropTable('pago_item');
    }
}
