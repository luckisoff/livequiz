@extends('layouts.admin')

@section('title', 'Quiz Groups')

@section('content-header', 'Quiz Groups')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><i class="fa fa-suitcase"></i> Quiz Groups</li>
@endsection

@section('content')

@include('notification.notify')
	<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
            <div class="box-tools pull-right">
            		<a href="{{route('admin.questionset.create')}}" class="btn btn-default pull-right">Add Quiz</a>
            </div>
            <br>
        </div>
        <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>SN.</th>
                        <th>Title</th>
                        <th>Starts At</th>
                        <th>Ends At</th>
                        <th>Sponsor</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sets as $key => $set)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$set->name}}</td>
                            <td>{{$set->start}}</td>
                            <td>{{$set->end}}</td>
                            <td>{{$set->sponsor?$set->sponsor->name:'None'}}</td>
                            <td>{{$set->status}}</td>
                            <td>
                                <ul class="admin-action btn btn-default pull-right">
                                    <li class="dropup">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        action <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="{{route('admin.questionset.create' , $set->id)}}">Edit</a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" onclick="return confirm('Are you sure?')" href="{{route('admin.questionset.delete' ,$set->id)}}">Delete</a>
                                        </li>

                                    </ul>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $sets->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection