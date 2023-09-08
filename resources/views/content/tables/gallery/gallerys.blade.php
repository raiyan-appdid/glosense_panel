@extends('layouts/contentLayoutMaster')

@section('title', 'Gallery')
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


    <x-side-modal title="Add gallery" id="add-gallery-modal">
        <x-form id="add-gallery" method="POST" class="" :route="route('admin.gallerys.store')">
            <div class="col-md-12 col-12 ">
                <x-input-file name="image" />
            </div>
        </x-form>
    </x-side-modal>
    <x-side-modal title="Update gallery" id="edit-gallery-modal">
        <x-form id="edit-gallery" method="POST" class="" :route="route('admin.gallerys.update')">

            <div class="col-md-12 col-12 ">
                <x-input-file name="image" />
                <div class="avatar avatar-lg">
                    <img class="view-on-click" id="image-preview" src="" alt="avatar">
                </div>
                <x-input name="id" type="hidden" />
            </div>

        </x-form>
    </x-side-modal>
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            $('#gallery-table_wrapper .dt-buttons').append(
                `<button type="button" data-show="add-gallery-modal" class="btn btn-flat-success waves-effect float-md-right">Add</button>`
            );
            $(document).on('click', '[data-show]', function() {
                const modal = $(this).data('show');
                $(`#${modal}`).modal('show');
            });
        });

        function setValue(data, modal) {

            $(`${modal} #id`).val(data.id);
            $(`${modal} #image-preview`).attr('src', '/' + data.image);
            $(modal).modal('show');
        }
    </script>
@endsection
