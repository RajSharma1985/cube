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
                        <h3 class="box-title">Add Country</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('country.store') }}" method="POST">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Country <span style="color: red">*</span></label>
                                <input type="text" class="form-control required"  name="country" placeholder="Enter Country">
                                @if ($errors->has('country'))
                                    <div class="error">{{ $errors->first('country') }}</div>
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
        <!-- /.content -->
    </div>
@endsection


