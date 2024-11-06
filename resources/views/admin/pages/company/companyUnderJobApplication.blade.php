@extends('admin.app')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Job Portal</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Job Portal</a></li>
                        <li class="breadcrumb-item active">Candidate!</li>
                    </ol>
                </div>
                <h4 class="page-title">Candidate ({{$jobApplicationCount}}) !</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addNewModalId">Add New</button>
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Image</th>
                        <th>Name En</th>
                        <th>Name Bn</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jobApplication as $key=>$jobApplicationData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                @if($jobApplicationData->user->profile!=null)
                                    <img src="{{asset($jobApplicationData->user->profile)}}" alt="Current Image"  style="max-width: 50px;">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{$jobApplicationData->user->name}}</td>
                            <td>{{$jobApplicationData->user? $jobApplicationData->user->name_bn:'N/A'}}</td>
                            <td>{{$jobApplicationData->user->email}}</td>
                            <td>{{$jobApplicationData->user->phone}}</td>
                            <td>
                                @if($jobApplicationData->user? $jobApplicationData->user->resume:'')
                                    <a href="{{asset($jobApplicationData->user? $jobApplicationData->user->resume:'' )}}" target="_blank">Download Resume</a>
                                @endif
                            </td>
                            <td style="width: 100px;">
                                <div class="d-flex">
                                    <a href="" class="btn btn-info btn-sm">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
