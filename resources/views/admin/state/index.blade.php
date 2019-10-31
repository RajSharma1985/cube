@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <!-- Main content -->
        <section class="content">
           <a href="{{ URL::to('state/create') }}" class="btn btn-primary btn-lg pull-right">Add State</a>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                          <th>SNo.</th>
                          <th>State Name</th>
                          <th>Country Name</th>
                          <th>Status</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($state as  $indexKey => $item)    
                        <tr>
                          <td>{{$indexKey + 1}}</td>
                          <td>{{$item->state}}</td>
                          <td>{{$item->getcountry->country}}</td>
                          <td>
                            <div class="checkbox">
                                    <input type="checkbox" checked data-toggle="toggle">
                            </div>  
                            </td>
                          <td> 
                            <a href="{{ route('state.edit', ['id' => $item->_id]) }}" class="btn btn-success btn-md">Edit</a></td>
                          <td><form action="{{ url('/state', ['id' => $item->id]) }}" method="post">
                                  <input class="btn btn-danger btn-md" type="submit" value="Delete" />
                                  @method('delete')
                                  @csrf
                              </form></td>
                        </tr>
                        @endforeach
                        </tbody>
                      </table>
                            {{ $state->links() }}
                    </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection


