@extends('layouts/contentLayoutMaster')

@section('title', 'VideoGallery')
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


    <x-side-modal title="Add videogallery" id="add-videogallery-modal">
        <x-form id="add-videogallery" method="POST" class="" :route="route('admin.videogallerys.store')">
            <div class="col-md-12 col-12 ">
                <x-input name="title" :required="false" />
            </div>
            <div class="col-md-12 col-12 ">
                <select class="select2  form-control" data-change id="video_type" name="video_type">
                    <option value="" disabled>Select Type</option>
                    <option value="url">URL</option>
                    <option value="video">Video</option>
                </select>
            </div>
            <div class="col-md-12 col-12" data-url>
                <x-input name="url" type="url" :required="false" />
            </div>
            <div class="col-md-12 col-12 " hidden data-video>
                <x-input-file name="video" type="file" :required="false" />
            </div>
        </x-form>
    </x-side-modal>
    <x-side-modal title="Update videogallery" id="edit-videogallery-modal">
        <x-form id="edit-videogallery" method="POST" class="" :route="route('admin.videogallerys.update')">

            <div class="col-md-12 col-12 ">
                <x-input name="title" :required="false" />
                <x-input name="id" type="hidden" />
            </div>
            <div class="col-md-12 col-12">
                <select class="select2  form-control" data-change id="edit_video_type" name="edit_video_type">
                    <option value="" disabled>Select Type</option>
                    <option value="url">URL</option>
                    <option value="video">Video</option>
                </select>
            </div>
            <div class="col-md-12 col-12" data-url>
                <x-input name="url" type="url" :required="false" />
            </div>
            <div class="col-md-12 col-12" hidden data-video>
                <x-input-file name="video" type="file" :required="false" />
            </div>
        </x-form>
    </x-side-modal>
@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
            $('#videogallery-table_wrapper .dt-buttons').append(
                `<button type="button" data-show="add-videogallery-modal" class="btn btn-flat-success waves-effect float-md-right">Add</button>`
            );
            $(document).on('click', '[data-show]', function() {
                const modal = $(this).data('show');
                $(`#${modal}`).modal('show');
            });
        });

        function setValue(data, modal) {

            $(`${modal} #id`).val(data.id);
            $(`${modal} #title`).val(data.title);
            $(`${modal} #edit_video_type`).val(data.video_type).trigger('change');
            if (data.video_type == 'url') {
                $(`${modal} #url`).val(data.video_url);
            }
            $(modal).modal('show');
        }
        $(document).ready(function() {
            $('.select2').select2();

            function video() {
                $('[data-url]').attr('hidden', true);
                $('[data-url]').attr('disabled', true);
                $('[data-video]').attr('hidden', false);
            }

            function url() {
                $('[data-url]').attr('hidden', false);
                $('[data-video]').attr('hidden', true);
                $('[data-video]').attr('disabled', true);
            }

            $('[data-change]').change(function(e) {
                e.preventDefault();
                // const is_selected = $(this).is(':selected');                  
                if ($(this).val() == 'video') {
                    video();
                } else {
                    console.log('url');
                    url();
                }
            });
        });
    </script>
@endsection
