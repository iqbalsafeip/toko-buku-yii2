<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Buku;

/**
 * BukuSearch represents the model behind the search form of `common\models\Buku`.
 */
class BukuSearch extends Buku
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'kategori_id', 'penulis_id', 'penerbit_id', 'jml_hlm'], 'integer'],
            [['judul', 'desc', 'tgl_terbit', 'ISBN', 'bahasa', 'berat', 'harga', 'cover'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Buku::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'kategori_id' => $this->kategori_id,
            'penulis_id' => $this->penulis_id,
            'penerbit_id' => $this->penerbit_id,
            'jml_hlm' => $this->jml_hlm,
            'tgl_terbit' => $this->tgl_terbit,
        ]);

        $query->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'ISBN', $this->ISBN])
            ->andFilterWhere(['like', 'bahasa', $this->bahasa])
            ->andFilterWhere(['like', 'berat', $this->berat])
            ->andFilterWhere(['like', 'harga', $this->harga])
            ->andFilterWhere(['like', 'cover', $this->cover]);

        return $dataProvider;
    }
}
