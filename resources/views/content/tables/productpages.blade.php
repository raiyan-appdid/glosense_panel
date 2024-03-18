@extends('layouts/contentLayoutMaster')

@section('title', 'ProductPage')
@section('page-style')
@endsection

@section('content')

    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card>
                    <x-form :reset="0" id="add-products" method="POST" class="" :route="route('admin.product-page.store')">
                        <div class="col-md-12">
                            <x-input value="{{ $data?->text_1 }}" name="text_1" />
                            <x-input value="{{ $data?->text_2 }}" name="text_2" />
                        </div>
                    </x-form>
                </x-card>
            </div>
        </div>
    </section>


@endsection
@section('page-script')
    <script></script>
@endsection
