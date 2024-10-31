@extends('company.app')
@section('company_content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Job Portal</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Job Portal</a></li>
                        <li class="breadcrumb-item active">Candidate Details</li>
                    </ol>
                </div>
                <h4 class="page-title">Candidate Details</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Candidate Information</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <span><strong>Name En:</strong> {{$candidate->name}}</span>
                    <span><strong>Name Bn:</strong> {{$candidate->name_bn}}</span>
                    <span><strong>Email:</strong> {{$candidate->email}}</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span><strong>Phone:</strong> {{$candidate->phone}}</span>
                    <span><strong>NID:</strong> {{$candidate->nid}}</span>
                    <span><strong>Status:</strong> {{$candidate->status}}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
