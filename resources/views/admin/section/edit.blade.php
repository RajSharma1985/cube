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
                        <h3 class="box-title">Edit Section</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('section.update',$section->_id) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Section Name English <span style="color: red">*</span></label>
                                <input type="text" value="{{$section->section_lang['en_us']}}" class="form-control required"  name="section_name_en_us" placeholder="Enter Section Name In English">
                                @if ($errors->has('section_name_en_us'))
                                    <div class="error">{{ $errors->first('section_name_en_us') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Section Name Hindi <span style="color: red">*</span></label>
                                <input type="text" value="{{$section->section_lang['hindi']}}" class="form-control required"  name="section_name_hindi" placeholder="Enter Section Name In Hindi">
                                @if ($errors->has('section_name_hindi'))
                                    <div class="error">{{ $errors->first('section_name_hindi') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status <span style="color: red">*</span></label>
                                {{--<input type="text" class="form-control required"  name="section_name_en_us" placeholder="Enter Section Name In English">--}}
                                <select class="form-control" name="status">
                                    <option value="">Select Status</option>
                                    @foreach($status as $key=>$value)
                                        <option value="{{$key}}" {{ ( $key == $section->status) ? 'selected' : '' }}>{{$value}}</option>
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


