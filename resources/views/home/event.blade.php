@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                        <fieldset>
                            <legend>More Info:</legend>
                            <div class="col-md-4"><strong>Name:</strong></div> <div class="col-md-8">{{ $event->name }}</div><br><br>
                            <div class="col-md-4"><strong>Details:</strong></div> <div class="col-md-8">{{ $event->details }}</div><br><br>
                            <div class="col-md-4"><strong>Venue:</strong></div> <div class="col-md-8">{{ $event->venue }}</div><br><br>
                            <div class="col-md-4"><strong>Start:</strong></div> <div class="col-md-8">{{ $event->start }}</div><br><br>
                            <div class="col-md-4"><strong>End:</strong></div> <div class="col-md-8">{{ $event->end }}</div><br><br>
                            <div class="col-md-4"><strong>Attending</strong></div>
                            <div class="col-md-8">
                                <ul style="list-style: none;">
                                    @foreach($userNamesAttending as $userNameAttending)
                                        <li>{{ $userNameAttending }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </fieldset><br><br>
                        <a href="{{ url('/attend/' . $event->id) }}" class="btn btn-primary">Attend</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection