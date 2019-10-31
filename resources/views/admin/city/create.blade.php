@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add City</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('city.store') }}" method="POST">
                        @csrf
                        <div class="box-body">
                                <div class="form-group">
                                        <label for="exampleInputEmail1">Country <span style="color: red">*</span></label>
                                        {{--<input type="text" class="form-control required"  name="section_name_en_us" placeholder="Enter Section Name In English">--}}
                                        <select class="form-control" name="country" onchange="getState(this.value)">
                                            <option value="">Select Country</option>
                                            @foreach($country as $key=>$value)
                                                <option value="{{$value->id}}">{{$value->country}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('country'))
                                            <div class="error">{{ $errors->first('country') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                            <label for="exampleInputEmail1">State <span style="color: red">*</span></label>
                                            {{--<input type="text" class="form-control required"  name="section_name_en_us" placeholder="Enter Section Name In English">--}}
                                            <select class="form-control" name="state">
                                                <option value="">Select State</option>
                                            </select>
                                            @if ($errors->has('state'))
                                                <div class="error">{{ $errors->first('state') }}</div>
                                            @endif
                                        </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">City <span style="color: red">*</span></label>
                                <input type="text" class="form-control required"  name="city" placeholder="Enter City Name">
                                @if ($errors->has('city'))
                                    <div class="error">{{ $errors->first('city') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status <span style="color: red">*</span></label>
                                {{--<input type="text" class="form-control required"  name="section_name_en_us" placeholder="Enter Section Name In English">--}}
                                <select class="form-control" name="status">
                                    <option value="">Select Status</option>
                                    @foreach($status as $key=>$value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('status'))
                                    <div class="error">{{ $errors->first('status') }}</div>
                                @endif
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                        <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->

                <!-- /.box -->

            </div>

        </section>
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script>
    $( document ).ready(function() {
        
     $('#section_id').change(function(){
        $('#subject_id option').remove();
        $('#topic_id option').remove();
        $('#sub_topic_id option').remove();
        $.ajax({
                url : '{{ route( 'getsubjects' ) }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "section_id": $(this).val()
                    },
                type: 'get',
                dataType: 'json',
                success: function( result )
                {
                   if(result.status == 'success'){
                    $('#subject_id').append($('<option>', {value:'', text:'Select Subject'}));
                     $.each( result.data, function(k, v) {
                         $('#subject_id').append($('<option>', {value:v._id, text:v.subject_name}));
                    });
                   }else{
                       alert(result.message);
                   }
                    
                },
                error: function()
                {
                    //handle errors
                    alert('error...');
                }
            });
   
        });

        $('#subject_id').change(function(){
        $('#sub_topic_id option').remove();
        $.ajax({
                url : '{{ route( 'gettopics' ) }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "subject_id": $(this).val()
                    },
                type: 'get',
                dataType: 'json',
                success: function( result )
                {
                    if(result.status == 'success'){
                    $('#topic_id').append($('<option>', {value:'', text:'Select Topics'}));
                     $.each( result.data, function(k, v) {
                         $('#topic_id').append($('<option>', {value:v._id, text:v.topic_name}));
                    });
                   }else{
                       alert(result.message);
                   }
                    
                },
                error: function()
                {
                    //handle errors
                    alert('error...');
                }
            });
   
        });

        $('#topic_id').change(function(){
        $('#sub_topic_id option').remove();
        $.ajax({
                url : '{{ route( 'getsubtopics' ) }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "topic_id": $(this).val()
                    },
                type: 'get',
                dataType: 'json',
                success: function( result )
                {
                    if(result.status == 'success'){
                    $('#sub_topic_id').append($('<option>', {value:'', text:'Select Sub Topics'}));
                     $.each( result.data, function(k, v) {
                         $('#sub_topic_id').append($('<option>', {value:v._id, text:v.sub_topic_name}));
                    });
                   }else{
                       alert(result.message);
                   }
                    
                },
                error: function()
                {
                    //handle errors
                    alert('error...');
                }
            });
   
        });
     });
    
    </script>
        <!-- /.content -->
    </div>
@endsection


