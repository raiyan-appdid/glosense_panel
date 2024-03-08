@extends('layouts/contentLayoutMaster')

@section('title', 'Blog')
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


    <x-side-modal title="Add blog" id="add-blog-modal">
        <x-form id="add-blog" method="POST" class="" :route="route('admin.blogs.store')">
            <div class="col-md-12 col-12 ">
                <x-input name="title" />
                <x-editor name="short_description" label="Short Description" />
                <x-editor name="content" label="Content" />
                <x-input-file name="image" />
            </div>
        </x-form>
    </x-side-modal>
    {{-- <x-side-modal title="Update blog" id="edit-blog-modal">
        <x-form id="edit-blog" method="POST" class="" :route="route('admin.blogs.update')">
            <div class="col-md-12 col-12 ">
                <x-input name="title" />
                <x-editor name="short_description" id="edit_short_description" label="Short Description" />
                <x-editor name="content" id="edit_content" label="Content" />
                <x-input-file name="image" />
                <x-input name="id" type="hidden" />
            </div>
        </x-form>
    </x-side-modal> --}}
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            $('#blog-table_wrapper .dt-buttons').append(
                `<button type="button" data-show="add-blog-modal" class="btn btn-flat-success waves-effect float-md-right">Add</button>`
            );
            $(document).on('click', '[data-show]', function() {
                window.location.href = "{{ route('admin.blogs.create') }}";
            });
        });

        $(document).on('click', '[data-edit]', function() {
            window.location.href = $(this).data('edit');
        })

        function setValue(data, modal) {

            $(`${modal} #id`).val(data.id);
            $(`${modal} #title`).val(data.title);
            $(`${modal} #short_description`).val(data.short_description);

            fullEditor_edit_content.root.innerHTML = data.content

            $(modal).modal('show');
        }
    </script>
@endsection
