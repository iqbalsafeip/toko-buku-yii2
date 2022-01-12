<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%penulis}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m210919_042643_create_penulis_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%penulis}}', [
            'id' => $this->primaryKey(),
            'nama' => $this->string(),
            'tglLahir' => $this->dateTime(),
            'tmptLahir' => $this->text(),
            'alamat' => $this->text(),
            'photo' => $this->string(),
            'is_delete' => $this->integer(),
            'is_active' => $this->integer(),
            'created_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-penulis-created_by}}',
            '{{%penulis}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-penulis-created_by}}',
            '{{%penulis}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-penulis-updated_by}}',
            '{{%penulis}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-penulis-updated_by}}',
            '{{%penulis}}',
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
            '{{%fk-penulis-created_by}}',
            '{{%penulis}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-penulis-created_by}}',
            '{{%penulis}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-penulis-updated_by}}',
            '{{%penulis}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-penulis-updated_by}}',
            '{{%penulis}}'
        );

        $this->dropTable('{{%penulis}}');
    }
}
