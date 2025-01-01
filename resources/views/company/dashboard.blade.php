@extends('company.app')
@section('company_content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Garments Niyog</a></li>
                        <li class="breadcrumb-item active">Dashboard!</li>
                    </ol>
                </div>
                <h4 class="page-title">Welcome!</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-6 col-sm-6">
            <div class="card widget-flat text-bg-pink">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-app-store-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Total Job</h6>
                    <a href="{{route('company.job.section')}}">
                     <h2 class="my-2" style="color: white">{{$totalJob}}</h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xxl-6 col-sm-6">
            <div class="card widget-flat text-bg-purple">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-profile-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Total Candidate Apply</h6>
                    <a href="{{route('company.job.candidate')}}">
                      <h2 class="my-2" style="color: white">{{$totalCandidate}}</h2>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
