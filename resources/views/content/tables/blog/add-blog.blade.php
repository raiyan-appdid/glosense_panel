@extends('layouts/contentLayoutMaster')

@section('title', 'Blog')
@section('page-style')
@endsection

@section('content')
    <section>
        <x-card title="Add Blog">
            <x-form id="add-blog" method="POST" class="" :route="route('admin.blogs.store')">
                <div class="col-md-6 col-12 ">
                    <x-input name="title" />
                </div>
                <div class="col-md-6">
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
    <script></script>
@endsection
