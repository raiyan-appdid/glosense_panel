@extends('layouts/contentLayoutMaster')

@section('title', 'Reviews')
@section('page-style')
@endsection

@section('content')


<h2>In Progress</h2>

    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card>
                    {!! $dataTable->table() !!}
                </x-card>
            </div>
        </div>
    </section>


    <x-side-modal title="Add order" id="add-order-modal">
        <x-form id="add-order" method="POST" class="" :route="route('admin.orders.store')">
            <div class="col-md-12 col-12 ">
                <x-input name="name" />
            </div>
        </x-form>
    </x-side-modal>
    <x-side-modal title="Update order" id="edit-order-modal">
        <x-form id="edit-order" method="POST" class="" :route="route('admin.orders.update')">

            <div class="col-md-12 col-12 ">
                <x-input name="shiprocket_order_id" />
                <x-input name="shipment_id" />
                <x-input name="id" type="hidden" />
            </div>

        </x-form>
    </x-side-modal>
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {

            $(document).on('click', '[data-show]', function() {
                const modal = $(this).data('show');
                $(`#${modal}`).modal('show');
            });
        });

        function setValue(data, modal) {
            $(`${modal} #id`).val(data.id);
            $(`${modal} #name`).val(data.name);
            $(modal).modal('show');
        }
    </script>
@endsection
