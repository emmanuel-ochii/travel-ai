<?php

namespace App\Livewire\Flight;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\FlightSearchService;

class Results extends Component
{
    use WithPagination;

    // Match SearchForm properties
    public $from;
    public $to;
    public $departing;
    public $returning;
    public $adults = 1;
    public $children = 0;
    public $infants = 0;
    public $cabinClass = 'Economy';
    public $tripType = 'one-way';

    protected $queryString = [
        'from',
        'to',
        'departing',
        'returning',
        'adults',
        'children',
        'infants',
        'cabinClass',
        'tripType',
    ];

    protected $perPage = 10;

    protected $listeners = ['refreshResults' => '$refresh'];

    public function mount()
    {
        // basic guard
        // abort_if(!$this->from || !$this->to || !$this->departing, 400);
        if (!($this->from && $this->to && $this->departing)) {
            return redirect()->route('home')->with('warning', 'Please search for flights first.');
        }
    }

    public function updating($name, $value)
    {
        if ($name !== 'page')
            $this->resetPage();
    }

    private function getParams()
    {
        return [
            'origin' => strtoupper($this->from),
            'destination' => strtoupper($this->to),
            'depart_date' => $this->departing,
            'return_date' => $this->returning,
            'passengers' => [
                'adults' => $this->adults,
                'children' => $this->children,
                'infants' => $this->infants,
            ],
            'class' => $this->cabinClass,
            'tripType' => $this->tripType,
        ];
    }

    public function render(FlightSearchService $service)
    {
        $flights = $service->search($this->getParams(), 10);

        return view('livewire.flight.results', compact('flights'));
    }


}
