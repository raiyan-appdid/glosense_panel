@extends('layouts/contentLayoutMaster')

@section('title', 'Promocode')
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


    <x-side-modal title="Add promocode" id="add-promocode-modal">
        <x-form id="add-promocode" method="POST" class="" :route="route('admin.promocodes.store')">
            <div class="col-md-12 col-12 ">
                <x-input name="promocode" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input name="message" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input name="start_date" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input name="end_date" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input name="minimum_order_amount" type="number" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input name="max_discount_amount" type="number" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input name="discount" type="number" />
            </div>
            <div class="col-md-12 col-12 ">
                <select class="select2  form-control " id="" name="discount_type">
                    <option value="" disabled>Select Type</option>
                    <option value="percentage">Percentage</option>
                    <option value="flat">Flat</option>
                </select>
            </div>
        </x-form>
    </x-side-modal>
    <x-side-modal title="Update promocode" id="edit-promocode-modal">
        <x-form id="edit-promocode" method="POST" class="" :route="route('admin.promocodes.update')">
            <div class="col-md-12 col-12 ">
                <x-input name="promocode" />
                <x-input name="id" type="hidden" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input name="message" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input name="start_date" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input name="end_date" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input name="minimum_order_amount" type="number" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input name="max_discount_amount" type="number" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input name="discount" type="number" />
            </div>
            <div class="col-md-12 col-12 ">
                <select class="select2  form-control " id="discount_type" name="discount_type">
                    <option value="" disabled>Select Type</option>
                    <option value="percentage">Percentage</option>
                    <option value="flat">Flat</option>
                </select>
            </div>

        </x-form>
    </x-side-modal>
@endsection
@pushonce('component-script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpushonce
@section('page-script')
    <script>
        $(document).ready(function() {

            $('#start_date').flatpickr();
            $('#end_date').flatpickr();

            $('#promocode-table_wrapper .dt-buttons').append(
                `<button type="button" data-show="add-promocode-modal" class="btn btn-flat-success waves-effect float-md-right">Add</button>`
            );
            $(document).on('click', '[data-show]', function() {
                const modal = $(this).data('show');
                $(`#${modal}`).modal('show');
            });
        });

        function setValue(data, modal) {

            $(`${modal} #id`).val(data.id);
            $(`${modal} #promocode`).val(data.promocode);
            $(`${modal} #message`).val(data.message);
            $(`${modal} #start_date`).val(data.start_date);
            $(`${modal} #end_date`).val(data.end_date);
            $(`${modal} #minimum_order_amount`).val(data.minimum_order_amount);
            $(`${modal} #max_discount_amount`).val(data.max_discount_amount);
            $(`${modal} #discount`).val(data.discount);
            $(`${modal} #discount_type`).val(data.discount_type).trigger('change');
            $(modal).modal('show');
        }
    </script>
@endsection
