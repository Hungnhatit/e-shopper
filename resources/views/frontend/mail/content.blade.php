<h1>Xin chào {{$data['username']}}. Cảm ơn bạn đã đặt hàng tại E-Shopper. Dưới đây là thông tin xác nnận đơn hàng:</h1>
<p>Địa chỉ giao hàng: {{$data['address']}}</p>
<p>Sản phẩm:</p>
@foreach($data['product'] as $product)
<p>Tên sản phẩm: {{$product['name']}}, giá: {{$product['price']}}, số lượng: {{$product['quantity']}}, thành tiền: {{$product['price']*$product['quantity']}}</p>
@endforeach