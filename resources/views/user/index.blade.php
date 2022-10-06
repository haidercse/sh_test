@extends('backend.layouts.master')

@section('title')
    Registration Page
@endsection

@section('admin-content')
    <div class="container-fluid">
        <div class="col-md-12">
            {{-- @include('backend.layouts.partials.message') --}}
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
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                        id="name">

                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                        id="email">

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
                                        <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-4">
                                <select name="district_id" class="custom-select" id="district_id">
                                    <option value="">Select District</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-4">
                                <select name="thana_id" class="custom-select" id="thana_id">
                                    <option value="">Select Thana</option>
                                    @foreach ($thanas as $thana)
                                        <option value="{{ $thana->id }}">{{ $thana->thana_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label"> Address Details</label>
                                <div class="col-sm-10">
                                    <textarea name="address" id="address" cols="10" rows="10" class="form-control" placeholder="Address...">{{ old('address') }}
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
                                            id="english">
                                        <label class="form-check-label" for="english">English</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group form-check mt-2">
                                        <input type="checkbox" name="language[]" value="B" class="form-check-input"
                                            id="bengali">
                                        <label class="form-check-label" for="bengali">Bengali</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group form-check mt-2">
                                        <input type="checkbox" name="language[]" value="F" class="form-check-input"
                                            id="french">
                                        <label class="form-check-label" for="french">French</label>
                                    </div>
                                </div>

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
                                        <tr>
                                            <td>
                                                <select class="custom-select" name="exam_id[]" id="exam_id">
                                                    <option value="">Select Exam</option>
                                                    @foreach ($exams as $exam)
                                                        <option value="{{ $exam->id }}">{{ $exam->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </td>
                                            <td>
                                                <select class="custom-select" name="university_id[]" id="university_id">
                                                    <option value="">Select University</option>
                                                    @foreach ($univercities as $univercity)
                                                        <option value="{{ $univercity->id }}">{{ $univercity->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </td>
                                            <td>
                                                <select class="custom-select" name="board_id[]" id="board_id">
                                                    <option value="">Select Board</option>

                                                    @foreach ($boards as $board)
                                                        <option value="{{ $board->id }}">{{ $board->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </td>
                                            <td>
                                                <input type="text" name="result" class="form-control">
                                            </td>
                                            <td>
                                                <span class="btn btn-success addeventmore" id="add_more">Add
                                                    More..</span>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="file_image" class="col-sm-2 col-form-label">Photo(Only Image)</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" class="form-control" id="file_image">
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="file_cv" class="col-sm-2 col-form-label">CV Attachment(Only
                                    PDF,DOCS)</label>
                                <div class="col-sm-10">
                                    <input type="file" name="cv" class="form-control" id="file_cv">
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
                                                    <input type="text" name="training_name[]" class=" form-control">

                                                </td>
                                                <td>
                                                    <input type="text" name="training_details[]"
                                                        class=" form-control">

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

            $("#submit_button").click(function(e) {
                e.preventDefault();

                var _token = $("input[name='_token']").val();
                var name = $("#name").val();
                var email = $("#email").val();
                var address = $("#address").val();
                var division_id = $("#division_id").val();
                var distrcit_id = $("#distrcit_id").val();
                var thana_id = $("#thana_id").val();
                var image = $("#file_image").val();
                var cv = $("#file_cv").val();


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

                var training_name = $('input[name="training_name[]"]').map(function() {
                    return this.value; // $(this).val()
                }).get();
                var training_details = $('input[name="training_details[]"]').map(function() {
                    return this.value; // $(this).val()
                }).get();
                
                
                $.ajax({
                    url: "{{ route('user.store') }}",
                    type: 'POST',
                    data: {
                        _token: _token,
                        name: name,
                        email: email,
                        address: address,
                        division_id: division_id,
                        distrcit_id: distrcit_id,
                        thana_id: thana_id,
                        image: image,
                        cv: cv,
                        exam_id: exam_id,
                        board_id: board_id,
                        university_id: university_id,
                        training_name: training_name,
                        training_details: training_details,
                    },
                    success: function(response) {
                       console.log(response.responseJSON.success);
                       alert(response.responseJSON.success);

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
                                        </td>
                                        <td>
                                            <select class="custom-select university_id" name="university_id[]" id="university_id_${counter}">
                                                <option value="">Select University</option>
                                               
                                            </select>
                                        </td>
                                        <td>
                                            <select class="custom-select board_id" name="board_id[]" id="board_id_${counter}">
                                                <option value="">Select Board</option>
                                               
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="result" class="form-control">
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
                                                    <input type="text" name="training_name[]" class=" form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="training_details[]" class=" form-control">
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
