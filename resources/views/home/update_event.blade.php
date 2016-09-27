@extends('layouts.app')

<?php
    $startDate = new \DateTime($event->start);
    $formattedStartDate = $startDate->format('Y/m/d H:i');

    $endDate = new \DateTime($event->end);
    $formattedEndDate = $startDate->format('Y/m/d H:i');
?>

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Event</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/update_event/' . $event->id) }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $event->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                                <label for="details" class="col-md-4 control-label">Details</label>

                                <div class="col-md-6">
                                    <input id="details-value" type="hidden" value="{{ $event->details }}">
                                    <textarea class="form-control" name="details" id="details"  required autofocus></textarea>

                                    @if ($errors->has('details'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('details') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('venue') ? ' has-error' : '' }}">
                                <label for="venue" class="col-md-4 control-label">Venue</label>

                                <div class="col-md-6">
                                    <input id="venue" type="text" class="form-control" name="venue" value="{{ $event->venue }}" required autofocus>

                                    @if ($errors->has('venue'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('venue') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('start') ? ' has-error' : '' }}">
                                <label for="start" class="col-md-4 control-label">Start</label>

                                <div class="col-md-6">
                                    <input id="start" class="form-control date-time-picker" name="start" value="{{ $formattedStartDate }}" required autofocus>

                                    @if ($errors->has('start'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('start') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('start') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">End</label>

                                <div class="col-md-6">
                                    <input id="end" class="form-control date-time-picker" name="end" value="{{ $formattedEndDate }}" required autofocus>

                                    @if ($errors->has('end'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('end') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" value="D, l, M, F, Y-m-d H:i:s" id="date-time-picker-format-value"/>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection