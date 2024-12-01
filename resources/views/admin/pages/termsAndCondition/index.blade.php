@extends('admin.app')
@section('admin_content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/dashboard">Garments Niyog</a></li>
                                <li class="breadcrumb-item active">Terms & Condition</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Terms & Condition</h4>
                    </div>
                </div>
            </div>
            <!-- Form row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title">Form</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.terms.condition.createOrUpdate',$termsAndCondition ? $termsAndCondition->id : null)}}" method="post">
                                @csrf
                                <div class="row g-2">


                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Title English</label>
                                        <input type="text" class="form-control" name="title" value="{{$termsAndCondition?$termsAndCondition->title:''}}"
                                               placeholder="Enter Title English">
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Title Bangle </label>
                                        <input type="text" class="form-control" name="title_bn" value="{{$termsAndCondition?$termsAndCondition->title_bn:''}}"
                                               placeholder="Enter Title Bangle">
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label>Short Description English</label>
                                                <textarea id="summernoteEdit{{ $termsAndCondition ? $termsAndCondition->id : '' }}" name="details">{{ $termsAndCondition ? $termsAndCondition->details : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label>Short Description Bangle</label>
                                                <textarea id="summernoteEdit{{ $termsAndCondition ? $termsAndCondition->id : '' }}" name="details_bn">{{ $termsAndCondition ? $termsAndCondition->details_bn : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
