<?php

use common\models\Category;
use common\models\Penerbit;
use common\models\Penulis;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BukuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bukus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card shadow mb-4 category-index">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= $this->title ?></h6>
        <p>
            <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'judul',
                    [
                        'attribute' => 'Kategori',
                        'value' => function($data){
                            return Category::findOne($data->kategori_id)->name;
                        }
                    ],
                    [
                        'attribute' => 'Penerbit',
                        'value' => function($data){
                            return Penerbit::findOne($data->penerbit_id)->nama;
                        }
                    ],
                    [
                        'attribute' => 'Penulis',
                        'value' => function($data){
                            return Penulis::findOne($data->penulis_id)->nama;
                        }
                    ],
                    // 'desc:ntext',
                    'jml_hlm',
                    'tgl_terbit',
                    'ISBN',
                    'bahasa',
                    'berat',
                    'harga',
                    'cover',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>

