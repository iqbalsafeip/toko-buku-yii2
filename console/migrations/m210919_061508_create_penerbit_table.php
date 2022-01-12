<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%penerbit}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m210919_061508_create_penerbit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%penerbit}}', [
            'id' => $this->primaryKey(),
            'nama' => $this->string(),
            'desc' => $this->text(),
            'is_delete' => $this->integer(),
            'is_active' => $this->integer(),
            'created_by' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->dateTime(),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-penerbit-created_by}}',
            '{{%penerbit}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-penerbit-created_by}}',
            '{{%penerbit}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-penerbit-updated_by}}',
            '{{%penerbit}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-penerbit-updated_by}}',
            '{{%penerbit}}',
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
            '{{%fk-penerbit-created_by}}',
            '{{%penerbit}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-penerbit-created_by}}',
            '{{%penerbit}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-penerbit-updated_by}}',
            '{{%penerbit}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-penerbit-updated_by}}',
            '{{%penerbit}}'
        );

        $this->dropTable('{{%penerbit}}');
    }
}
