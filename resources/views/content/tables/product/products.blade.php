@extends('layouts/contentLayoutMaster')

@section('title', 'Product')
@section('page-style')
@endsection

@section('content')

    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card>
                    {!! $dataTable->table() !!}
                </x-card>
            </div>
        </div>
    </section>
    <x-modal id="how-to-take" :footer="false"></x-modal>
    <x-modal id="short-description" :footer="false"></x-modal>
    <x-modal id="description" :footer="false"></x-modal>
    <x-modal id="product-detail" :footer="false"></x-modal>
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {

            $(document).on('click', '[data-take-medicine]', function() {
                const data = $(this).closest('td').find('[data-hidden]').html();
                const modal = $('#how-to-take');
                $(modal).find('.modal-body').html(data);
                $(modal).find('how-to-take-title').text('How to take medicine');
                $(modal).modal('show');
            });

            $(document).on('click', '[data-short-description]', function() {
                const data = $(this).closest('td').find('[data-hidden]').html();
                const modal = $('#short-description');
                $(modal).find('.modal-body').html(data);
                $(modal).find('short-description-title').text('Short Description');
                $(modal).modal('show');
            });

            $(document).on('click', '[data-description]', function() {
                const data = $(this).closest('td').find('[data-hidden]').html();
                const modal = $('#description');
                $(modal).find('.modal-body').html(data);
                $(modal).find('#description-title').text('Description');
                $(modal).modal('show');
            });

            $(document).on('click', '[data-product-detail]', function() {
                const data = $(this).closest('td').find('[data-hidden]').html();
                const modal = $('#product-detail');
                $(modal).find('.modal-body').html(data);
                $(modal).find('#product-detail-title').text('Product Detail');
                $(modal).modal('show');
            });

            $(document).on('change', '[data-stock]', function() {
                console.log('changed');
            });
        });

        function setValue(data, modal) {

            $(`${modal} #id`).val(data.id);
            $(`${modal} #name`).val(data.name);
            $(modal).modal('show');
        }
    </script>
@endsection
