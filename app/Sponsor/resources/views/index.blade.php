@extends('layouts.admin')

@section('title', 'Sponsors')

@section('content-header', 'Sponsors')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><i class="fa fa-suitcase"></i> Sponsors</li>
@endsection

@section('content')

@include('notification.notify')
	<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
            <div class="box-tools pull-right">
            		<a href="{{route('admin.sponsor.create')}}" class="btn btn-default pull-right">Add Sponsor</a>
            </div>
            <br>
        </div>
        <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>SN.</th>
                        <th>Sponsor Name</th>
                        <th>Sponsor Logo</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sponsors as $key => $sponsor)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$sponsor->name}}</td>
                            <td>
                                <img src="{{$sponsor->logo}}" alt="{{$sponsor->name}}" class="img-responsive" style="width:50px">
                            </td>
                            <td>
                                <ul class="admin-action btn btn-default pull-right">
                                    <li class="dropup">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        action <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="{{route('admin.sponsor.create' , $sponsor->id)}}">Edit</a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" onclick="return confirm('Are you sure?')" href="{{route('admin.sponsor.delete' ,$sponsor->id)}}">Delete</a>
                                        </li>

                                    </ul>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $sponsors->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection