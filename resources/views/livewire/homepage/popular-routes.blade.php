<div>
    <section class="round-trip-flight section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading text-center">
                        <h2 class="sec__title line-height-55">
                            Most Popular  <br />
                            Flight Destinations
                        </h2>
                    </div>
                    <!-- end section-heading -->
                </div>
                <!-- end col-lg-12 -->
            </div>
            <!-- end row -->

            <div class="row padding-top-50px">
                <div class="col-lg-12">

                    <div class="flight-filter-tab text-center">
                        <div class="section-tab section-tab-3">
                            <ul class="nav nav-tabs justify-content-center" id="popularRoutesTabs" role="tablist">
                                @php $first = true; @endphp
                                @foreach ($popularTabs as $originLabel => $routes)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $first ? 'active' : '' }}"
                                            id="{{ \Illuminate\Support\Str::slug($originLabel) }}-tab"
                                            data-bs-toggle="tab"
                                            href="#{{ \Illuminate\Support\Str::slug($originLabel) }}" role="tab"
                                            aria-controls="{{ \Illuminate\Support\Str::slug($originLabel) }}"
                                            aria-selected="{{ $first ? 'true' : 'false' }}">
                                            {{ $originLabel }}
                                        </a>
                                    </li>
                                    @php $first = false; @endphp
                                @endforeach
                            </ul>
                        </div>
                        <!-- end section-tab -->
                    </div>
                    <!-- end flight-filter-tab -->

                    <div class="popular-round-trip-wrap padding-top-40px">
                        <div class="tab-content" id="popularRoutesTabsContent">
                            @php $firstPane = true; @endphp
                            @foreach ($popularTabs as $originLabel => $routes)
                                <div class="tab-pane fade {{ $firstPane ? 'show active' : '' }}"
                                    id="{{ \Illuminate\Support\Str::slug($originLabel) }}" role="tabpanel"
                                    aria-labelledby="{{ \Illuminate\Support\Str::slug($originLabel) }}-tab">
                                    <div class="row">
                                        @foreach ($routes as $route)
                                            <div class="col-lg-4 responsive-column">
                                                <div class="deal-card">
                                                    <div class="deal-title d-flex align-items-center">
                                                        <img src="{{ $route['logo'] }}" alt="air-line-img"
                                                            style="width:48px;height:48px;object-fit:contain;" />
                                                        <h3 class="deal__title" style="margin-left:12px;">
                                                            <a href="{{ $route['flight_detail_url'] }}"
                                                                class="d-flex align-items-center">
                                                                {{ $route['origin_label'] }}
                                                                <i class="la la-exchange mx-2"></i>
                                                                {{ $route['destination_label'] }}
                                                            </a>
                                                        </h3>
                                                    </div>

                                                    {{-- If you want dates, we show depart-arrive if available --}}
                                                    <p class="deal__meta">
                                                        @if ($route['depart_at'] && $route['arrive_at'])
                                                            {{ \Carbon\Carbon::parse($route['depart_at'])->format('D, M j') }}
                                                            -
                                                            {{ \Carbon\Carbon::parse($route['arrive_at'])->format('D, M j') }}
                                                        @else
                                                            Round-trip
                                                        @endif
                                                    </p>

                                                    <div
                                                        class="deal-action-box d-flex align-items-center justify-content-between">
                                                        <div class="price-box d-flex align-items-center">
                                                            <span class="price__from me-1">From</span>
                                                            @if ($route['price'])
                                                                <span class="price__num">{{ $route['currency'] }}
                                                                    {{ $route['price'] }}</span>
                                                            @else
                                                                <span class="price__num">—</span>
                                                            @endif
                                                        </div>

                                                        {{-- See details link --}}
                                                        <a href="{{ $route['flight_detail_url'] }}"
                                                            class="btn-text">See details <i
                                                                class="la la-angle-right"></i></a>
                                                    </div>
                                                </div>
                                                <!-- end deal-card -->
                                            </div>
                                            <!-- end col-lg-4 -->
                                        @endforeach
                                    </div>
                                </div>
                                <!-- end tab-pane -->
                                @php $firstPane = false; @endphp
                            @endforeach
                        </div>
                        <!-- end tab-content -->

                        <div class="tab-content-info d-flex justify-content-between align-items-center">
                            <p class="font-size-15">
                                <i class="la la-question-circle me-1"></i>Average round-trip price per person, taxes and
                                fees included.
                            </p>
                            <a href="#" class="btn-text font-size-15">Discover More <i
                                    class="la la-angle-right"></i></a>
                        </div>
                        <!-- end tab-content-info -->
                    </div>
                </div>
                <!-- end col-lg-12 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
</div>
