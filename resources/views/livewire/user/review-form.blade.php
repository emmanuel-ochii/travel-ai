<div>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($hasReviewed)
        <div class="alert alert-warning">
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
                                <form wire:submit.prevent="submitReview" class="row">

                                    <div class="col-lg-12">
                                        <div class="input-box">
                                            <label class="label-text">Total time of flight</label>
                                            <div class="form-group">
                                                <span class="la la-clock form-icon"></span>
                                                <input wire:model="total_flight_time" readonly class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="input-box">
                                            <label class="label-text">Name</label>
                                            <div class="form-group">
                                                <span class="la la-user form-icon"></span>
                                                <input wire:model="name" readonly class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="input-box">
                                            <label class="label-text mb-0">Airline</label>
                                            <div class="form-group select2-container-wrapper select-contain w-100">
                                                <input wire:model="airline" readonly class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="input-box">
                                            <label class="label-text mb-0">Class Type</label>
                                            <div class="form-group select2-container-wrapper select-contain w-100">
                                                <input wire:model="class_type" readonly class="form-control">
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

                                </form>
                            </div>
                        </div>

                        <div class="submit-box">
                            <div class="btn-box pt-3">
                                <button wire:click="submitReview" class="theme-btn">Submit Review</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
