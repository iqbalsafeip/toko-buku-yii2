<?php
    $js = <<<JS
        $(document).ready(function(){
            $('.remove-btn').each(function(){
                $(this).click(function(){
                    let id = $(this).attr('data-id');
                    let dataCart = JSON.parse(localStorage.getItem('cart'));
                    $('#cart-count').html(dataCart.length - 1)
                    dataCart = dataCart.filter(d => parseInt(d.id) != parseInt(id))
                    localStorage.setItem('cart', JSON.stringify(dataCart))
                    $(this).prop('disabled', true)
                    $.ajax({
                        type : 'POST',
                        data: {data : dataCart.map(d => d.id)},
                        success: function(res){
                            $('#item-container').html(res.ajax)
                            $('#harga').html(res.harga)
                        }
                    })  
                    $(this).prop('disabled', false)                  
                })
            })
        })

    JS;

    $this->registerJS($js);
?>
<?php foreach($buku as $buk) : ?>
<div class="d-sm-flex justify-content-between my-4 pb-4 border-bottom" id="buku-<?= $buk->id  ?>" >
    <div class="media d-block d-sm-flex text-center text-sm-left">
        <a class="cart-item-thumb mx-auto mr-sm-4" href="#"><img src="<?= '/tokobuku/common/uploads/cover/' . $buk->cover ?>" alt="Product"></a>
        <div class="media-body pt-3 ml-4">
            <h3 class="product-card-title font-weight-semibold border-0 pb-0"><a href="#"><?= $buk->judul ?></a></h3>
            <div class="font-size-sm"><span class="text-muted mr-2">Berat:</span><?= $buk->berat ?>kg</div>
            <div class="font-size-sm"><span class="text-muted mr-2">Jumlah Halaman:</span><?= $buk->jml_hlm ?></div>
            <div class="font-size-lg text-primary pt-2">Rp.<?= $buk->harga ?></div>
        </div>
    </div>
    <div class="pt-2 pt-sm-0 pl-sm-3 mx-auto mx-sm-0 text-center text-sm-left" style="max-width: 10rem;">
        <div class="form-group mb-2">
            <label for="quantity1">Quantity</label>
            <input class="form-control form-control-sm" type="number" id="quantity1" value="1">
        </div>
        <button class="btn btn-outline-danger btn-sm btn-block mb-2 remove-btn" type="button" data-id="<?= $buk->id ?>" >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 mr-1">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
            </svg>Remove</button>
    </div>
</div>
<?php endforeach ?>