@extends('layouts/contentLayoutMaster')

@section('title', 'Testimonial')
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


    <x-side-modal title="Add testimonial" id="add-testimonial-modal">
        <x-form id="add-testimonial" method="POST" class="" :route="route('admin.testimonials.store')">
            <div class="col-md-12 col-12 ">
                <x-input name="name" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input name="designation" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input-file name="image" />
            </div>
            <div class="col-md-12 col-12 ">
                <x-input name="description" type="textarea" />
            </div>
        </x-form>
    </x-side-modal>
    <x-side-modal title="Update testimonial" id="edit-testimonial-modal">
        <x-form id="edit-testimonial" method="POST" class="" :route="route('admin.testimonials.update')">

            <div class="col-md-12 col-12 ">
                <x-input name="id" type="hidden" />
                <div class="col-md-12 col-12 ">
                    <x-input name="name" />
                </div>
                <div class="col-md-12 col-12 ">
                    <x-input name="designation" />
                </div>
                <div class="col-md-12 col-12 ">
                    <x-input-file name="image" />
                    <div class="avatar avatar-lg">
                        <img class="view-on-click" id="image-preview" src="" alt="avatar">
                    </div>
                </div>
                <div class="col-md-12 col-12 ">
                    <x-input name="description" type="textarea" />
                </div>
            </div>

        </x-form>
    </x-side-modal>
    <x-modal id="description-modal" :footer="false" />
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            $('#testimonial-table_wrapper .dt-buttons').append(
                `<button type="button" data-show="add-testimonial-modal" class="btn btn-flat-success waves-effect float-md-right">Add</button>`
            );
            $(document).on('click', '[data-show]', function() {
                const modal = $(this).data('show');
                $(`#${modal}`).modal('show');
            });
        });

        function setValue(data, modal) {
            $(`${modal} #id`).val(data.id);
            $(`${modal} #name`).val(data.name);
            $(`${modal} #designation`).val(data.designation);
            $(`${modal} #description`).val(data.description);
            $(`${modal} #image-preview`).attr('src', '/' + data.image);
            $(modal).modal('show');
        }

        $(document).on('click', '[data-description]', function() {
            const data = $(this).closest('td').find('[data-hidden]').html();
            const modal = $('#description-modal');
            $(modal).find('.modal-body').html(data);
            $(modal).find('#description-modal-title').text('Description')
            $(modal).modal('show');
        });
    </script>
@endsection
