@extends('backend.layouts.master')

@section('title')
    Registration Page
@endsection

@section('admin-content')
    <div class="container-fluid">
        <div class="col-md-12">
            {{-- @include('backend.layouts.partials.message') --}}
            <p id="success_message" class="alert alert-success" style="display: none;">All Data Updated Successfully.</p>
            <div class="alert alert-danger print-error-msg mt-2" style="display:none">
                <ul></ul>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>User Registration Form</h3>
                </div>
                <div class="card-body">
                    {{-- action="{{ route('user.store') }}" --}}
                    <form method="POST" enctype="multipart/form-data" id="registration_form">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Applicant's Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                                        id="name">
                                    <p style="display: none; color:red" id="error_name">Please Input Your Name
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                        id="email">
                                    <p style="display: none; color:red" id="error_email">Please Input Your Email
                                    </p>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <h2>Mailing Address</h2>
                        <hr>
                        <div class="row my-2">
                            <div class="col-md-4">
                                <select name="division_id" class="custom-select" id="division_id">
                                    <option value="">Select Division</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}"
                                            {{ $mailing_address->division->id == $division->id ? 'selected' : '' }}>
                                            {{ $division->division_name }}</option>
                                    @endforeach
                                </select>
                                <p style="display: none;color:red" id="error_division_id">Please Select
                                    Division</p>
                            </div>

                            <div class="col-md-4">
                                <select name="district_id" class="custom-select" id="district_id">
                                    <option value="">Select District</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"
                                            {{ $mailing_address->district->id == $district->id ? 'selected' : '' }}>
                                            {{ $district->district_name }}</option>
                                    @endforeach
                                </select>
                                <p style="display: none; color:red" id="error_district_id">Please Select
                                    District</p>
                            </div>
                            <div class="col-md-4">
                                <select name="thana_id" class="custom-select" id="thana_id">
                                    <option value="">Select Thana</option>
                                    @foreach ($thanas as $thana)
                                        <option value="{{ $thana->id }}"
                                            {{ $mailing_address->thana->id == $thana->id ? 'selected' : '' }}>
                                            {{ $thana->thana_name }}</option>
                                    @endforeach
                                </select>
                                <p style="display: none;color:red" id="error_thana_id">Please Select
                                    UpoZilla/Thana</p>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label"> Address Details</label>
                                <div class="col-sm-10">
                                    <textarea name="address" id="address" cols="10" rows="10" class="form-control" placeholder="Address...">{{ $user->address }}
                                    </textarea>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row ">
                                <label for="name" class="col-sm-2 col-form-label">Language Proficiency</label>
                                <div class="col-sm-2">
                                    <div class="form-group form-check mt-2">
                                        <input type="checkbox" name="language[]" value="E" class="form-check-input"
                                            id="english" @if (in_array('E', $languages)) checked @endif>
                                        <label class="form-check-label" for="english">English</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group form-check mt-2">
                                        <input type="checkbox" name="language[]" value="B" class="form-check-input"
                                            id="bengali" @if (in_array('B', $languages)) checked @endif>
                                        <label class="form-check-label" for="bengali">Bengali</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group form-check mt-2">
                                        <input type="checkbox" name="language[]" value="F" class="form-check-input"
                                            id="french" @if (in_array('F', $languages)) checked @endif>
                                        <label class="form-check-label" for="french">French</label>
                                    </div>
                                </div>
                                <p style="display: none; color:red" id="error_language">Please Select Any Or multiple
                                    Language</p>
                            </div>
                        </div>
                        <hr>
                        <h3>Education Qualification</h3>
                        <hr>
                        <div>
                            <div class="col-md-12">
                                <table class="table  table-bordered" id="add_item">
                                    <thead>
                                        <tr>
                                            <th>Exam Name</th>
                                            <th>University</th>
                                            <th>Board</th>
                                            <th>Result</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="student_exam_info">
                                        @foreach ($education_qualifications as $item)
                                       
                                            <tr>
                                                <td>
                                                    <select class="custom-select" name="exam_id[]" id="exam_id_0">
                                                        <option value="">Select Exam</option>
                                                        @foreach ($exams as $exam)
                                                     
                                                            <option value="{{ $exam->id }}" {{ $item->exam->id == $exam->id ? 'selected' : '' }}>{{ $exam->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <p style="display: none; color:red" id="error_exam_id_0">Please Select
                                                        Your Exam</p>

                                                </td>
                                                <td>
                                                    <select class="custom-select" name="university_id[]"
                                                        id="university_id_0">
                                                        <option value="">Select University</option>
                                                        @foreach ($univercities as $univercity)
                                                            <option value="{{ $univercity->id }}" {{ $item->university->id == $univercity->id ? 'selected' : '' }}>{{ $univercity->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <p style="display: none; color:red" id="error_university_id_0">Please
                                                        Select
                                                        Your University</p>
                                                </td>
                                                <td>
                                                    <select class="custom-select" name="board_id[]" id="board_id_0">
                                                        <option value="">Select Board</option>

                                                        @foreach ($boards as $board)
                                                            <option value="{{ $board->id }}" {{ $item->board->id == $board->id ? 'selected' : '' }}>{{ $board->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <p style="display: none; color:red" id="error_board_id_0">Please
                                                        Select
                                                        Your Board</p>
                                                </td>
                                                <td>
                                                    <input type="text" id="result_0" name="result[]"
                                                        class="form-control" value="{{ $item->result }}">
                                                    <p style="display: none; color:red" id="error_result_0">Please Input
                                                        Your Result</p>
                                                </td>
                                                <td>
                                                    <span class="btn btn-success addeventmore" id="add_more">Add
                                                        More..</span>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="file_image" class="col-sm-2 col-form-label">Photo(Only Image)</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" class="form-control" id="file_image">
                                    <p style="display: none; color:red" id="error_image">Please attach your picture</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="file_cv" class="col-sm-2 col-form-label">CV Attachment(Only
                                    PDF,DOCS)</label>
                                <div class="col-sm-10">
                                    <input type="file" name="cv" class="form-control" id="file_cv">
                                    <p style="display: none; color:red" id="error_cv">Please attach your CV</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row ">
                                <label for="name" class="col-sm-2 col-form-label">Training</label>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                            id="yes" value="option1">
                                        <label class="form-check-label" for="yes">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                            id="no" value="option2">
                                        <label class="form-check-label" for="no">
                                            No
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12" id="add_training" style="display: none">
                            <div class="form-group row">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <table class="table  table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Training Name</th>
                                                <th>Training Details</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="training">
                                            <tr>
                                                <td>
                                                    <input type="text" name="training_name[]" class=" form-control"
                                                        id="training_name_0">
                                                    <p style="display: none; color:red" id="error_training_name_0">Please
                                                        Input
                                                        Your Training Name</p>
                                                </td>
                                                <td>
                                                    <input type="text" name="training_details[]" class=" form-control"
                                                        id="training_details_0">
                                                    <p style="display: none; color:red" id="error_training_details_0">
                                                        Please Input
                                                        Your Training Details</p>
                                                </td>

                                                <td>
                                                    <span class="btn btn-success addeventmore_training">Add</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success" id="submit_button">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $("#registration_form").submit(function(e) {
                e.preventDefault();


                var _token = $("input[name='_token']").val();
                var name = $("#name").val();
                var email = $("#email").val();
                var address = $("#address").val();
                var division_id = $("#division_id").val();
                var district_id = $("#district_id").val();
                var thana_id = $("#thana_id").val();


                var image = $('input[name=image]').val()

                var image_extension = image.substr((image.lastIndexOf('.') + 1));
                if (image !== '') {
                    if (image_extension == 'jpg' || image_extension == 'png' || image_extension == 'jpeg') {
                        var image = image.replace(/C:\\fakepath\\/, '');
                    } else {
                        alert('Please Submit only image jpg,png,jepg');
                        return;
                    }
                }

                var cv = $('input[name=cv]').val();
                var cv_extension = cv.substr((cv.lastIndexOf('.') + 1));
                if (cv !== '') {
                    if (cv_extension == 'pdf' || cv_extension == 'doc' || cv_extension == 'docx') {
                        var cv = cv.replace(/C:\\fakepath\\/, '');
                    } else {
                        alert('Please Submit only PDF,DOC,DOCX File');
                        return;
                    }
                }

                var exam_id = $("select[name=\'exam_id[]\']")
                    .map(function() {
                        return $(this).val();
                    }).get();

                var board_id = $("select[name=\'board_id[]\']")
                    .map(function() {
                        return $(this).val();
                    }).get();
                var university_id = $("select[name=\'university_id[]\']")
                    .map(function() {
                        return $(this).val();
                    }).get();

                var result = $('input[name="result[]"]').map(function() {
                    return this.value; // $(this).val()
                }).get();


                var language = $('input[name="language[]"]:checked').map(function() {
                    return this.value; // $(this).val()
                }).get();

                var training_name = $('input[name="training_name[]"]').map(function() {
                    return this.value; // $(this).val()
                }).get();
                var training_details = $('input[name="training_details[]"]').map(function() {
                    return this.value; // $(this).val()
                }).get();


                //frontend validation
                if (name == '') {
                    $("#error_name").css('display', 'block');

                } else {
                    $("#error_name").css('display', 'none');
                }

                if (email == '') {
                    $("#error_email").css('display', 'block');
                } else {
                    $("#error_email").css('display', 'none');
                }

                if (division_id == '') {
                    $("#error_division_id").css('display', 'block');
                } else {
                    $("#error_division_id").css('display', 'none');
                }


                if (district_id == '') {
                    $("#error_district_id").css('display', 'block');
                } else {
                    $("#error_district_id").css('display', 'none');
                }
                if (thana_id == '') {
                    $("#error_thana_id").css('display', 'block');
                } else {
                    $("#error_thana_id").css('display', 'none');
                }

                if (image == '') {
                    $("#error_image").css('display', 'block');
                } else {
                    $("#error_image").css('display', 'none');
                }

                if (cv == '') {
                    $("#error_cv").css('display', 'block');
                } else {
                    $("#error_cv").css('display', 'none');
                }

                if (language == '') {
                    $("#error_language").css('display', 'block');
                } else {
                    $("#error_language").css('display', 'none');
                }

                var exam_length = exam_id.length;

                for (var i = 0; i < exam_length; i++) {
                    if ($("#exam_id_" + i).val() == '') {
                        if ($('#error_exam_id_' + i)) {
                            $("#error_exam_id_" + i).css('display', 'block');
                        }
                    } else {
                        if ($('#error_exam_id_' + i)) {
                            $("#error_exam_id_" + i).css('display', 'none');
                        }
                    }
                }

                var board_length = board_id.length;

                for (var i = 0; i < board_length; i++) {
                    if ($("#board_id_" + i).val() == '') {
                        if ($('#error_board_id_' + i)) {
                            $("#error_board_id_" + i).css('display', 'block');
                        }
                    } else {
                        if ($('#error_board_id_' + i)) {
                            $("#error_board_id_" + i).css('display', 'none');
                        }
                    }

                }

                var university_length = university_id.length;
                for (var i = 0; i < university_length; i++) {
                    if ($("#university_id_" + i).val() == '') {
                        if ($('#error_university_id_' + i)) {
                            $("#error_university_id_" + i).css('display', 'block');
                        }
                    } else {
                        if ($('#error_university_id_' + i)) {
                            $("#error_university_id_" + i).css('display', 'none');
                        }
                    }

                }
                var result_length = result.length;
                for (var i = 0; i < result_length; i++) {
                    if ($("#result_" + i).val() == '') {
                        if ($('#error_result_' + i)) {
                            $("#error_result_" + i).css('display', 'block');
                        }
                    } else {
                        if ($('#error_result_' + i)) {
                            $("#error_result_" + i).css('display', 'none');
                        }
                    }

                }
                var training_name_length = training_name.length;
                for (var i = 0; i < training_name_length; i++) {
                    if ($("#training_name_" + i).val() == '') {
                        if ($('#error_training_name_' + i)) {
                            $("#error_training_name_" + i).css('display', 'block');
                        }
                    } else {
                        if ($('#error_training_name_' + i)) {
                            $("#error_training_name_" + i).css('display', 'none');
                        }
                    }
                }

                var training_details_length = training_details.length;
                for (var i = 0; i < training_details_length; i++) {
                    if ($("#training_details_" + i).val() == '') {
                        if ($('#error_training_details_' + i)) {
                            $("#error_training_details_" + i).css('display', 'block');
                        }
                    } else {
                        if ($('#error_training_details_' + i)) {
                            $("#error_training_details_" + i).css('display', 'none');
                        }
                    }
                }
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('registration.update') }}",
                    type: 'POST',
                    dataType: "JSON",
                    contentType: false,
                    processData: false,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    // data: {
                    //     _token: _token,
                    //     name: name,
                    //     email: email,
                    //     address: address,
                    //     division_id: division_id,
                    //     district_id: district_id,
                    //     thana_id: thana_id,
                    //     language: language,
                    //     image: image,
                    //     cv: cv,
                    //     exam_id: exam_id,
                    //     board_id: board_id,
                    //     university_id: university_id,
                    //     training_name: training_name,
                    //     training_details: training_details,
                    // },
                    success: function(response) {
                        // console.log(response.responseJSON.success);
                        $("#success_message").css('display', 'block');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);

                    },
                    error: function(response) {
                        console.log(response.responseJSON.errors);

                        $(".print-error-msg").find("ul").html('');
                        $(".print-error-msg").css('display', 'block');
                        $.each(response.responseJSON.errors, function(key, value) {
                            $(".print-error-msg").find("ul").append('<li>' + value +
                                '</li>');
                        });

                    }
                });

            });


        });


        var counter = 1;
        var counter_training = 1;
        $(document).on("click", ".addeventmore", function() {
            var whole_extra_item_add = '';
            whole_extra_item_add += `
                <tr class="delete_whole_extra_item_add">
                                        <td>
                                            <select class="custom-select exam_id" name="exam_id[]" id="exam_id_${counter}">
                                                <option value="">Select Exam</option>
                                               
                                            </select>
                                            <p style="display: none; color:red" id="error_exam_id_${counter}">Please Select Your Exam</p>
                                        </td>
                                        <td>
                                            <select class="custom-select university_id" name="university_id[]" id="university_id_${counter}">
                                                <option value="">Select University</option>
                                               
                                            </select>
                                            <p style="display: none; color:red" id="error_university_id_${counter}">Please Select
                                                    Your University</p>
                                        </td>
                                        <td>
                                            <select class="custom-select board_id" name="board_id[]" id="board_id_${counter}">
                                                <option value="">Select Board</option>
                                            </select>
                                            <p style="display: none; color:red" id="error_board_id_${counter}">Please Select
                                                    Your Board</p>
                                        </td>
                                        <td>
                                            <input type="text" name="result[]" id="result_${counter}" class="form-control">
                                            <p style="display: none; color:red" id="error_result_${counter}">Please Input
                                                    Your Result</p>
                                        </td>
                                        <td>
                                            <span class="btn btn-success addeventmore " id="add_more">Add</span>
                                            <span class="btn btn-danger removeeventmore">Delete</span>
                                        </td>
                                    </tr>
                                </div>   
                
                `;
            tableBody = $("#student_exam_info");
            tableBody.append(whole_extra_item_add);
            // $(".add_item").append(whole_extra_item_add);
            counter++;
        });

        $(document).on("click", ".removeeventmore", function(event) {
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".delete_whole_extra_item_add").remove();
            counter -= 1;
        });

        $(document).on("click", ".addeventmore_training", function() {
            var whole_extra_item_add_training = '';
            whole_extra_item_add_training += `
                 <tr class="delete_whole_extra_item_add_training">
                                                <td>
                                                    <input type="text" name="training_name[]" class=" form-control" id="training_name_${counter}">
                                                    <p style="display: none; color:red" id="error_training_name_${counter}">Please Input
                                                    Your Training Name</p>
                                                </td>
                                                <td>
                                                    <input type="text" name="training_details[]" class=" form-control" id="training_details_${counter}">
                                                    <p style="display: none; color:red" id="error_training_details_${counter}">Please Input
                                                    Your Training Details</p>
                                                </td>

                                                <td>
                                                    <span class="btn btn-success addeventmore_training">Add</span>
                                                    <span class="btn btn-danger  removeeventmore_training">Delete</span>
                                                </td>
                                            </tr>
                
                `;
            tableBody_training = $("#training");
            tableBody_training.append(whole_extra_item_add_training);
            counter_training++;
        });

        $(document).on("click", ".removeeventmore_training", function(event) {
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".delete_whole_extra_item_add_training").remove();
            counter_training -= 1;
        });



        // form submit by ajax

        //yes no
        var yes = $("#yes").click(function() {

            $("#add_training").css("display", "block");
        })
        var no = $("#no").click(function() {

            $("#add_training").css("display", "none");
        })


        $("#division_id").change(function() {
            get_district_by_division();

        })
        //get district by division id
        function get_district_by_division() {
            var division_id = $("#division_id").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var APP_URL = "{{ route('get_all_district') }}";
            $.ajax({
                type: "GET",
                url: APP_URL,
                dataType: "JSON",
                data: {
                    division_id: division_id,

                },
                success: function(data) {
                    $("#district_id").html('');
                    var op = '<option value="" >Select District</option>';
                    for (var i = 0; i < data.length; i++) {
                        op += '<option value="' + data[i].id + '">' + data[i].district_name + '</option>';
                    }
                    $("#district_id").html(op);
                },
                error: function() {
                    $("#district_id").html('');
                    var op = '<option value="" >Select District</option>';
                    $("#district_id").html(op);
                }
            });
        }

        //thana
        $("#district_id").change(function() {
            get_thana_by_district();

        })
        //get district by division id
        function get_thana_by_district() {
            var district_id = $("#district_id").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var APP_URL = "{{ route('get_all_thana') }}";
            $.ajax({
                type: "GET",
                url: APP_URL,
                dataType: "JSON",
                data: {
                    district_id: district_id,

                },
                success: function(data) {
                    $("#thana_id").html('');
                    var op = '<option value="" >Select Thana</option>';
                    for (var i = 0; i < data.length; i++) {
                        op += '<option value="' + data[i].id + '">' + data[i].thana_name + '</option>';
                    }
                    $("#thana_id").html(op);
                },
                error: function() {
                    $("#thana_id").html('');
                    var op = '<option value="" >Select Thana</option>';
                    $("#thana_id").html(op);
                }
            });
        }

        $("#add_more").click(function() {
            get_all_exam();
            get_all_university();
            get_all_board();
        })

        function get_all_exam(id) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var APP_URL = "{{ route('get_all_exam') }}";
            $.ajax({
                type: "GET",
                url: APP_URL,
                dataType: "JSON",

                success: function(data) {
                    $(".exam_id").html('');
                    var op = '<option value="" >Select Exam</option>';
                    for (var i = 0; i < data.length; i++) {
                        op += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                    }
                    $(".exam_id").html(op);
                },
                error: function() {
                    $(".exam_id").html('');
                    var op = '<option value="" >Select Exam</option>';
                    $(".exam_id").html(op);
                }
            });
        }

        function get_all_board() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var APP_URL = "{{ route('get_all_board') }}";
            $.ajax({
                type: "GET",
                url: APP_URL,
                dataType: "JSON",

                success: function(data) {
                    $(".board_id").html('');
                    var op = '<option value="" >Select Board</option>';
                    for (var i = 0; i < data.length; i++) {
                        op += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                    }
                    $(".board_id").html(op);
                },
                error: function() {
                    $(".board_id").html('');
                    var op = '<option value="" >Select Board</option>';
                    $(".board_id").html(op);
                }
            });
        }

        function get_all_university(id) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var APP_URL = "{{ route('get_all_university') }}";
            $.ajax({
                type: "GET",
                url: APP_URL,
                dataType: "JSON",

                success: function(data) {
                    $(".university_id").html('');
                    var op = '<option value="" >Select University</option>';
                    for (var i = 0; i < data.length; i++) {
                        op += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                    }
                    $(".university_id").html(op);
                },
                error: function() {
                    $(".university_id").html('');
                    var op = '<option value="" >Select University</option>';
                    $(".university_id").html(op);
                }
            });
        }
    </script>
@endpush
