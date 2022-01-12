<?php

namespace common\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "buku".
 *
 * @property int $id
 * @property string|null $judul
 * @property int|null $kategori_id
 * @property int|null $penulis_id
 * @property int|null $penerbit_id
 * @property string|null $desc
 * @property int|null $jml_hlm
 * @property string|null $tgl_terbit
 * @property string|null $ISBN
 * @property string|null $bahasa
 * @property string|null $berat
 * @property string|null $harga
 * @property string|null $cover
 *
 * @property Category $kategori
 * @property Penerbit $penerbit
 * @property Penulis $penulis
 */
class Buku extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buku';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kategori_id', 'penulis_id', 'penerbit_id', 'jml_hlm'], 'integer'],
            [['desc'], 'string'],
            [['tgl_terbit'], 'safe'],
            [['judul', 'ISBN', 'bahasa', 'berat', 'harga', 'cover'], 'string', 'max' => 255],
            [['ISBN'], 'unique'],
            [['kategori_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['kategori_id' => 'id']],
            [['penerbit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Penerbit::className(), 'targetAttribute' => ['penerbit_id' => 'id']],
            [['penulis_id'], 'exist', 'skipOnError' => true, 'targetClass' => Penulis::className(), 'targetAttribute' => ['penulis_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'judul' => 'Judul',
            'kategori_id' => 'Kategori',
            'penulis_id' => 'Penulis',
            'penerbit_id' => 'Penerbit',
            'desc' => 'Deskripsi',
            'jml_hlm' => 'Jumlah Halaman',
            'tgl_terbit' => 'Tanggal Terbit',
            'ISBN' => 'ISBN',
            'bahasa' => 'Bahasa',
            'berat' => 'Berat',
            'harga' => 'Harga',
            'cover' => 'Cover',
        ];
    }
    
    // public function beforeSave($insert)
    // {
    //     parent::beforeSave($insert);

    //     if ($this->isNewRecord)
    //     {
    //         $this->created_by = Yii::$app->user->id;
    //         $this->created_at = new Expression('NOW()');
    //     }
    //     else
    //     {
    //         $this->updated_by = Yii::$app->user->id;
    //         $this->updated_at = new Expression('NOW()');
    //     }
    //     return true;
    // }


    /**
     * Gets query for [[Kategori]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKategori()
    {
        return $this->hasOne(Category::className(), ['id' => 'kategori_id']);
    }

    /**
     * Gets query for [[Penerbit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenerbit()
    {
        return $this->hasOne(Penerbit::className(), ['id' => 'penerbit_id']);
    }

    /**
     * Gets query for [[Penulis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenulis()
    {
        return $this->hasOne(Penulis::className(), ['id' => 'penulis_id']);
    }
}
