@extends('layouts/contentLayoutMaster')

@section('title', 'Edit Combo Product')
@section('page-style')
@endsection

@section('content')
    <section>
        <x-card title="Edit Combo Product">
            <x-form successCallback="redirect" id="edit-product" method="POST" class="" :route="route('admin.comboproducts.update')">
                <x-input name="id" type="hidden" value="{{ $product->id }}" />
                <div class="col-lg-4 col-12">
                    <x-input name="title" value="{{ $product->title }}" />
                </div>
                <div class="col-lg-4 col-12">
                    <x-input name="video_link" :required="false" type="url" value="{{ $product->video_link }}" />
                </div>
                <div class="col-lg-4 col-12">
                    <x-input name="manufacturer" value="{{ $product->manufacturer }}" />
                </div>
                <x-image-uploader :preview="$product->images" route="admin.comboproducts.image_destroy" name="images"
                    id="images" />

                <div class="col-lg-4 col-12">
                    <x-input name="price" type="number" value="{{ $product->price }}" />
                </div>
                <div class="col-lg-4 col-12">
                    <x-input name="discounted_price" type="number" value="{{ $product->discounted_price }}"
                        label="Discounted Price" />
                </div>
                <div class="col-lg-4 col-12">
                    <x-input name="measurement" type="number" value="{{ $product->measurement }}" label="Measurement" />
                </div>
                <div class="col-lg-4 col-12">
                    <x-input name="stock" type="number" value="{{ $product->stock }}" />
                </div>
                <div class="col-lg-4 col-12">
                    <x-input name="made_in" value="{{ $product->made_in }}" />
                </div>
                <div class="col-lg-4 col-12">
                    <x-input name="allowed_quantity" type="number" value="{{ $product->allowed_quantity }}" />
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
                    <x-input type="textarea" id="short_description" name="short_description" />
                </div>
                <div class="col-lg-12 col-12">
                    <x-editor type="textarea" id="edit_description" name="description" label="Description" />
                </div>
                <div class="col-lg-12 col-12">
                    <x-editor type="textarea" id="edit_product_detail" name="product_detail" label="Product Detail" />
                </div>
                <div class="col-lg-12 col-12">
                    <x-editor type="textarea" id="edit_how_to_take" name="how_to_take" label="How to take medicine" />
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

        $(document).ready(function() {
            const data = @json($product);
            $('#id').val(data.id);
            if (data.in_stock == 'yes') {
                $('#in_stock').prop('checked', true);
            }
            if (data.is_special == 'yes') {
                $('#is_special').prop('checked', true);
            }
            if (data.is_best_seller == 'yes') {
                $('#is_best_seller').prop('checked', true);
            }
            if (data.is_returnable == 'yes') {
                $('#is_returnable').prop('checked', true);
            }
            if (data.is_cancellable == 'yes') {
                $('#is_cancellable').prop('checked', true);
            }
            if (data.is_cod == 'yes') {
                $('#is_cod').prop('checked', true);
            }
            $('#short_description').val(data.short_description);
            fullEditor_edit_description.root.innerHTML = data.description;
            fullEditor_edit_product_detail.root.innerHTML = data.product_detail;
            fullEditor_edit_how_to_take.root.innerHTML = data.how_to_take;
        });

        function redirect() {
            location.href = `{{ route('admin.comboproducts.index') }}`
        }
    </script>
@endsection
