<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$user->name_bn}}</title>
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
        .no-pdf {
            display: block;
        }

        .no-pdf-hidden {
            display: none !important;
        }
        .contact-info a {
            word-wrap: break-word;
            word-break: break-word;
            white-space: normal;
            overflow-wrap: break-word;
        }
    </style>
</head>

<body>

<div class="container mt-5 printable">

    <div class="text-right mb-3">
        <button onclick="downloadPDF()" class="btn btn-primary no-pdf">ডাউনলোড পিডিএফ</button>
    </div>


    <!-- Header Section -->
    <div class="resume-header">
        <h2>{{$user->name_bn}}</h2>
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
                <h5 class="section-title">যোগাযোগের তথ্য</h5>
                <p><strong>ঠিকানা:</strong> {{$user->address_bn}}</p>
                <p><strong>ফোন:</strong> {{$user->phone}}</p>
                <p><strong>ইমেইল:</strong> <a href="#">{{$user->email}}</a></p>
            </div>



            <!-- Personal Information -->
            <div class="personal-info">
                <h5 class="section-title">ব্যক্তিগত তথ্য</h5>
                <p><strong>জন্ম তারিখ:</strong> {{$user->dob}}</p>
                <p><strong>পিতার নাম:</strong> {{$user->father_name_bn}}</p>
                <p><strong>মায়ের নাম:</strong> {{$user->mother_name_bn}}</p>
                <p><strong>জাতীয়তা:</strong> {{$user->nationality_bn}}</p>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-md-8">
            <!-- Summary -->
            <div class="skills">
                <h5 class="section-title">সারাংশ</h5>
                <p>{{$user->details_bn}}</p>
            </div>

            <!-- Skills -->
            <div class="skills">
                <h5 class="section-title">দক্ষতা</h5>
                <ul>
                    @foreach($skill as $skillData)
                    <li>{{$skillData->name_bn}}</li>
                    @endforeach
                </ul>
            </div>



            <!-- Experience -->
            <div class="experience">
                <h5 class="section-title">অভিজ্ঞতা</h5>
                <ul>
                    @foreach($experience as $experienceData)
                        <li>{{$experienceData->office_name_bn}} - {{$experienceData->designation_bn}}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Education -->
            <div class="education">
                <h5 class="section-title">শিক্ষা</h5>
                @foreach($education as $educationData)
                    <p><strong>{{$educationData->degree_name_bn}}</strong> - {{$educationData->institute_name_bn}}, {{$educationData->passing_year}}, GPA: {{$educationData->result}}</p>
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
        const button = document.querySelector('.no-pdf'); // Select the button to hide

        // Hide the button
        button.classList.add('no-pdf-hidden');

        const options = {
            margin: 0.5,
            filename: 'Resume.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
        };

        html2pdf()
            .set(options)
            .from(element)
            .save()
            .then(() => {
                // Show the button back after PDF generation
                button.classList.remove('no-pdf-hidden');
            });
    }

</script>

</body>

</html>
