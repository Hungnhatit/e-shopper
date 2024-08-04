@extends('frontend.layouts.app')
<?php
    $account = true;
?>
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Image</td>
                                <td class="description">Name</td>
                                <td class="price">Price</td>

                                <td class="total">Action</td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img style="width: 140px;" src="{{asset('/upload/product/'.json_decode($product['image'])[0])}}" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{$product['name']}}</a></h4>

                                </td>
                                <td class="cart_price">
                                    <p>{{$product['price']}}$</p>
                                </td>

                                <td style="display: flex;" class="cart_total">
                                    <form action="{{'/ecommerce/edit-product/'.$product['id']}}" action="POST">
                                        @csrf
                                        <button type="submit">Edit</button>
                                    </form>

                                    <form action="{{'/ecommerce/product/delete/'.$product['id']}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection