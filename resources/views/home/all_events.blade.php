@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">All Events</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Venue</th>
                                <th>Start</th>
                                <th>End</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr class='clickable-row' data-href="{{ url('/event/' .$event->id) }}">
                                    <td>{{$event->name}}</td>
                                    <td>{{$event->venue}}</td>
                                    <td>{{$event->start}}</td>
                                    <td>{{$event->end}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection