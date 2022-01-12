<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card shadow mb-4 category-index">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            <p>
                                <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php Pjax::begin(); ?>
                                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'filterModel' => $searchModel,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],

                                        'id',
                                        'name',
                                        'desc:ntext',
                                        // 'is_delete',
                                        // 'is_active',
                                        //'created_at',
                                        //'created_by',
                                        //'updated_at',
                                        //'updated_by',

                                        ['class' => 'yii\grid\ActionColumn'],
                                    ],
                                ]); ?>

                                <?php Pjax::end(); ?>
                            </div>
                        </div>
                    </div>
