<?php

namespace App\Http\Livewire;

use Asantibanez\LivewireCalendar\LivewireCalendar;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Livewire\Event;

class AppointmentsCalendar extends Component
{
    public function events() : Collection
    {
        return collect([
            [
                'id' => 1,
                'title' => 'Breakfast',
                'description' => 'Pancakes! 🥞',
                'date' => Carbon::today(),
            ],
            [
                'id' => 2,
                'title' => 'Meeting with Pamela',
                'description' => 'Work stuff',
                'date' => Carbon::tomorrow(),
            ],
        ]);
    }

    public function onEventDrop($eventId, $newDate)
    {
      dd($eventId);
    }

    public function render(){

        return view('livewire.appointments-calendar');
    }


}