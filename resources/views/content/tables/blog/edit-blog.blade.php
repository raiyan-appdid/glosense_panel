@extends('layouts/contentLayoutMaster')

@section('title', 'Blog')
@section('page-style')
@endsection

@section('content')
    <section>
        <x-card title="Edit Blog">
            <x-form successCallback="editCallback" id="edit-blog" method="POST" class="" :route="route('admin.blogs.update')">
                <div class="col-md-6 col-12 ">
                    <input type="hidden" name="id" value="{{ $data->id }}" id="">
                    <x-input value="{{ $data->title }}" name="title" />
                </div>

                @if ($data->image)
                    <div class="col-md-2">
                        <img src="{{ $data->image }}" class="w-100 rounded-circle view-on-click cursor-pointer"
                            alt="">
                    </div>
                @endif
                <div class="col-md-4">
                    <x-input-file name="image" />
                </div>
                <div class="col-md-12">
                    <x-editor name="short_description" label="Short Description" />
                </div>
                <div class="col-md-12">
                    <x-editor name="content" label="Content" />
                </div>
            </x-form>
        </x-card>
    </section>

@endsection
@section('page-script')
    <script>
        $(function() {
            const data = @json($data);
            fullEditor_content.root.innerHTML = data.content
            fullEditor_short_description.root.innerHTML = data.short_description
        })

        function editCallback(response) {
            window.location.href = "{{ route('admin.blogs.index') }}";
        }
    </script>
@endsection
