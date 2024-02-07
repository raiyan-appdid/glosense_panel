@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Analytics')
@section('page-style')
    <style>

    </style>
@endsection

@section('content')

    <x-card>
        <x-form id="add-slider" :reset='0' method="POST" class="" :route="route('admin.extras.store')">
            <div class="col-md-12">
                <x-input name="heading" value="{{ $extra?->heading }}" />
            </div>
        </x-form>
    </x-card>

@endsection

@section('page-script')
    <script></script>
@endsection
