@extends('layouts/contentLayoutMaster')

@section('title', 'Add Product')
@section('page-style')
@endsection

@section('content')
    <section>
        <x-card title="Add Product">
            <x-form successCallback="redirect" id="add-product" method="POST" class="" :route="route('admin.products.store')">
                <div class="col-lg-6 col-12">
                    <x-input name="title" />
                </div>
                <div class="col-lg-6 col-12">
                    <x-input name="video_link" :required="false" type="url" />
                </div>
                {{-- <div class="col-lg-4 col-12">
                    <x-input-file name="images" :multiple="true" />
                </div> --}}
                <x-image-uploader name="images" id="images" />

                <div class="col-lg-4 col-12">
                    <x-input name="price" type="number" />
                </div>
                <div class="col-lg-4 col-12">
                    <x-input name="discounted_price" type="number" label="Discounted Price" />
                </div>
                <div class="col-lg-4 col-12">
                    <x-input name="measurement" type="number" label="Measurement" />
                </div>
                <div class="col-lg-4 col-12">
                    <x-select name="unit_id" :options="$units" label="Unit" />
                </div>
                <div class="col-lg-4 col-12">
                    <x-input name="stock" type="number" />
                </div>
                <div class="col-lg-4 col-12">
                    <x-input name="manufacturer" />
                </div>
                <div class="col-lg-6 col-12">
                    <x-input name="made_in" />
                </div>
                <div class="col-lg-6 col-12">
                    <x-input name="allowed_quantity" type="number" />
                </div>
                <div class="col-lg-2 col-4">
                    <x-custom-switch id="in_stock" name="in_stock" label="In Stock" />
                </div>
                <div class="col-lg-2 col-4">
                    <x-custom-switch id="is_returnable" name="is_returnable" label="Is Returnable" />
                </div>
                <div class="col-lg-2 col-4">
                    <x-custom-switch id="is_cancellable" name="is_cancellable" label="Is Cancellable" />
                </div>
                <div class="col-lg-2 col-4">
                    <x-custom-switch id="is_cod" name="is_cod" label="Is COD" />
                </div>
                <div class="col-lg-2 col-4">
                    <x-custom-switch id="is_best_seller" name="is_best_seller" label="Best Seller" />
                </div>
                <div class="col-lg-2 col-4">
                    <x-custom-switch id="is_special" name="is_special" label="Special" />
                </div>

                {{-- <div class="col-lg-2 col-4">
                    <x-custom-switch id="is_combo" name="is_combo" label="Is Combo" />
                </div> --}}
                <div class="col-lg-12 col-12">
                    <x-input type="textarea" name="short_description" />
                </div>
                <div class="col-lg-12 col-12">
                    <x-editor type="textarea" name="description" label="Description" />
                </div>
                <div class="col-lg-12 col-12">
                    <x-editor type="textarea" name="product_detail" label="Product Detail" />
                </div>
                <div class="col-lg-12 col-12">
                    <x-editor type="textarea" name="how_to_take" label="How to take" />
                </div>
            </x-form>
        </x-card>
    </section>

@endsection
@section('page-script')
    <script>
        function setValue(data, modal) {
            console.log(data);
            setTimeout(() => {
                location.href = data.route;
            }, 1000);
        }

        const unit = @json($units);
        $.each(unit, function(i, v) {
            console.log(v.name);
            if (v.name == 'Gm') {
                $('#unit_id').attr('selected', true).trigger('change');
            }
        });


        function redirect() {
            location.href = `{{ route('admin.products.index') }}`
        }
    </script>
@endsection
