<div class="col-sm-6 col-md-4 col-lg-3 p-b-35">
    <div class="single-product">
        <div class="product-img">
            <a href="{{ route('product-detail', $product->slug) }}">
                @php
                    $photo = explode(',', $product->photo);
                @endphp
                <img class="default-img" src="{{ $photo[0] }}" alt="{{ $photo[0] }}">
                <img class="hover-img" src="{{ $photo[0] }}" alt="{{ $photo[0] }}">
                @if($product->stock <= 0)
                    <span class="out-of-stock">Sale out</span>
                @elseif($product->condition == 'new')
                    <span class="new">New</span>
                @elseif($product->condition == 'hot')
                    <span class="hot">Hot</span>
                @else
                    <span class="price-dec">{{ $product->discount }}% Off</span>
                @endif
            </a>
            <div class="button-head">
                <div class="product-action">
                    <a data-toggle="modal" data-target="#{{ $product->id }}" title="Quick View" href="#">
                        <i class="ti-eye"></i><span>Quick Shop</span>
                    </a>
                    <a title="Wishlist" href="{{ route('add-to-wishlist', $product->slug) }}">
                        <i class="ti-heart"></i><span>Add to Wishlist</span>
                    </a>
                </div>
                <div class="product-action-2">
                    <a title="Add to cart" href="{{ route('add-to-cart', $product->slug) }}">Add to cart</a>
                </div>
            </div>
        </div>
        <div class="product-content">
            <h3><a href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a></h3>
            <div style="font-size:16px;"
                 data-price="{{ $product->price ?? 0 }}"
                 data-discount="{{ $product->discount ?? 0 }}"
                 data-priceusd="{{ $product->price_usd ?? 0 }}"
                 data-discountusd="{{ $product->discount_usd ?? 0 }}"
                 class="product-price">
            </div>
        </div>
    </div>
</div>
