@extends('frontend.layouts.app')
@section('content')
<section id="cart_items">
    <div class="container">

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>

                <tbody>
                    @foreach($cart as $cart_item)                
                    <tr class="cart-item">
                        <td class="cart_product">
                            <a href=""><img style="width: 100px;" src="{{asset('upload/product/'.json_decode($cart_item['image'])[0] ) }}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$cart_item['name']}}</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>{{$cart_item['price']}}$</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a href="{{'/ecommerce/update-cart'}}" data-id="{{$cart_item['id']}}" class="cart_quantity_down" href=""> - </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{$cart_item['quantity']}}" autocomplete="off" size="2">
                                <a data-id="{{$cart_item['id']}}" class="cart_quantity_up" href=""> + </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{ $cart_item['price'] * $cart_item['quantity'] }}$</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <form action="/ecommerce/remove-all-cart" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Remove all items</button>
        </form>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>$59</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>${{$totalPrice}}</span></li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="/ecommerce/cart/checkout">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('.cart_quantity_up').click(function(e) {
            e.preventDefault();
            var productId = $(this).data('id');
            console.log(productId);
            var quantityInput = $(this).siblings('.cart_quantity_input').val();
            var quantity = parseInt(quantityInput) + 1;
            $.ajax({
                url: "{{route('update-cart')}}",
                method: "POST",
                data: {
                    _token: "{{csrf_token()}}",
                    id: productId,
                    quantity: quantity++,
                },
                success: function(res) {
                    location.reload();
                },
                error: function(res) {
                    console.log(res.responseText);
                }
            })

        })

        $('.cart_quantity_down').click(function(e) {
            e.preventDefault();
            var productId = $(this).data('id');
            console.log(productId);
            var quantityInput = $(this).siblings('.cart_quantity_input').val();
            var quantity = parseInt(quantityInput) - 1;
            $.ajax({
                url: "{{route('update-cart')}}",
                method: "POST",
                data: {
                    _token: "{{csrf_token()}}",
                    id: productId,
                    quantity: quantity--,
                },
                success: function(res) {
                    location.reload();
                },
                error: function(res) {
                    console.log(res.responseText);
                }
            })
        })

        $('.cart_quantity_delete').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                url: "{{ route('remove-cart-item') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function(response) {
                    alert(response.message);
                    location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        })
    })
</script>



@endsection