<?php

use common\models\Category;
use common\models\Penerbit;
use common\models\Penulis;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Buku */
/* @var $form yii\widgets\ActiveForm */
$kategoriArr = Category::find()->all();
$kategori = ArrayHelper::map($kategoriArr, 'id', 'name');

$penulisArr = Penulis::find()->all();
$penulis = ArrayHelper::map($penulisArr, 'id', 'nama');

$penerbitArr = Penerbit::find()->all();
$penerbit = ArrayHelper::map($penerbitArr, 'id', 'nama');
?>

<div class="buku-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'judul')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kategori_id')->dropDownList($kategori, ['prompt' => '--Pilih Kategori--']) ?>

    <?= $form->field($model, 'penulis_id')->dropDownList($penulis, ['prompt' => '--Pilih Penulis--']) ?>

    <?= $form->field($model, 'penerbit_id')->dropDownList($penerbit, ['prompt' => '--Pilih Penerbit--']) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'jml_hlm')->textInput(['type'=> 'number']) ?>

    <?= $form->field($model, 'tgl_terbit')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'ISBN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bahasa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'berat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'harga')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cover')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
