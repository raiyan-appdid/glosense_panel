@extends('layouts/contentLayoutMaster')

@section('title', 'Blog')
@section('page-style')
@endsection

@section('content')
    <section>
        <x-card title="Add Blog">
            <x-form id="add-article" method="POST" class="" :route="route('admin.blogs.store')">
                <div class="col-lg-6 col-12">
                    <x-input name="title" />
                </div>
                <div class="col-lg-6 col-12">
                    <x-input-file name="image" />
                </div>
                <div class="col-lg-12 col-12">
                    <x-editor type="textarea" name="content" />
                </div>
            </x-form>
        </x-card>
    </section>

@endsection
@section('page-script')
    <script>
        function setValue(data, modal) {
            console.log(data);
            setTimeout(() => {
                location.href = data.route;
            }, 1000);
        }
    </script>
@endsection
