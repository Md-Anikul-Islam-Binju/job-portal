<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$user->name}}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .section-title {
            background-color: #f0f8ff;
            padding: 10px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .resume-header {
            background-color: #e8f4fc;
            padding: 15px;
            text-align: center;
        }

        .contact-info, .personal-info, .skills, .projects, .education, .experience, .certificates {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #ffffff;
        }

        .profile-image {
            width: 200px;
            height: 200px;;
            border-radius: 50%;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<div class="container mt-5 printable">

    <div class="text-right mb-3">
        <button onclick="downloadPDF()" class="btn btn-primary">Download as PDF</button>
    </div>

    <!-- Header Section -->
    <div class="resume-header">
        <h2>{{$user->name}}</h2>
    </div><br>

    <div class="row">
        <!-- Left Column -->
        <div class="col-md-4">
            <!-- Profile Image -->
            <div class="text-center">
                <img src="{{asset($user? $user->profile:'' )}}" alt="Profile Image" class="profile-image">
            </div>

            <!-- Contact Information -->
            <div class="contact-info">
                <h5 class="section-title">Contact Information</h5>
                <p><strong>Address:</strong> {{$user->address}}</p>
                <p><strong>Phone:</strong>{{$user->phone}}</p>
                <p><strong>Email:</strong> <a href="#">{{$user->email}}</a></p>
            </div>


            <!-- Personal Information -->
            <div class="personal-info">
                <h5 class="section-title">Personal Information</h5>
                <p><strong>Date of Birth:</strong>{{$user->dob}}</p>
                <p><strong>Father's Name:</strong>{{$user->father_name}}</p>
                <p><strong>Mother's Name:</strong> {{$user->mother_name}}</p>
                <p><strong>Nationality:</strong>{{$user->nationality}}</p>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-md-8">
            <!-- Summary -->
            <div class="skills">
                <h5 class="section-title">Summary</h5>
                <p>{{$user->details}}</p>
            </div>

            <!-- Skills -->
            <div class="skills">
                <h5 class="section-title">Skill Highlights</h5>
                <ul>
                    @foreach($skill as $skillData)
                        <li>{{$skillData->name}}</li>
                    @endforeach
                </ul>
            </div>


            <!-- Experience -->
            <div class="experience">
                <h5 class="section-title">Experience</h5>
                <ul>
                    @foreach($experience as $experienceData)
                        <li>{{$experienceData->office_name}} - {{$experienceData->designation}}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Education -->
            <div class="education">
                <h5 class="section-title">Education</h5>
                @foreach($education as $educationData)
                    <p><strong>{{$educationData->degree_name}}</strong> - {{$educationData->institute_name}}, {{$educationData->passing_year}}, GPA: {{$educationData->result}}</p>
                @endforeach
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script>
    function downloadPDF() {
        const element = document.querySelector('.printable'); // Select the content to convert to PDF
        const options = {
            margin:       0.5,
            filename:     'Resume.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
        };
        html2pdf().set(options).from(element).save();
    }
</script>

</body>

</html>
