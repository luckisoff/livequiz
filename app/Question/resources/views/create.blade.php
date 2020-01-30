@extends('layouts.admin')

@section('title', $question?'Update question':'Create question')

@section('content-header',  $question?'Update question':'Create question')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>home</a></li>
    <li class="active"><i class="fa fa-camera"></i>{{$question?'Update':'Create'}} question</li>
@endsection

@section('content')

    <div class="row">

    @include('notification.notify')
    
    <div class="col-md-12">
        <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">
                    <!-- <li class="active"><a href="#general" data-toggle="tab">General</a></li> -->
                </ul>
               
                <div class="tab-content">
                   
                    <div class="active tab-pane" id="general">
                      
                        <form id="form-upload" action="{{route('admin.question.store',$question?$question:'')}}" method="POST" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="box-body">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sitename">Question *</label>
                                        <input type="text" class="form-control" name="question_english" id="question_english" placeholder="Enter question in english" value="{{$question?$question->name:''}}"><br>
                                        <input type="text" class="form-control" name="question_nepali" id="question_nepali" placeholder="Enter question in nepali" value="{{$question?$question->conversions->name:''}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sitename">Question Group *</label>
                                        <select name="question_set_id" id="question_set_id" class="form-control">
                                            <option value="">Select</option>
                                            @foreach($sets as $set)
                                            <option value="{{$set->id}}" {{$question&&$question->group->id==$set->id?'selected':''}}>{{$set->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sitename">Difficulty *</label>
                                        <select name="level" id="level" class="form-control">
                                            <option value="">Select</option>
                                            @for($i=1;$i<=15;$i++)
                                            <option value="{{$i}}" {{$question&&$question->level==$i?'selected':''}}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                <label for="Options">Options *</label>
                                </div>
                                @if($question)
                                    @foreach($question->options as $key=>$option)
                                        <div class="col-sm-6">
                                                <div class="form-group" style="padding-left:20px;">
                                                    <input type="text"
                                                        class="form-control"
                                                        id="option{{$key}}"
                                                        name="options[{{$key}}]"
                                                        placeholder="Option {{$key+1}} in English*"
                                                        value="{{$option->name}}"
                                                        required="true"/>
                                                </div>
                                                <div class="form-group" style="padding-left:20px;">
                                                    <input type="text"
                                                        class="form-control"
                                                        id="option_nepali{{$key}}"
                                                        name="options_nepali[{{$key}}]"
                                                        placeholder="Option {{$key+1}} in Nepali*"
                                                        value="{{$option->conversions->name}}"
                                                        required="true"/>
                                                </div>

                                                <div class="radio" style="position:absolute;left:0;top:10px;">
                                                    <label title="Answer">
                                                    <input type="radio" name="answer" value="{{$key}}" required {{$option->answer==1?'checked':''}}> 
                                                    </label>
                                                </div>
                                            </div>
                                    @endforeach
                                @else
                                    @for($i=0;$i<4;$i++)
                                        <div class="col-sm-6">
                                            <div class="form-group" style="padding-left:20px;">
                                                <input type="text"
                                                    class="form-control"
                                                    id="option{{$i}}"
                                                    name="options[{{$i}}]"
                                                    placeholder="Option {{$i+1}} in English*"
                                                    required="true"/>
                                            </div>
                                            <div class="form-group" style="padding-left:20px;">
                                                <input type="text"
                                                    class="form-control"
                                                    id="option_nepali{{$i}}"
                                                    name="options_nepali[{{$i}}]"
                                                    placeholder="Option {{$i+1}} in Nepali*"
                                                    required="true"/>
                                            </div>

                                            <div class="radio" style="position:absolute;left:0;top:10px;">
                                                <label title="Answer">
                                                <input type="radio" name="answer" value="{{$i}}" required>
                                                </label>
                                            </div>
                                        </div>
                                    @endfor
                                @endif

                          </div>
                          <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">{{$question?'Update':'Create'}}</button>
                        </div>
                        </form>

                          
                    </div>
                </div>

            </div>
           
        </div>
</div>
    </div>
@endsection