@extends('layouts.app')

@section('htmlheader_title')
    {{$team->collection->name}}
@endsection


@section('main-content')
    <div class="page control" >
        <div class="box full-height left">
            <div class="box-header seperation-border" style="height: 50px;">
                <i class="fa fa-users" style="line-height: 30px; display:block;text-align:center;"></i>
            </div>
            <div class="slimScrollDiv" style="position: relative; ovreflow:hidden; width: auto;"><div class="box-body chat" id="chat-box" style="overflow: auto; padding-right: 15px;width: auto;">
                    <!-- chat item -->

                    @foreach($team->collection->students as $student)
                    <div class="item seperation-border offline">
                        <img src="{{asset('/img/user1-128x128.jpg')}}" alt="user image"><div class="status"></div></img>

                        <p class="message">
                                        <span class="name">
                                            <a href="#">{{$student->user->name}}</a>
                                            <span class="pull-right text-muted small" style="margin-top: 5px;">11:33</span>
                                        </span>

                            4 <i class="fa fa-trophy text-blue"></i>
                        </p>
                    </div>
                    @endforeach
                    <!-- /.item -->

                </div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 184.911px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
            <!-- /.chat -->
        </div>
        <div class="option-panel box-header">
            <h1>{{$team->collection->name}}</h1>
            <button  type="button" class="btn btn-block btn-success pull-right" data-toggle="modal" data-target="#newCaseModal" data-url="{{URL::to('/ajax/case/add')}}"><i class="fa fa-plus" aria-hidden="true"></i> Opret ny</button>
        </div>
        <div class="container spark-screen">
            <h3>Aktive</h3>
            <div class="row">

                @foreach($team->cases->filter(function($case){return $case->active;})->sortByDesc('created_at') as $case)
                    <div class="col-lg-4- col-md-4 col-sm-6 col-xs-12">
                        <div class="box simple-box">
                            <div class="box-body">
                                <h4 class="title">{{$case->name}}</h4>
                                <span class="text text-muted">{{$case->created_at->format('d. F Y')}}</span>
                                <button onclick='location.href="{{$case->uniquecase->getUrl()}}"' type="button" class="btn btn-block btn-primary">Se aktivitet</button>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
            <h3>Afslutede</h3>
            <div class="row">
                @foreach($team->cases->reject(function($case){return $case->active;})->sortByDesc('created_at') as $case)
                    <div class="col-lg-4- col-md-4 col-sm-6 col-xs-12">
                        <div class="box simple-box">
                            <div class="box-body">
                                <h4 class="title">{{$case->name}}</h4>
                                <span class="text text-muted">11. december 2016</span>
                                <button onclick='location.href="{{$case->uniquecase->getUrl()}}"' type="button" class="btn btn-block btn-primary">Se case</button>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>


    <div class="modal fade" id="newCaseModal" data-form="#createCaseForm" tabindex="-1" role="dialog" aria-labelledby="Ny Case" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                </div>
                <div class="modal-body">
                    <form id="createCaseForm">
                        <div class="form-group">
                            <label id="tester" for="name" class="form-control-label">Navn: </label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-file-text-o"></i>
                                </div>
                                <input type="text" class="form-control" name="name" placeholder='Ikke angivet'>
                            </div>
                            <input type="hidden" name="teamId" value="{{$team->id}}">
                            <input type="hidden" name="target" value="{{URL::route('api') . '/case/add'}}">
                            {{ csrf_field() }}
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="response"></div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Luk</button>
                    <button type="button" class="btn btn-primary action" data-target="#newCaseModal">Opret</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-danger">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Danger Modal</h4>
                </div>
                <div class="modal-body">
                    <p>One fine body…</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('page-scripts')
    <script>
        $(function() {

            //When a new case is being added post it.
            $( "#newCaseModal .action" ).click(function() {
                modalPost(this);
            });
        });

    </script>
@endsection