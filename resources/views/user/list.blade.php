@extends('backend.layouts.master')

@section('title')
   Registration List Page
@endsection

@section('admin-content')
    <div class="container-fluid">
        <div class="col-md-12">
            @include('backend.layouts.partials.message')
            <div class="card card-body">
             
                    <form action="get" id="search_result">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Applicant's Name</label>
                                    <input type="text" name="name"  class="form-control" id="name" aria-describedby="emailHelp">
                                  </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                                  </div>
                            </div>
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

                        <button type="submit"  class="btn btn-dark mt-3">Filter</button>
                    </form>
                   
             
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>User Registration List</h3>
                </div>
                <div class="card-body">
                    <table class="table  table-bordered" id="mailing_address">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Applicant's Name</th>
                                <th>Email Address</th>
                                <th>Division</th>
                                <th>District</th>
                                <th>Thana/Upozilla</th>
                                <th>Insert Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('custom-scripts')
   <script type="text/javascript">
            $(document).ready(function() {
                var t = $('#mailing_address').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: "{{ route('registration.list.ajax') }}",
                    "columnDefs": [{
                        "searchable": false,
                        "orderable": false,
                        "targets": 0
                    }],
                    "order": [
                        [1, 'asc']
                    ],
                    columns: [
                        {
                            "data": "mailing_id",
                            'name': "mailing_addresses.id",
                            'searchable': true,
                        },
                        {
                            "data": "_user_name",
                            'name': "user_name",
                            'searchable': true,
                        },
                        {
                            "data": "_user_email",
                            'name': "user_email",
                            'searchable': true,
                        },
                        {
                            "data": "_division",
                            'name': 'division',
                            'searchable': true,
                        },
                        {
                            "data": "_district",
                            "name": "district",
                            'searchable': true
                        },
                        {
                            "data": "_thana",
                            'name': 'thana',
                            'searchable': true,
                        },
                        {
                            "data": "_insert_date",
                            'name': 'insert_date',
                            'searchable': true,
                        },
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                });
                t.on('order.dt search.dt', function() {
                    t.column(0, {
                        search: 'applied',
                        order: 'applied'
                    }).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                        //t.cell(cell).invalidate('dom');
                    });
                }).draw();
            });
            $('#search_result').submit(function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var email = $('#email').val();
                var division_id = $('#division_id').val();
                var district_id = $('#district_id').val();
                var thana_id = $('#thana_id').val();

                actionUrl = "{{ route('registration.list.ajax') }}";
                var assign_table = $('#mailing_address').DataTable();
                assign_table.destroy();
                var t = $('#mailing_address').DataTable({
                    processing: true,
                    serverSide: true,
                    // searchable: true,
                    "columnDefs": [{
                        "searchable": false,
                        "orderable": false,
                        "targets": 0
                    }],
                    ajax: {
                        type: "get",
                        url: actionUrl,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "name": name,
                            "email": email,
                            "division_id": division_id,
                            "district_id": district_id,
                            "thana_id": thana_id,
                        }
                    },
                    "order": [
                        [1, 'asc']
                    ],
                    columns: [
                        {
                            "data": "mailing_id",
                            'name': "mailing_addresses.id",
                            'searchable': true,
                        },
                        {
                            "data": "_user_name",
                            'name': "user_name",
                            'searchable': true,
                        },
                        {
                            "data": "_user_email",
                            'name': "user_email",
                            'searchable': true,
                        },
                        {
                            "data": "_division",
                            'name': 'division',
                            'searchable': true,
                        },
                        {
                            "data": "_district",
                            "name": "district",
                            'searchable': true
                        },
                        {
                            "data": "_thana",
                            'name': 'thana',
                            'searchable': true,
                        },
                        {
                            "data": "_insert_date",
                            'name': 'insert_date',
                            'searchable': true,
                        },
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                });
                t.on('order.dt search.dt', function() {
                    t.column(0, {
                        search: 'applied',
                        order: 'applied'
                    }).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }).draw();
            });



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
        </script>
@endpush
