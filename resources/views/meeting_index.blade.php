@extends('layouts.app')

@section('content')
<div class="row">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>List</h3>
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif

                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        create New Meeting
                    </button>
                </div>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Sr.no</th>
                            <th scope="col">Meeting ID</th>
                            <th scope="col">password</th>
                            <th scope="col">Topic</th>
                            <!-- <th scope="col">start_time</th> -->
                            <th scope="col">duration</th>
                            <th scope="col">created_date</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($meeting_tbl)
                        <?php $i = 1; ?>
                        @foreach($meeting_tbl as $val)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$val->meeting_id}}</td>
                            <td>{{$val->password}}</td>
                            <td>{{$val->topic}}</td>
                            <!-- <td>{{ date('H:i:s A',strtotime($val->start_time))}}</td> -->
                            <td>{{$val->duration}}min</td>
                            <td>{{date('d-m-Y',strtotime($val->created_date))}}</td>
                            <td>
                                <a href='{{url("meeting/start/$val->meeting_id")}}'><button type="button"
                                        class="btn btn-warning btn-xs" title="Start Meeting"><i
                                            class="fa fa-pencil"></i>Start
                                        Meeting</button></a>
                                <a href='{{url("delete/meeting/$val->meeting_id")}}'
                                    onClick="return confirm('Are you sure you want to delete?')"><button type="button"
                                        class="btn btn-danger btn-xs" title="Delete"><i
                                            class="fa fa-trash"></i>Remove</button></a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" action="{{url('create/meeting/add')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Topic</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="topic" placeholder="Enter topic" name="topic">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Agenda</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="agenda" placeholder="Enter Agenda"
                                name="agenda">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">start_date</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="start_date"
                                placeholder="Enter start_date" name="start_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">duration</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="duration" placeholder="Enter example like 10"
                                name="duration">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="password" placeholder="Enter password"
                                name="password">
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div> -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection