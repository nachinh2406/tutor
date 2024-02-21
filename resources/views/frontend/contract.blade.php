@extends("frontend.layouts.master")
@section("content")
    <!-- ============================ Latest job ================================== -->
    <section>
        <div class="container">

            <div class="row">
                <div class="col text-center">
                    <div class="sec-heading mx-auto">
                        <h2>Hợp đồng mẫu</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    {!! $contract->content !!}
                </div>
            </div>
        </div>
    </section>

    <div class="clearfix"></div>
    <!-- ============================ Category End ================================== -->

    <!-- ============================ Testimonial  Start================================== -->

    <!-- ============================ Testimonial End ================================== -->
@endsection
