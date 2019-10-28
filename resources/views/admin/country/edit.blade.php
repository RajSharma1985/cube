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
                        <h3 class="box-title">Edit Country</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('country.update',$country->_id) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Country Name <span style="color: red">*</span></label>
                                <input type="text" value="{{$country->country}}" class="form-control required"  name="country" placeholder="Enter Country Name">
                                @if ($errors->has('country'))
                                    <div class="error">{{ $errors->first('country') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status <span style="color: red">*</span></label>
                                <select class="form-control" name="status">
                                    <option value="">Select Status</option>
                                    @foreach($status as $key=>$value)
                                        <option value="{{$key}}" {{ ( $key == $country->status) ? 'selected' : '' }}>{{$value}}</option>
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
                        <button type="submit" class="btn btn-primary">Update</button>
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


