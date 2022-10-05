@extends('backend.layouts.master')

@section('title')
    Edit Page
@endsection

@section('admin-content')
    <div class="container-fluid">
        <div class="col-md-12">
            @include('backend.layouts.partials.message')
            <div class="card">
                <div class="card-header">
                    <h3>User Update Form</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('registration.update', $mailing_address->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mailing_address_id" value="{{ $mailing_address->id }}">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Applicant's Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{ $mailing_address->user->name }}"
                                        class="form-control" id="name">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" value="{{ $mailing_address->user->email }}"
                                        class="form-control" id="email">
                                </div>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-4">
                                <select name="division_id" class="custom-select" id="division_id">
                                    <option value="">Select Division</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}"
                                            {{ $division->id == $mailing_address->division->id ? 'selected' : '' }}>
                                            {{ $division->division_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="district_id" class="custom-select" id="district_id">
                                    <option value="">Select District</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"
                                            {{ $district->id == $mailing_address->district->id ? 'selected' : '' }}>
                                            {{ $district->district_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="thana_id" class="custom-select" id="thana_id">
                                    <option value="">Select Thana</option>
                                    @foreach ($thanas as $thana)
                                        <option value="{{ $thana->id }}"
                                            {{ $thana->id == $mailing_address->thana->id ? 'selected' : '' }}>
                                            {{ $thana->thana_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>

                        <button type="submit" class="btn btn-success">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script type="text/javascript">
        
        $("#division_id").on('click', function() {
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
    </script>
@endpush
