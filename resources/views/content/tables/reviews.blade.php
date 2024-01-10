@extends('layouts/contentLayoutMaster')

@section('title', 'Reviews')
@section('page-style')
@endsection

@section('content')



    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-md-2">
                        <x-input type="number" value="{{ $globalStar }}" name="global_star" />
                    </div>
                </div>
                <x-card>
                    {!! $dataTable->table() !!}
                </x-card>
            </div>
        </div>
    </section>


    <x-side-modal title="Add Review" id="add-review-modal">
        <x-form id="add-review" method="POST" class="" :route="route('admin.reviews.store')">
            <div class="col-md-12 col-12 ">
                <x-input name="title" />
                <x-input name="description" />
                <x-input name="star" />
            </div>
        </x-form>
    </x-side-modal>
    <x-side-modal title="Update Review" id="edit-review-modal">
        <x-form id="edit-review" method="POST" class="" :route="route('admin.reviews.update')">

            <div class="col-md-12 col-12 ">
                <x-input name="title" />
                <x-input name="description" />
                <x-input name="star" />
                <input type="hidden" name="id" id="id">
            </div>

        </x-form>
    </x-side-modal>
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {

            $('#review-table_wrapper .dt-buttons').append(
                `<button type="button" data-show="add-review-modal" class="btn btn-flat-success waves-effect float-md-right">Add</button>`
            );

            $(document).on('click', '[data-show]', function() {
                const modal = $(this).data('show');
                $(`#${modal}`).modal('show');
            });
        });

        function setValue(data, modal) {
            $(`${modal} #id`).val(data.id);
            $(`${modal} #title`).val(data.title);
            $(`${modal} #description`).val(data.description);
            $(`${modal} #star`).val(data.star);
            $(modal).modal('show');
        }

        $('#global_star').on('input', function(){
            const val = $(this).val();
            $.ajax({
                type: "get",
                url: "{{ route('admin.reviews.store-global-star') }}",
                data: {
                    global_star : val
                },
                success: function (response) {
                    console.log(response);
                    snb('success', 'Updated On site')

                },
                error : function(error){
                    console.log(error);
                    snb('error', 'Only 1 - 5 numbers are allowed')
                }
            });
        })
    </script>
@endsection
