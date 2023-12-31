<footer id="footer"><!--Footer-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="companyinfo">
                        <h2><span>e</span>-shopper</h2>
                        <p>Cung cấp Hi-End PC, Laptop và Gaming Gear Chuyên Nghiệp</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Về E-Shopper</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Giới thiệu</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Chính sách</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Chính sách bảo hành</a></li>
                            <li><a href="#">Chính sách thanh toán</a></li>
                            <li><a href="#">Chính sách giao hàng</a></li>
                            <li><a href="#">Chính sách bảo mật</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Thông tin</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Trung tâm bảo hàng</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Đơn vị vận chuyển</h2>
                        <ul class="nav nav-pills nav-stacked ul_flex">
                            <li>
                                <img src="{{ asset('frontend/images/home/ship_1.webp')}}" class="img_footer" alt="">
                            </li>
                            <li>
                                <img src="{{ asset('frontend/images/home/ship_2.webp')}}" class="img_footer" alt="">
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="col-sm-3 col-sm-offset-1">
                    <div class="single-widget">
                        <h2>Góp ý</h2>
                        <form action="#" class="searchform">
                            <input type="text" placeholder="Gửi mail" />
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                            <p>Mọi góp ý của bạn sẽ chúng tôi hoàn thiện và mang đến trải nghiệm tốt hơn.</p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2013 E-SHOPPER by Bùi Hùng</p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->

{{-- Facebook plugin --}}
{{-- <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0&appId=1658479191330492" nonce="7kG192Pz"></script> --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="{{ asset('frontend/js/jquery.js')}}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{ asset('frontend/js/price-range.js')}}"></script>
<script src="{{ asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{ asset('frontend/js/main.js')}}"></script>

{{-- sweetalert 1 --}}
<script src="{{ asset('frontend/js/sweetalert.js')}}"></script>
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

<script>
    // hiden notification after 2s
    $(document).ready(function() {
        setTimeout(function() {
            $('#notification').fadeOut('fast');
        }, 2000); // 2 giây
    });
</script>

{{-- Bill --}}
<script>
    $(document).ready(function(){
        $('.send_order').click(function(e){
            // e.preventDefault();
            swal({
                title: "Xác nhận đơn hàng",
                text: "Bạn có chắc chắn xác nhận đặt hàng?",
                showCancelButton: true,
                cancelButtonText: "Hủy",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Xác nhận",
                closeOnConfirm: false,
                },
                function(){
                    var shipping_email = $('.shipping_email').val();
                    var shipping_name = $('.shipping_name').val();
                    var shipping_address = $('.shipping_address').val();
                    var shipping_phone = $('.shipping_phone').val();
                    var shipping_notes = $('.shipping_notes').val();
                    var order_feeship = $('.order_feeship').val();
                    var order_coupon = $('.order_coupon').val();
                    var payment_select = $('.payment_select').val();
                    var _token = $('input[name = "_token"]').val();

                    $.ajax({
                        url: "{{ route('home.confirmOrder') }}",
                        method: "POST",
                        data:{
                            shipping_email: shipping_email,
                            shipping_name: shipping_name,
                            shipping_address: shipping_address,
                            shipping_phone: shipping_phone,
                            shipping_notes: shipping_notes,
                            payment_select: payment_select,
                            order_feeship: order_feeship,
                            order_coupon: order_coupon,
                            _token: _token
                        },
                        success: function(){
                            swal("Thành công!", "Đơn hàng của bạn đã được gửi thành công.", "success");
                        }
                    });

                    window.setTimeout(function(){
                        location.reload();
                    }, 2000);
            });


        });
    })
</script>

{{-- Cart by Ajax --}}
<script>
    $(document).ready(function(){
        $('.add-to-cart').click(function(e){
            e.preventDefault();

            var id = $(this).data('id_product');
            var product_id = $('.product_id_' + id).val();
            var product_title = $('.product_title_' + id).val();
            var product_image = $('.product_image_' + id).val();
            var product_price = $('.product_price_' + id).val();
            var product_qty = $('.product_qty_' + id).val();
            var _token = $('input[name = "_token"]').val();

            $.ajax({
                url: "{{ route('home.addCartAjax') }}",
                method: "POST",
                data:{
                    product_id: product_id,
                    product_title: product_title,
                    product_image: product_image,
                    product_price: product_price,
                    product_qty: product_qty,
                    _token: _token
                },
                success: function(data){
                    swal({
                            title: "Đã thêm sản phẩm vào giỏ hàng",
                            text: "Bạn có thể mua tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                            showCancelButton: true,
                            cancelButtonText: "Xem tiếp",
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Đi đến giỏ hàng",
                            closeOnConfirm: false,
                        },

                        function(){
                            window.location.href= "{{ route('home.showCartAjax') }}";
                        }
                    );
                }
            });
        });
    })
</script>

<script>
    $(document).ready(function(){

        // select city, district, commune
        $(".choose").on("change", function () {
            var action = $(this).attr('id');
            var id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';

            if (action == 'city') {
                result = 'district';
            } else {
                result = 'commune';
            }

            $.ajax({
                url: "{{ route('home.selectDeliveryHome') }}",
                method: "POST",
                data: {
                    action: action,
                    id: id,
                    _token: _token
                },
                success: function (data) {
                    $('#'+result).html(data);
                },
                error: function (xhr, status, error) {
                    console.error("AJAX request failed:", status, error);
                }
            });
        });

        $(".calculate_delivery").click(function(){
            var _token = $('input[name="_token"]').val();
            var city_id = $("#city").val();
            var district_id = $("#district").val();
            var commune_id = $("#commune").val();

            if(city_id == '' && district_id == '' && commune_id == ''){
                alert("Làm ơn chọn để tính phí vận chuyển");
            }else{
                $.ajax({
                    url: "{{ route('home.calculateFeeship') }}",
                    method: "POST",
                    data: {
                        city_id: city_id,
                        district_id: district_id,
                        commune_id: commune_id,
                        _token: _token
                    },
                    success: function () {
                        location.reload();
                    }
                });
            }


        })

    })
</script>

<!-- Latest compiled and minified JavaScript -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> --}}
</body>
</html>
