@extends('master')
@section('title','Post')
@push('style')

@endpush

@push('modal')

@endpush

@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="flex-grow-1">
                    <h4 class="fs-16 mb-1">Posts</h4>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    <div class="row g-3">
                        @foreach($posts as $postDetail)
                            <div class="col-lg-4">
                                <div class="d-flex p-3">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm icon-effect">
                                            <div class="avatar-title bg-transparent text-success rounded-circle">
                                                <i class="ri-pencil-ruler-2-line fs-36"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="fs-18">{{$postDetail->title}}</h5>
                                        <p class="text-muted my-3 ff-secondary">{{$postDetail->content}}</p>
                                        <div>
                                            <span class="text-muted" style="font-size: 10px !important;">Created by : {{$postDetail->user->name}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>

@endsection

@section('js')

@endsection
