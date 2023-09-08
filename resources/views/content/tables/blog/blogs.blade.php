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
    <x-modal id="content-modal" :footer="false" />
@endsection
@section('page-script')
    <script>        

        function setValue(data, modal) {

            $(`${modal} #id`).val(data.id);
            $(`${modal} #name`).val(data.name);
            $(modal).modal('show');
        }
        $(document).on('click', '[data-content]', function() {
            const data = $(this).closest('td').find('[data-hidden]').html();
            const modal = $('#content-modal');
            $(modal).find('.modal-body').html(data);
            $(modal).find('#content-modal-title').text('Blog Content');
            $(modal).modal('show');
        });
    </script>
@endsection
