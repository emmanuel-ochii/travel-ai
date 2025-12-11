<div>
    @if (session('success'))
        <div class="alert alert-success d-flex flex-column align-items-start gap-2">
            <div>
                <i class="la la-check-circle me-1"></i>
                {{ session('success') }}
            </div>
            {{-- 2. Added Back Button --}}
            {{-- Replace 'user.reviews' with your actual route name for the reviews page --}}
            <a href="{{ route('user.booking')}}" class="btn btn-sm btn-outline-success mt-2">
                <i class="la la-arrow-left me-1"></i> Go Back to Reviews
            </a>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            <i class="la la-times-circle me-1"></i>
            {{ session('error') }}
        </div>
    @endif

    @if ($hasReviewed)
        <div class="alert alert-warning">
            <i class="la la-exclamation-circle me-1"></i>
            You have already reviewed this flight. Thank you!
        </div>
    @else
        <section class="listing-form section--padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 mx-auto">
                        <div class="listing-header pb-4">
                            <h3 class="title font-size-28 pb-2">Review form submission</h3>
                            <p class="font-size-14">
                                Kindly make a review of the flight history and your experience.<br>
                                Note: You can only make a review of flights you have booked on our platform.
                            </p>
                        </div>

                        <div class="form-box">
                            <div class="form-title-wrap">
                                <h3 class="title"><i class="la la-plane me-2 text-gray"></i>Information about your flight</h3>
                            </div>

                            <div class="form-content contact-form-action">
                                {{-- Form Tag Starts Here --}}
                                <form wire:submit.prevent="submitReview" class="row">

                                    <div class="col-lg-6">
                                        <div class="input-box">
                                            <label class="label-text">Total time of flight</label>
                                            <div class="form-group">
                                                <span class="la la-clock form-icon"></span>
                                                {{-- Added defer to prevent unnecessary network requests --}}
                                                <input wire:model.defer="total_flight_time" readonly class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="input-box">
                                            <label class="label-text"> Give a rating (1-5)</label>
                                            <div class="form-group">
                                                <span class="la la-star form-icon"></span>
                                                {{-- Added defer to prevent UI jumps while typing --}}
                                                <input wire:model.defer="rating" class="form-control" type="number" min="1" max="5">
                                            </div>
                                            @error('rating')<small class="text-danger">{{ $message }}</small>@enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="input-box">
                                            <label class="label-text">Name</label>
                                            <div class="form-group">
                                                <span class="la la-user form-icon"></span>
                                                <input wire:model.defer="name" readonly class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="input-box">
                                            <label class="label-text mb-0">Airline</label>
                                            <div class="form-group select2-container-wrapper select-contain w-100">
                                                <input wire:model.defer="airline" readonly class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="input-box">
                                            <label class="label-text mb-0">Class Type</label>
                                            <div class="form-group select2-container-wrapper select-contain w-100">
                                                <input wire:model.defer="class_type" readonly class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="input-box">
                                            <label class="label-text mb-0">Description of your experience</label>
                                            <p class="font-size-13">400 character limit</p>
                                            <div class="form-group">
                                                <span class="la la-pencil form-icon"></span>
                                                <textarea wire:model.defer="review_text" maxlength="400"
                                                    class="message-control form-control"
                                                    placeholder="In English only..."></textarea>
                                            </div>
                                            @error('review_text')<small class="text-danger">{{ $message }}</small>@enderror
                                        </div>
                                    </div>

                                    {{-- 1. FIX: Moved submit button INSIDE the form tag --}}
                                    <div class="col-lg-12">
                                        <div class="submit-box">
                                            <div class="btn-box pt-3">
                                                {{-- Changed to type="submit" and removed wire:click to let form handle it --}}
                                                <button type="submit" class="theme-btn">
                                                    <span wire:loading.remove>Submit Review</span>
                                                    <span wire:loading>Submitting...</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                                {{-- Form Tag Ends Here --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
