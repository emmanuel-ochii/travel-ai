<div>
    <section class="booking-area padding-top-100px padding-bottom-70px">
        <div class="container">
            <div class="row">

                <!-- LEFT SIDE -->
                <div class="col-lg-8">

                    @if (!$paymentCompleted)
                        {{-- SHOW FORM --}}
                        <div class="form-box">
                            <div class="form-title-wrap">
                                <h3 class="title">Booking Submission</h3>
                            </div>
                            <div class="form-content">
                                <form wire:submit.prevent="submitPayment">
                                    <!-- FORM FIELDS REMAIN SAME -->
                                    <div class="row">
                                        <div class="col-lg-6 responsive-column">
                                            <div class="input-box">
                                                <label class="label-text">First Name</label>
                                                <div class="form-group">
                                                    <span class="la la-user form-icon"></span>
                                                    <input class="form-control" type="text" wire:model="first_name"
                                                        placeholder="First name" />
                                                    @error('first_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 responsive-column">
                                            <div class="input-box">
                                                <label class="label-text">Last Name</label>
                                                <div class="form-group">
                                                    <span class="la la-user form-icon"></span>
                                                    <input class="form-control" type="text" wire:model="last_name"
                                                        placeholder="Last name" />
                                                    @error('last_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 responsive-column">
                                            <div class="input-box">
                                                <label class="label-text">Phone Number</label>
                                                <div class="form-group">
                                                    <span class="la la-phone form-icon"></span>
                                                    <input class="form-control" type="text" wire:model="phone"
                                                        placeholder="Phone Number" />
                                                    @error('phone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 responsive-column">
                                            <div class="input-box">
                                                <label class="label-text">Address</label>
                                                <div class="form-group">
                                                    <span class="la la-map-marked form-icon"></span>
                                                    <input class="form-control" type="text" wire:model="address"
                                                        placeholder="Address" />
                                                    @error('address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Payment Tabs here -->
                                    <div class="form-box mt-4">
                                        <div class="form-title-wrap">
                                            <h3 class="title">Your Card Information</h3>
                                        </div>
                                        <div class="form-content">
                                            <div class="section-tab check-mark-tab text-center pb-4">
                                                <ul class="nav nav-tabs justify-content-center" id="myTab"
                                                    role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link {{ $paymentMethod === 'card' ? 'active' : '' }}"
                                                            id="credit-card-tab" data-bs-toggle="tab"
                                                            href="#credit-card" role="tab"
                                                            aria-controls="credit-card"
                                                            aria-selected="{{ $paymentMethod === 'card' ? 'true' : 'false' }}">
                                                            <i class="la la-check icon-element"></i>
                                                            <img src="{{ asset('guest/images/payment-img.png') }}"
                                                                alt="" /><span class="d-block pt-2">Payment with
                                                                credit
                                                                card</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link {{ $paymentMethod === 'bank_transfer' ? 'active' : '' }}"
                                                            id="payoneer-tab" data-bs-toggle="tab" href="#payoneer"
                                                            role="tab" aria-controls="payoneer"
                                                            aria-selected="{{ $paymentMethod === 'bank_transfer' ? 'true' : 'false' }}">
                                                            <i class="la la-check icon-element"></i>
                                                            <img src="{{ asset('guest/images/bank_transfer.png') }}"
                                                                alt="" /><span class="d-block pt-2">Payment with
                                                                Bank
                                                                Transfer</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-content">
                                                <div class="tab-pane fade {{ $paymentMethod === 'card' ? 'show active' : '' }}"
                                                    id="credit-card" role="tabpanel" aria-labelledby="credit-card-tab">
                                                    <div class="contact-form-action">
                                                        <div class="row">
                                                            <div class="col-lg-6"><input type="text"
                                                                    class="form-control" placeholder="Card holder name">
                                                            </div>
                                                            <div class="col-lg-6"><input type="text"
                                                                    class="form-control" placeholder="Card number">
                                                            </div>
                                                            <div class="col-lg-6"><input type="text"
                                                                    class="form-control" placeholder="MM"></div>
                                                            <div class="col-lg-6"><input type="text"
                                                                    class="form-control" placeholder="YY"></div>
                                                            <div class="col-lg-6"><input type="text"
                                                                    class="form-control" placeholder="CVV"></div>
                                                            <div class="col-lg-12 mt-3"><button type="submit"
                                                                    class="theme-btn w-100">Pay with Card</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade {{ $paymentMethod === 'bank_transfer' ? 'show active' : '' }}"
                                                    id="payoneer" role="tabpanel" aria-labelledby="payoneer-tab">
                                                    <div class="contact-form-action">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <h3>BANK NAME HERE</h3>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <h4>Account name</h4>
                                                            </div>
                                                            <div class="col-lg-12 mt-3"><button type="submit"
                                                                    class="theme-btn w-100">I confirm I have made the
                                                                    transfer</button></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <button type="submit" class="theme-btn w-100 mt-3">
                                        Confirm & Pay
                                    </button> --}}
                                </form>
                            </div>
                        </div>
                    @else
                        {{-- SUCCESS MESSAGE --}}
                        <div class="alert alert-success p-5 text-center">
                            <h2>🎉 Booking Confirmed!</h2>
                            <p>Your booking was successful!</p>
                            <p><strong>Booking Reference:</strong> {{ $booking->booking_reference }}</p>
                            <p>A confirmation email with details has been sent.</p>

                            <a href="/" class="theme-btn mt-3">Return to Home</a>
                        </div>
                    @endif

                </div>


                <!-- RIGHT SIDE BOOKING SUMMARY -->
                <div class="col-lg-4">
                    <div class="form-box booking-detail-form">
                        <div class="form-title-wrap">
                            <h3 class="title">Your Booking</h3>
                        </div>
                        <div class="form-content">
                            <div class="card-item shadow-none radius-none mb-0">
                                <!-- Airline Logo -->
                                <div class="card-img pb-4 text-center">
                                    <img src="{{ optional($booking)->flight->airline->logo_url ??
                                        (optional($flight->airline)->logo_url ?? asset('images/default_airline_logo.png')) }}"
                                        alt="{{ optional($booking)->flight->airline->name ?? (optional($flight->airline)->name ?? 'Airline Logo') }}"
                                        class="img-fluid" />
                                </div>

                                <div class="card-body p-0">
                                    <!-- Airline Name & Flight Number -->
                                    <h3 class="card-title">
                                        {{ optional($booking)->flight->airline->name ?? (optional($flight->airline)->name ?? 'Airline Name') }}
                                        -
                                        {{ optional($booking)->flight->flight_number ?? (optional($flight)->flight_number ?? 'N/A') }}
                                    </h3>

                                    <div class="section-block"></div>

                                    <!-- Flight Times -->
                                    <ul class="list-items list-items-2 list-items-flush py-2">
                                        <li class="font-size-15">
                                            <span class="w-auto d-block mb-n1">
                                                <i class="la la-plane-departure me-1 font-size-17"></i>
                                                From:
                                                {{ optional(optional($booking)->flight)->origin->city ?? (optional($flight->origin)->city ?? 'N/A') }}
                                            </span>
                                            {{ optional(optional($booking)->flight)->depart_at?->format('D, M j, g:i A') ??
                                                (optional($flight->depart_at)?->format('D, M j, g:i A') ?? 'N/A') }}
                                        </li>

                                        <li class="font-size-15">
                                            <span class="w-auto d-block mb-n1">
                                                <i class="la la-plane-arrival me-1 font-size-17"></i>
                                                To:
                                                {{ optional(optional($booking)->flight)->destination->city ?? (optional($flight->destination)->city ?? 'N/A') }}
                                            </span>
                                            {{ optional(optional($booking)->flight)->arrive_at?->format('D, M j, g:i A') ??
                                                (optional($flight->arrive_at)?->format('D, M j, g:i A') ?? 'N/A') }}
                                        </li>
                                    </ul>

                                    <!-- Order Details -->
                                    <h3 class="card-title pb-3">Order Details</h3>
                                    <div class="section-block"></div>

                                    <ul class="list-items list-items-2 py-3">
                                        <li>
                                            <span>Class Type:</span>
                                            {{ ucfirst(optional($booking)->fare->fare_class ?? (optional($fare)->fare_class ?? 'N/A')) }}
                                        </li>

                                        {{-- show breakdown from DB booking if available, otherwise from component variables --}}
                                        <li><span>Adults:</span>
                                            {{ optional($booking)->adults ?? ($adults ?? 0) }}
                                        </li>
                                        <li><span>Children:</span>
                                            {{ optional($booking)->children ?? ($children ?? 0) }}
                                        </li>
                                        <li><span>Infants:</span>
                                            {{ optional($booking)->infants ?? ($infants ?? 0) }}
                                        </li>
                                    </ul>

                                    <!-- Pricing -->
                                    <div class="section-block"></div>
                                    <ul class="list-items list-items-2 pt-3">
                                        <li>
                                            <span>Sub Total:</span>
                                            {{ optional($booking)->currency ?? (optional($fare)->currency ?? 'USD') }}
                                            {{ number_format((optional($booking)->total_price_cents ?? ($totalPriceCents ?? 0)) / 100, 2) }}
                                        </li>
                                    </ul>

                                    <!-- Booking Reference -->
                                    <div class="section-block"></div>
                                    <ul class="list-items list-items-2 pt-3">
                                        <li>
                                            <span>Booking Reference:</span>
                                            {{ optional($booking)->booking_reference ?? 'Pending' }}
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end form-box -->
                </div>
                <!-- end col-lg-4 -->


            </div>
        </div>
    </section>
</div>
