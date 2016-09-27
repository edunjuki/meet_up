<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\EventAttendee;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('user_id', \Auth::user()->id)->get();

        return view('home.index', ['events' => $events]);
    }

    public function getEvents(){
        $events = Event::all();

        return view('home.events', ['events' => $events]);
    }

    public function getEvent($id){
        $event = Event::where('id', $id)->first();
        $eventAttendees = EventAttendee::where('event_id', $event->id)->get();

        $userNamesAttending = array();
        foreach($eventAttendees as $eventAttendee){
            $user = User::where('id', $eventAttendee->user_id)->first();
            $userNamesAttending[] = $user->name;
        }

        return view('home.event', ['event' => $event, 'userNamesAttending' => $userNamesAttending]);
    }

    public function getCreateEvent(){
        return view('home.create_event');
    }

    public function postCreateEvent(Request $request){
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'details' => 'required',
            'venue' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);

        if($validator->passes()){

            $event = new Event;
            $formattedStartDate = \DateTime::createFromFormat('Y/m/d H:i', $request->input('start'))->format('Y-m-d H:i:s');
            $formattedEndDate = \DateTime::createFromFormat('Y/m/d H:i', $request->input('end'))->format('Y-m-d H:i:s');

            $event->name = $request->input('name');
            $event->details = $request->input('details');
            $event->venue = $request->input('venue');
            $event->start = $formattedStartDate;
            $event->end = $formattedEndDate;
            $event->user_id = \Auth::user()->id;

            if($event->save()){
                $eventAttendee = new EventAttendee;

                $eventAttendee->user_id = \Auth::user()->id;
                $eventAttendee->event_id = $event->id;

                $eventAttendee->save();

                return \Redirect::to('home');
            }

            return redirect()->route('create_event', [$event]);
        }

        return \Redirect::to('create_event')->withErrors($validator)->withInput();
    }

    public function getEventsForUpdate(){
        $events = Event::where('user_id', \Auth::user()->id)->get();

        return view('home.events_for_update', ['events' => $events]);
    }

    public function getUpdateEvent($id){
        $event = Event::where('id', $id)->first();

        return view('home.update_event', ['event' => $event]);
    }

    public function postUpdateEvent($id, Request $request){
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'details' => 'required',
            'venue' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);

        if($validator->passes()){
            $event = Event::where('id', $id)->first();

            $formattedStartDate = \DateTime::createFromFormat('Y/m/d H:i', $request->input('start'))->format('Y-m-d H:i:s');
            $formattedEndDate = \DateTime::createFromFormat('Y/m/d H:i', $request->input('end'))->format('Y-m-d H:i:s');

            $event->name = $request->input('name');
            $event->details = $request->input('details');
            $event->venue = $request->input('venue');
            $event->start = $formattedStartDate;
            $event->end = $formattedEndDate;
            $event->user_id = \Auth::user()->id;

            $event->save();

            return \Redirect::to('update_events');
        }

        return redirect('update_event/'. $id)->withErrors($validator);
    }

    public function attendEvent($id){
        $eventAttendees = EventAttendee::where('event_id', $id)->get();

        $alreadyAttending = false;
        foreach($eventAttendees as $eventAttendee){
            if($eventAttendee->user_id == \Auth::user()->id){
                $alreadyAttending = true;
                break;
            }
        }

        if(!$alreadyAttending){
            $eventAttendee = new EventAttendee;

            $eventAttendee->user_id = \Auth::user()->id;
            $eventAttendee->event_id = $id;

            $eventAttendee->save();

            return \Redirect::to('event/'. $id);
        }

        return \Redirect::to('event/'. $id);
    }
}
