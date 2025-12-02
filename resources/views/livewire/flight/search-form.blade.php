<div>
    {{-- <form wire:submit.prevent="submit" class="row align-items-center">

        <!-- Flying From -->
        <div class="col-lg-4">
            <label>Flying from</label>
            <input type="text" wire:model="from" class="form-control" placeholder="City or airport" />
        </div>

        <!-- Flying To -->
        <div class="col-lg-4">
            <label>Flying to</label>
            <input type="text" wire:model="to" class="form-control" placeholder="City or airport" />
        </div>

        <!-- Departing -->
        <div class="col-lg-4">
            <label>Departing</label>
            <input type="date" wire:model="depart_date" class="form-control" />
        </div>

        <!-- Returning (round-trip only) -->
        @if ($tripType === 'round-trip')
            <div class="col-lg-4">
                <label>Returning</label>
                <input type="date" wire:model="returning" class="form-control" />
            </div>
        @endif

        <!-- Passengers -->
        <div class="col-lg-4">
            <label>Adults</label>
            <input type="number" wire:model="passengers.adult" min="1" class="form-control" />
        </div>
        <div class="col-lg-4">
            <label>Children</label>
            <input type="number" wire:model="passengers.children" min="0" class="form-control" />
        </div>
        <div class="col-lg-4">
            <label>Infants</label>
            <input type="number" wire:model="passengers.infants" min="0" class="form-control" />
        </div>

        <!-- Cabin -->
        <div class="col-lg-4">
            <label>Cabin</label>
            <select wire:model="cabin" class="form-control">
                <option>Economy</option>
                <option>Business</option>
                <option>First class</option>
            </select>
        </div>

        <div class="col-lg-4">
            <button type="submit" class="theme-btn w-100 mt-2">Search Now</button>
        </div>
    </form> --}}

    <form wire:submit.prevent="submit" class="row align-items-center">

        <!-- Flying From -->
        <div class="col-lg-4 mb-3">
            <label>Flying from</label>

            <select wire:model="from" class="form-control">
                <option value="">Select Airport</option>

                @foreach ($airports as $airport)
                    <option value="{{ $airport->iata }}">
                        {{ $airport->city }} — {{ $airport->name }} ({{ $airport->iata }})
                    </option>
                @endforeach
            </select>

            @error('from')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <!-- Flying To -->
        <div class="col-lg-4 mb-3 ">
            <label>Flying to</label>

            <select wire:model="to" class="form-control">
                <option value="">Select Destination</option>

                @foreach ($airports as $airport)
                    <option value="{{ $airport->iata }}">
                        {{ $airport->city }} — {{ $airport->name }} ({{ $airport->iata }})
                    </option>
                @endforeach
            </select>
            @error('to')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <!-- Departing -->
        <div class="col-lg-4 mb-3">
            <label>Departing</label>
            <input type="date" wire:model="departing" class="form-control" />
            @error('departing')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <!-- Returning (round-trip only) -->
        @if ($tripType === 'round-trip')
            <div class="col-lg-4 mb-3">
                <label>Returning</label>
                <input type="date" wire:model="returning" class="form-control" />
                @error('returning')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
        @endif

        <!-- Passengers -->
        <div class="col-lg-4 mb-3">
            <label>Adults</label>
            <input type="number" wire:model="adults" min="1" class="form-control" />
            @error('adults')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-lg-4 mb-3">
            <label>Children</label>
            <input type="number" wire:model="children" min="0" class="form-control" />
            @error('children')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-lg-4">
            <label>Infants</label>
            <input type="number" wire:model="infants" min="0" class="form-control" />
            @error('infants')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <!-- Cabin -->
        <div class="col-lg-4">
            <label>Cabin</label>
            <select wire:model="cabinClass" class="form-control">
                <option>Economy</option>
                <option>Business</option>
                <option>First class</option>
            </select>
            @error('cabinClass')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="col-lg-4">
            <button type="submit" class="theme-btn w-100 mt-2">Search Now</button>
        </div>

    </form>


</div>
