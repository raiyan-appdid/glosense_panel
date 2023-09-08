@extends('layouts/contentLayoutMaster')

@section('title', 'Today Order')
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


    <x-side-modal title="Add order tracking code" id="tracking-code-model">
        <x-form id="add-order-tracking-code" method="POST" class="" :route="route('admin.orders.update-tracking-code')">
            <div class="col-md-12 col-12 ">
                <x-input name="tracking_code" />
                <x-input name="id" id="id" type="hidden" />
            </div>
        </x-form>
    </x-side-modal>
    <x-modal id="tracking-code-model" :footer="false" />
@endsection
@section('page-script')
    <script>
        function setValue(data, modal) {
            $(`${modal} #id`).val(data.id);
            $(`${modal} #name`).val(data.name);
            $(modal).modal('show');
        }
        $(document).on('click', '.data-tracking-code', function() {
            const id = $(this).attr('id');
            $(`#id`).val(id)
            $('#tracking-code-model').modal('show');
        })
    </script>
@endsection
