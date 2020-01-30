@extends('layouts.admin')

@section('title', 'Questions')

@section('content-header', 'Questions')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><i class="fa fa-suitcase"></i> Questions</li>
@endsection

@section('content')

@include('notification.notify')
	<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
            <div class="box-tools pull-right">
            		<a href="{{route('admin.question.create')}}" class="btn btn-default pull-right">Add Question</a>
            </div>
            <br>
        </div>
        <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>SN.</th>
                        <th>Title</th>
                        <!-- <th>Group</th> -->
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $key => $question)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$question->name}}</td>
                            <!-- <td>{{$question->group}}</td> -->
                            <td>
                                <ul class="admin-action btn btn-default pull-right">
                                    <li class="dropup">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        action <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="{{route('admin.question.create' , $question->id)}}">Edit</a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" onclick="return confirm('Are you sure?')" href="{{route('admin.question.delete' ,$question->id)}}">Delete</a>
                                        </li>

                                    </ul>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $questions->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection