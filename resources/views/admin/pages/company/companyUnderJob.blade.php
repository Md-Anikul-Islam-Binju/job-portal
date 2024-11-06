@extends('admin.app')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Job Portal</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Job Portal</a></li>
                        <li class="breadcrumb-item active">Posted Job!</li>
                    </ol>
                </div>
                <h4 class="page-title">Posted Job!</h4>
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
                        <th>Title En</th>
                        <th>Title Bn</th>
                        <th>Vacancy</th>
                        <th>Address En</th>
                        <th>Address Bn</th>
                        <th>Salary</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($job as $key=>$jobData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$jobData->title}}</td>
                            <td>{{$jobData->title_bn? $jobData->title_bn:'N/A'}}</td>
                            <td>{{$jobData->vacancy}}</td>
                            <td>{{$jobData->address}}</td>
                            <td>{{$jobData->address_bn}}</td>
                            <td>{{$jobData->salary? $jobData->salary:'N/A'}}</td>
                            <td>{{$jobData->deadline}}</td>
                            <td>{{$jobData->status==1? 'Active':'Inactive'}}</td>
                            <td style="width: 100px;">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{route('admin.company.under.job.application',$jobData->id)}}" class="btn btn-info btn-sm">Apply Candidate</a>
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
