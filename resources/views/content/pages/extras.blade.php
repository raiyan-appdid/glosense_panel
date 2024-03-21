@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Analytics')
@section('page-style')
    <style>

    </style>
@endsection

@section('content')

    <x-card>
        <x-form id="add-slider" successCallback="test" :reset='0' method="POST" class="" :route="route('admin.extras.store')">
            <div class="col-md-12">
                <x-input name="heading" value="{{ $extra?->heading }}" />
                <div class="row">
                    <div class="col-md-10">
                        <x-input type="file" label="Index Page Pop Image" :required="false" name="image" />
                    </div>
                    <div class="col-md-2">
                        <img src="{{ $extra?->image }}" width="100%" alt="">
                    </div>
                    <div class="col-md-5">
                        <x-input label="Product Page Pop Title" value="{{ $extra?->productt_page_pop_title }}" name="productt_page_pop_title" />
                    </div>
                    <div class="col-md-5">
                        <x-input type="file" label="Product Page Pop Image" :required="false"
                            name="product_page_image" />
                    </div>
                    <div class="col-md-2">
                        <img src="{{ $extra?->product_page_image }}" width="100%" alt="">
                    </div>
                    {{-- <div class="col-md-10">
                        <x-input type="file" :required="false" name="pdf" />
                    </div> --}}
                </div>
            </div>
        </x-form>
    </x-card>

@endsection

@section('page-script')
    <script>
        function test() {
            window.location.reload();
        }
    </script>
@endsection
