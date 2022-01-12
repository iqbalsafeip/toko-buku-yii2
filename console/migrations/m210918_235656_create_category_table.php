<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m210918_235656_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique(),
            'desc' => $this->text(),
            'is_delete' => $this->integer(1),
            'is_active' => $this->integer(1),
            'created_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-category-created_by}}',
            '{{%category}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-category-created_by}}',
            '{{%category}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-category-updated_by}}',
            '{{%category}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-category-updated_by}}',
            '{{%category}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-category-created_by}}',
            '{{%category}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-category-created_by}}',
            '{{%category}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-category-updated_by}}',
            '{{%category}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-category-updated_by}}',
            '{{%category}}'
        );

        $this->dropTable('{{%category}}');
    }
}
