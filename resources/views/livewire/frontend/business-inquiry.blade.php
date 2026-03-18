<div>
    <div class="breadcumb-wrapper" data-bg-src="assets/img/bg/breadcumb-bg.jpg">
        <div class="breadcumb-shape1"><img src="assets/img/shape/breadcrumb-shape1.svg" alt="img"></div>
        <div class="breadcumb-shape2"><img src="assets/img/shape/breadcrumb-shape2.svg" alt="img"></div>
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Tell Us About Your Business</h1>
                <ul class="breadcumb-menu">
                    <li><a wire:navigate href="/">Home</a></li>
                    <li>Business Inquiry</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="space-top space-bottom">
        <div class="container">
            <div class="row g-4">
                <div class="col-xl-5">
                    <div class="contact-form-v1 bg-smoke h-100">
                        {{-- <h3 class="fs-32 mb-3 mt-n2">How can W</h3> --}}
                        <p class="mb-3">
                            Share your business context, key bottlenecks, and expected outcomes. Our team reviews each submission and responds with a practical next-step approach.
                        </p>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fa-light fa-circle-check me-2"></i>Execution and delivery challenges</li>
                            <li class="mb-2"><i class="fa-light fa-circle-check me-2"></i>Operations and process optimization</li>
                            <li class="mb-2"><i class="fa-light fa-circle-check me-2"></i>Strategy-to-implementation support</li>
                            <li class="mb-2"><i class="fa-light fa-circle-check me-2"></i>Organization and performance design</li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-7">
                    <div class="contact-form-v1 bg-smoke" data-bg-src="assets/img/bg/contact_bg_2.jpg">
                        <h3 class="fs-32 mb-30 mt-n2">Business Details Form</h3>

                        @if($submitted)
                            <div class="alert alert-success mb-4">
                                Thanks. Your business inquiry has been submitted successfully. We will contact you soon.
                            </div>
                        @endif

                        <form wire:submit.prevent="submit" class="contact-form">
                            <div class="row">
                                <div class="form-group col-md-6 style-white">
                                    <input type="text" class="form-control" wire:model.defer="full_name" placeholder="Full Name *">
                                    @error('full_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group col-md-6 style-white">
                                    <input type="email" class="form-control" wire:model.defer="email" placeholder="Email Address *">
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group col-md-6 style-white">
                                    <input type="text" class="form-control" wire:model.defer="phone" placeholder="Phone Number">
                                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group col-md-6 style-white">
                                    <input type="text" class="form-control" wire:model.defer="company_name" placeholder="Company Name *">
                                    @error('company_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group col-12 style-white">
                                    <textarea class="form-control" rows="4" wire:model.defer="business_summary" placeholder="Tell us about your business and what you need help with *"></textarea>
                                    @error('business_summary') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-btn col-12">
                                    <button class="th-btn w-100" type="submit">Submit Inquiry</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
