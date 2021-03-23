
@foreach ($cart as $id => $product)
{{--  @php
    dump($buynow==$id);
@endphp  --}}
    <tr class="alert" role="alert">
        <td>
            <label class="checkbox-wrap checkbox-primary">
                <input data-id="{{ $id }}" type="checkbox" {{ isset($buynow)&&$buynow==$id?"checked":"" }}>
                <span class="checkmark"></span>
            </label>
        </td>
        <td>
            <div class="img" style="background-image: url({{ asset($product['image']) }});"></div>
        </td>
        <td>
            <div class="email">
                <span>{{ $product['name'] }}</span>
                <span>{{ $product['stock'] }} products left</span>
            </div>
        </td>
        <td>${{ number_format($product['single_price'], 2, ',', '.') }}</td>
        <td class="quantity">
            <div class="input-group">
                <input type="text" name="quantity" class="quantity form-control input-number"
                    value="{{ $product['quantity'] }}" min="1" max="100" data-id="{{ $id }}" autocomplete="off">
            </div>
        </td>
        <td>${{ number_format($product['total_price'], 2, ',', '.') }}</td>
        <td>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-id="{{ $id }}" data-target="#exampleModal" data-toggle="modal">
                <span aria-hidden="true"><i class="fa fa-close"></i></span>
            </button>
        </td>
    </tr>
@endforeach
