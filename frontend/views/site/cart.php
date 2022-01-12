<?php

$js = <<<JS
    $(document).ready(function(){
        $.ajax({
            type: 'GET',
            url: 'https://dev.farizdotid.com/api/daerahindonesia/provinsi',
            success : function(data){
                console.log(data.provinsi);
                data.provinsi.map(result => {
                    $('#provinsi').append("<option value=" + result.id +" > " + result.nama + "</option>")
                })
            }
        })
        let data = (JSON.parse(localStorage.getItem('cart'))).map(d => d.id)
        console.log(data);
        $.ajax({
            type: 'POST',
            data: {data},
            success: function(res){
                $('#item-container').html(res.ajax)
                $('#harga').html(res.harga)
            }

        })

        $('.remove-btn').each(function(){
            $(this).click(function(){
                let id = $(this).attr('data-id');
                let dataCart = JSON.parse(localStorage.getItem('cart'));
                $('#cart-count').html(dataCart.length - 1)
                localStorage.setItem('cart', JSON.stringify(dataCart.filter(d => parseInt(d.id) != parseInt(id))))
                $('#buku-' + id).remove();
            })
        })

        $('#provinsi').on('change',function(){
            console.log(this.value);
            $.ajax({
            type: 'GET',
            url: 'https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=' + this.value,
            success : function(data){
                $('#kota').prop('disabled', true)
                $('#kota').html('<option value="">Pilih Kota</option>');
                data.kota_kabupaten.map(result => {
                    $('#kota').append("<option value=" + result.id +" > " + result.nama + "</option>")
                })
                $('#kota').prop('disabled', false)
            }
        })
        })


    })

JS;

$this->registerJS($js);

?>

<div class="container mt-5 mb-5">
<div class="row">
        <div class="col-xl-9 col-md-8">
            <!-- Item-->
            <div id="item-container" >
            </div>
            <!-- Item-->
            
        </div>
        <!-- Sidebar-->
        <div class="col-xl-3 col-md-4 pt-3 pt-md-0">
            <h2 class="h6 px-4 py-3 bg-secondary text-center">Subtotal</h2>
            <div class="h3 font-weight-semibold text-center py-3"  >Rp. <span id="harga" >0</span></div>
            <hr>
            <h3 class="h6 pt-4 font-weight-semibold"><span class="badge badge-success mr-2">Note</span>Additional comments</h3>
            <textarea class="form-control mb-3" id="order-comments" rows="5"></textarea>
            <div class="card">
            <div class="card-body">
                <form class="needs-validation" novalidate="">
                    <div class="form-group">
                        <select class="form-control custom-select" id="provinsi" required="">
                            <option value="">Pilih Kabupaten</option>
                        </select>
                        <div class="invalid-feedback">Please choose your country!</div>
                    </div>
                    <div class="form-group">
                        <select class="form-control custom-select" id="kota" required="">
                            <option value="">Pilih Kota</option>
                        </select>
                        <div class="invalid-feedback">Please choose your city!</div>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="ZIP / Postal code" required="">
                        <div class="invalid-feedback">Please provide a valid zip!</div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" required="">Detail Alamat</textarea>
                        <div class="invalid-feedback">Please provide a valid zip!</div>
                    </div>

                    <a class="btn btn-primary btn-block" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card mr-2">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                        <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg>Proceed to Checkout</a>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
<style type="text/css">
.cart-item-thumb {
    display: block;
    width: 10rem
}

.cart-item-thumb>img {
    display: block;
    width: 100%
}

.product-card-title>a {
    color: #222;
}

.font-weight-semibold {
    font-weight: 600 !important;
}

.product-card-title {
    display: block;
    margin-bottom: .75rem;
    padding-bottom: .875rem;
    border-bottom: 1px dashed #e2e2e2;
    font-size: 1rem;
    font-weight: normal;
}

.text-muted {
    color: #888 !important;
}

.bg-secondary {
    background-color: #f7f7f7 !important;
}

.accordion .accordion-heading {
    margin-bottom: 0;
    font-size: 1rem;
    font-weight: bold;
}
.font-weight-semibold {
    font-weight: 600 !important;
}
</style>