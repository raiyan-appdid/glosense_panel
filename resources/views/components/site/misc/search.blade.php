<div class="search">
    @forelse ($products as $product)
        <div class="minicart__product--items d-flex">
            <div class="minicart__thumb">
                <a href="#"><img src="{{ asset($product->images[0]->image) }}" alt="prduct-img"></a>
            </div>
            <div class="mt-5 ml-3" style="margin-left:2rem!important;">
                <h4 class="minicart__subtitle"><a
                        href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a>
                </h4>
                <div class="minicart__price">
                    <span class="minicart__current--price">₹ {{ $product->discounted_price }}</span>
                    <span class="minicart__old--price">₹{{ $product->price }}</span>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center">
            <p class="p-5">No Product Found</p>
        </div>
    @endforelse
</div>
