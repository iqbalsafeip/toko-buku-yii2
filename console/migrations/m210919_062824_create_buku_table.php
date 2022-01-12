<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%buku}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%category}}`
 * - `{{%penulis}}`
 * - `{{%penerbit}}`
 */
class m210919_062824_create_buku_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%buku}}', [
            'id' => $this->primaryKey(),
            'judul' => $this->string(),
            'kategori_id' => $this->integer(),
            'penulis_id' => $this->integer(),
            'penerbit_id' => $this->integer(),
            'desc' => $this->text(),
            'jml_hlm' => $this->integer(),
            'tgl_terbit' => $this->dateTime(),
            'ISBN' => $this->string()->unique(),
            'bahasa' => $this->string(),
            'berat' => $this->string(),
            'harga' => $this->string(),
            'cover' => $this->string(),
        ]);

        // creates index for column `kategori_id`
        $this->createIndex(
            '{{%idx-buku-kategori_id}}',
            '{{%buku}}',
            'kategori_id'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            '{{%fk-buku-kategori_id}}',
            '{{%buku}}',
            'kategori_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );

        // creates index for column `penulis_id`
        $this->createIndex(
            '{{%idx-buku-penulis_id}}',
            '{{%buku}}',
            'penulis_id'
        );

        // add foreign key for table `{{%penulis}}`
        $this->addForeignKey(
            '{{%fk-buku-penulis_id}}',
            '{{%buku}}',
            'penulis_id',
            '{{%penulis}}',
            'id',
            'CASCADE'
        );

        // creates index for column `penerbit_id`
        $this->createIndex(
            '{{%idx-buku-penerbit_id}}',
            '{{%buku}}',
            'penerbit_id'
        );

        // add foreign key for table `{{%penerbit}}`
        $this->addForeignKey(
            '{{%fk-buku-penerbit_id}}',
            '{{%buku}}',
            'penerbit_id',
            '{{%penerbit}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%category}}`
        $this->dropForeignKey(
            '{{%fk-buku-kategori_id}}',
            '{{%buku}}'
        );

        // drops index for column `kategori_id`
        $this->dropIndex(
            '{{%idx-buku-kategori_id}}',
            '{{%buku}}'
        );

        // drops foreign key for table `{{%penulis}}`
        $this->dropForeignKey(
            '{{%fk-buku-penulis_id}}',
            '{{%buku}}'
        );

        // drops index for column `penulis_id`
        $this->dropIndex(
            '{{%idx-buku-penulis_id}}',
            '{{%buku}}'
        );

        // drops foreign key for table `{{%penerbit}}`
        $this->dropForeignKey(
            '{{%fk-buku-penerbit_id}}',
            '{{%buku}}'
        );

        // drops index for column `penerbit_id`
        $this->dropIndex(
            '{{%idx-buku-penerbit_id}}',
            '{{%buku}}'
        );

        $this->dropTable('{{%buku}}');
    }
}
