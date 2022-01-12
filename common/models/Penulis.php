<?php

namespace common\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "penulis".
 *
 * @property int $id
 * @property string|null $nama
 * @property string|null $tglLahir
 * @property string|null $tmptLahir
 * @property string|null $alamat
 * @property string|null $photo
 * @property int|null $is_delete
 * @property int|null $is_active
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Penulis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penulis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tglLahir', 'created_at', 'updated_at'], 'safe'],
            [['tmptLahir', 'alamat'], 'string'],
            [['is_delete', 'is_active', 'created_by', 'updated_by'], 'integer'],
            [['nama', 'photo'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'tglLahir' => 'Tgl Lahir',
            'tmptLahir' => 'Tmpt Lahir',
            'alamat' => 'Alamat',
            'photo' => 'Photo',
            'is_delete' => 'Is Delete',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);

        if ($this->isNewRecord)
        {
            $this->created_by = Yii::$app->user->id;
            $this->created_at = new Expression('NOW()');
        }
        else
        {
            $this->updated_by = Yii::$app->user->id;
            $this->updated_at = new Expression('NOW()');
        }
        return true;
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

   

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
