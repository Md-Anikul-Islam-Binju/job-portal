@extends('company.app')
@section('company_content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Garments Niyog</a></li>
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
                <div class="row mb-3">
                    <div class="col-md-3">
                        @if($candidate && $candidate->profile)
                            <img src="{{ asset($candidate->profile) }}" alt="Current Image" class="mt-2 rounded-circle" style="max-width: 100px;">
                        @else
                            <div class="mt-2 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width: 100px; height: 100px; background-color: #007bff; color: white; font-size: 36px; font-weight: bold;">
                                {{ strtoupper(substr($candidate->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Name En:</strong> {{$candidate->name}}
                    </div>
                    <div class="col-md-3">
                        <strong>Name Bn:</strong> {{$candidate->name_bn}}
                    </div>
                    <div class="col-md-3">
                        <strong>Email:</strong> {{$candidate->email}}
                    </div>
                    <div class="col-md-3">
                        <strong>Phone:</strong> {{$candidate->phone}}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Father Name En:</strong> {{$candidate->father_name}}
                    </div>
                    <div class="col-md-3">
                        <strong>Father Name Bn:</strong> {{$candidate->father_name_bn}}
                    </div>
                    <div class="col-md-3">
                        <strong>Mother Name:</strong> {{$candidate->mother_name}}
                    </div>
                    <div class="col-md-3">
                        <strong>Mother Name En:</strong> {{$candidate->mother_name_en}}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Nationality En:</strong> {{$candidate->nationality}}
                    </div>
                    <div class="col-md-3">
                        <strong>Nationality Bn:</strong> {{$candidate->nationality_bn}}
                    </div>
                    <div class="col-md-3">
                        <strong>Blood Group En:</strong> {{$candidate->blood_group}}
                    </div>
                    <div class="col-md-3">
                        <strong>Blood Group Bn:</strong> {{$candidate->blood_group_bn}}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>NID:</strong> {{$candidate->nid}}
                    </div>
                    <div class="col-md-3">
                        <strong>Birth Date:</strong> {{$candidate->dob}}
                    </div>
                    <div class="col-md-3">
                        <strong>Address En:</strong> {{$candidate->address}}
                    </div>
                    <div class="col-md-3">
                        <strong>Address Bn:</strong> {{$candidate->address_bn}}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>CV:</strong>  <a href="{{asset($candidate? $candidate->cv:'' )}}" target="_blank">Download CV</a>
                    </div>
                    <div class="col-md-3">
                        <strong>Resume:</strong> <a href="{{asset($candidate? $candidate->resume:'' )}}" target="_blank">Download Resume</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Candidate Education Information</h4>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <table class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Institute Name En</th>
                        <th>Institute Name Bn</th>
                        <th>Degree Name En</th>
                        <th>Degree Name Bn</th>
                        <th>Result</th>
                        <th>Passing Year</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($candidateEducation as $key=>$candidateEducationData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$candidateEducationData->institute_name}}</td>
                            <td>{{$candidateEducationData->institute_name_bn}}</td>
                            <td>{{$candidateEducationData->degree_name}}</td>
                            <td>{{$candidateEducationData->degree_name_bn}}</td>
                            <td>{{$candidateEducationData->result}}</td>
                            <td>{{$candidateEducationData->passing_year}}</td>
                         </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Candidate Experiences Information</h4>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <table class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Office Name En</th>
                        <th>Office Name Bn</th>
                        <th>Designation En</th>
                        <th>Designation Bn</th>
                        <th>Total Experiences</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($candidateExperiences as $key=>$candidateExperiencesData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$candidateExperiencesData->office_name}}</td>
                            <td>{{$candidateExperiencesData->office_name_bn}}</td>
                            <td>{{$candidateExperiencesData->designation}}</td>
                            <td>{{$candidateExperiencesData->designation_bn}}</td>
                            <td>{{$candidateExperiencesData->year_of_experience}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Candidate Skill Information</h4>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <table class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Skill Name En</th>
                        <th>Skill Name Bn</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($candidateSkill as $key=>$candidateSkillData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$candidateSkillData->name}}</td>
                            <td>{{$candidateSkillData->name_bn}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
