@extends('layouts/contentLayoutMaster')

@section('title', 'Edit Successs Story')
@section('page-style')
@endsection

@section('content')
    <section>
        <x-card title="Edit Successs Story">
            <x-form successCallback="redirect" id="edit-story" method="POST" class="" :route="route('admin.successstorys.update')">
                <div class="col-lg-6 col-12">
                    <x-input name="title" />
                    <x-input name="id" type="hidden" />
                </div>
                <div class="col-lg-5 col-11">
                    <x-input-file name="image" :required="false" />
                </div>
                <div class="col-lg-1 col-1 mt-1 text-center">
                    <div class="avatar avatar-lg">
                        <img class="view-on-click" id="image-preview" src="" alt="avatar">
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <x-input name="meta_title" />
                </div>
                <div class="col-lg-6 col-12">
                    <x-input name="meta_description" />
                </div>
                <div class="col-lg-12 col-12">
                    <x-editor name="content" id="edit_content" />
                </div>
            </x-form>
        </x-card>
    </section>

@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            const data = @json($story);
            $('#id').val(data.id);
            $('#title').val(data.title);
            $('#meta_title').val(data.meta_title);
            $('#meta_description').val(data.meta_description);
            $('#image-preview').attr('src', '/' + data.image);
            fullEditor_edit_content.root.innerHTML = data.content;
        });

        function redirect() {
            location.href = `{{ route('admin.successstorys.index') }}`;
        }
    </script>
@endsection
