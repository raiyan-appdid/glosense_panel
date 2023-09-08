@extends('layouts/contentLayoutMaster')

@section('title', 'Blog')
@section('page-style')
@endsection

@section('content')
    <section>
        <x-card title="Edit Blog">
            <x-form id="edit-blog" method="POST" class="" :route="route('admin.blogs.update')">
                <div class="col-lg-6 col-12">
                    <x-input name="title" />
                    <x-input name="id" type="hidden" />
                </div>
                <div class="col-lg-6 col-12">
                    <x-input-file name="image" :required="false" />
                    <div class="avatar avatar-lg">
                        <img class="view-on-click" id="image-preview" src="" alt="avatar">
                    </div>
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
            const data = @json($blog);
            $('#id').val(data.id);
            $('#title').val(data.title);
            $('#image-preview').attr('src', '/' + data.image);
            fullEditor_edit_content.root.innerHTML = data.content;
        });
    </script>
@endsection
