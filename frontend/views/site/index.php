<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'My Yii Application';
echo $this->render('../layouts/header');

$js = <<<JS
    $(document).ready(function(){
        let dataCart = JSON.parse(localStorage.getItem('cart')) || [];
        $('#cart-count').html(dataCart.length)
        $('.cart-btn').each(function(){
            let id = $(this).attr('data-id');
            if(dataCart.find(buku => parseInt(buku.id) === parseInt(id))){
                $(this).addClass('active');
            }
            $(this).click(function(){
                dataCart = JSON.parse(localStorage.getItem('cart')) || [];
                let data = {id: id, count: 1};
                if(dataCart?.find(buku => parseInt(buku.id) === parseInt(id))){
                    return false;
                } else {
                    localStorage.setItem('cart', JSON.stringify([...dataCart, data]));
                    $('#cart-count').html(dataCart.length + 1)
                    $(this).addClass('active');
                }
            })
        })
    })
JS;

$this->registerJS($js);
?>
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach($buku as $buk) : ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="<?= '/tokobuku/common/uploads/cover/' . $buk->cover ?>" alt="<?= $buk->judul ?>" />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?= $buk->judul ?></h5>
                                <a href="#" style="display: block;"><?= $buk->getPenulis()->one()->nama ?></a>
                                <!-- Product price-->
                                Rp.<?= $buk->harga ?>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center row d-flex flex-row justify-content-between">
                                <a class="btn btn-outline-dark mt-auto col-8" href="<?= Url::toRoute(['site/details', 'id' => $buk->id]) ?>">Lihat Detail</a>
                                <button class="btn btn-outline-secondary col-3 cart-btn" data-id="<?= $buk->id ?>" ><i class="bi-cart-fill me-1"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            
        <?= LinkPager::widget([
                'pagination' => $pages,
            ]);
        ?>
        </div>
    </div>
</section>
