@extends('layouts.app')
@section('content')
    <!-- Navbar & Hero Start -->
    <div class="container-fluid header position-relative overflow-hidden p-0">
        <nav class="navbar navbar-expand-lg fixed-top navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="{{ url('/') }}" class="navbar-brand p-0">
                @if($settings->light_logo)
                    <img src="{{ asset('settings').'/'.$settings->light_logo }}" alt="Logo"> 
                @else
                    <h1 class="display-6 text-primary m-0">{{$settings->title}}</h1>
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
                    <a href="javaScript:void()" class="nav-item nav-link">About</a>
                    <a href="javaScript:void()  " class="nav-item nav-link">Contact Us</a>
                </div>
                @if (auth()->check())
                <a href="{{ auth()->user()->role_id == 1 ? route('admin.index') : route('dashboard') }}" class="btn btn-primary rounded-pill text-white py-2 px-4">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-light border border-primary rounded-pill text-primary py-2 px-4 me-4">Log In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary rounded-pill text-white py-2 px-4">Sign Up</a>
                @endif
            </div>
        </nav>

        <!-- Hero Header Start -->
        <div class="hero-header overflow-hidden px-5">
            <div class="rotate-img">
                <img src="{{ asset('frontend/img/sty-1.png') }}" class="img-fluid w-100" alt="">
                <div class="rotate-sty-2"></div>
            </div>
            <div class="row gy-5 align-items-center">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <h1 class="display-4 text-dark mb-4 wow fadeInUp" data-wow-delay="0.3s">{{ $hero_section->main_heading->value }}</h1>
                    <p class="fs-4 mb-4 wow fadeInUp" data-wow-delay="0.5s">{{ $hero_section->text->value }}</p>
                    <a href="{{ $hero_section->btn->value }}" class="btn btn-primary rounded-pill py-3 px-5 wow fadeInUp" data-wow-delay="0.7s">{{ $hero_section->btn->label }}</a>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                    <img src="{{ asset('sections').'/'.$hero_section->image->value }}" class="img-fluid w-100 h-100" alt="">
                </div>
            </div>
        </div>
        <!-- Hero Header End -->
    </div>
    <!-- Navbar & Hero End -->


    <!-- About Start -->
    <div class="container-fluid overflow-hidden py-5"  style="margin-top: 6rem;">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="RotateMoveLeft">
                        <img src="{{ asset('sections').'/'.$about_section->image->value }}" class="img-fluid w-100" alt="">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h4 class="mb-1 text-primary">{{ $about_section->sub_heading->value }}</h4>
                    <h1 class="display-5 mb-4">{{ $about_section->main_heading->value }}</h1>
                    <p class="mb-4">{{ $about_section->text->value }}
                    </p>
                    <a href="{{ $about_section->about_more->value }}" class="btn btn-primary rounded-pill py-3 px-5">{{ $about_section->about_more->label }}</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Feature Start -->
    <div class="container-fluid feature overflow-hidden py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">Our Feature</h4>
                <h1 class="display-5 mb-4">Important Features For Email Marketing</h1>
                <p class="mb-0">Dolor sit amet consectetur, adipisicing elit. Ipsam, beatae maxime. Vel animi eveniet doloremque reiciendis soluta iste provident non rerum illum perferendis earum est architecto dolores vitae quia vero quod incidunt culpa corporis, porro doloribus. Voluptates nemo doloremque cum.
                </p>
            </div>
            <div class="row g-4 justify-content-center text-center mb-5">
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="text-center p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-envelope fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <a href="#" class="h4">Email Marketing <i class="fa fa-long-arrow-alt-right"></i></a>
                            <p class="mt-4 mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit.consectetur adipisicing elit
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="text-center p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-mail-bulk fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <a href="#" class="h4">Email Builder <i class="fa fa-long-arrow-alt-right"></i></a>
                            <p class="mt-4 mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit.consectetur adipisicing elit
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="text-center rounded p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-sitemap fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <a href="#" class="h4">Customer Builder <i class="fa fa-long-arrow-alt-right"></i></a>
                            <p class="mt-4 mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit.consectetur adipisicing elit
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="text-center rounded p-4">
                        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-tasks fa-5x text-secondary"></i></div>
                        <div class="feature-content">
                            <a href="#" class="h4">Campaign Manager <i class="fa fa-long-arrow-alt-right"></i></a>
                            <p class="mt-4 mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit.consectetur adipisicing elit
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="my-3">
                        <a href="#" class="btn btn-primary d-inline rounded-pill px-5 py-3">More Features</a>
                    </div>
                </div>
            </div>
            <div class="row g-5 pt-5" style="margin-top: 6rem;">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="feature-img RotateMoveLeft h-100" style="object-fit: cover;">
                        <img src="{{ asset('seccions').'/'.$feature_section->image->value }}" class="img-fluid w-100 h-100" alt="">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.1s">
                    <h4 class="text-primary">{{ $feature_section->sub_heading->value }}</h4>
                    <h1 class="display-5 mb-4">{{ $feature_section->main_heading->value }}</h1>
                    <p class="mb-4">{{ $feature_section->text->value }}</p>
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="d-flex">
                                <i class="{{ $feature_section->icon_1->value }} fa-4x text-secondary"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h2 class="mb-0 fw-bold">{{ $feature_section->number_1->value }}</h2>
                                    <small class="text-dark">{{ $feature_section->label_1->value }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex">
                                <i class="{{ $feature_section->icon_2->value }} fa-4x text-secondary"></i>
                                <div class="d-flex flex-column ms-3">
                                    <h2 class="mb-0 fw-bold">{{ $feature_section->number_2->value }}</h2>
                                    <small class="text-dark">{{ $feature_section->label_2->value }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <a href="{{ $feature_section->btn->value }}" class="btn btn-primary rounded-pill py-3 px-5">{{ $feature_section->btn->label }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->


    <!-- FAQ Start -->
    <div class="container-fluid FAQ bg-light overflow-hidden py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                   <div class="accordion" id="accordionExample">
                        <div class="accordion-item border-0 mb-4">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseTOne">
                                    {{ $faq_section->ques_1->value }}
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body my-2">
                                    <h5>{{ $faq_section->ans_head_1->value }}</h5>
                                    <p>{{ $faq_section->ans_text_2->value }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-4">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    {{ $faq_section->ques_2->value }} 
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body my-2">
                                    <h5>{{ $faq_section->ans_head_2->value }}</h5>
                                    <p>{{ $faq_section->ans_text_2->value }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    {{ $faq_section->ques_3->value }}
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body my-2">
                                    <h5>{{ $faq_section->ans_head_3->value }}</h5>
                                    <p>{{ $faq_section->ans_text_3->value }}</p>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <div class="FAQ-img RotateMoveRight rounded">
                        <img src="{{ asset('frontend/img//about-1.png') }}" class="img-fluid w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ End -->


    <!-- Pricing Start -->
    <div class="container-fluid price py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">{{ $plan_section->sub_heading->value }}</h4>
                <h1 class="display-5 mb-4">{{ $plan_section->main_heading->value }}</h1>
                <p class="mb-0">
                    {{ $plan_section->text->value }}
                </p>
            </div>
            <div class="row g-5 justify-content-center">
                @foreach ($plans as $key => $plan)
                <?php
                    $color = ['text-dark','text-primary','text-secondary'];
                ?>
                    <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="price-item bg-light rounded text-center">
                        @if($key == 1)
                        <div class="pice-item-offer">Popular</div>
                        @endif
                            <div class="text-center {{$color[$key]}} border-bottom d-flex flex-column justify-content-center p-4" style="width: 100%; height: 160px;">
                                <p class="fs-2 fw-bold text-uppercase mb-0">{{ $plan->name }}</p>
                                <div class="d-flex justify-content-center">
                                    <strong class="align-self-start">$</strong>
                                    <p class="mb-0"><span class="display-5">{{ number_format($plan->monthly_price, 2) }}</span>/mo</p>
                                </div>                        
                            </div>
                            <div class="text-start p-5">
                                <p><i class="fas fa-check text-success me-1"></i> {{ $plan->max_users }} Users</p>
                                <p><i class="fas fa-check text-success me-1"></i> {{ $plan->max_projects }} Projects</p>
                                <p><i class="fas fa-check text-success me-1"></i> {{ $plan->max_tasks }} Task <small>(Each Project)</small></p>
                                @if(auth()->check())
                                    @if(auth()->check() && $plan->id == 1)
                                        @php($current_plan = auth()->user()->organization->subscriptions()->where('status', 1)->first())
                                        <button class="text-white btn btn-primary w-100" disabled>Current Plan</button>
                                    @elseif($plan->id == $current_plan->plan_id)
                                        <a class="text-white btn btn-primary w-100 choose_btn" href="{{ route('plan.checkout', $plan->id) }}?duration=monthly">Renew</a>
                                    @else
                                        <a class="text-white btn btn-primary w-100 choose_btn" href="{{ route('plan.checkout', $plan->id) }}?duration=monthly">Choose</a>  
                                    @endif
                                @else
                                    <a class="text-white btn btn-primary w-100 choose_btn" href="{{ route('plan.checkout', $plan->id) }}?duration=monthly">Choose</a>  
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
    </div>
    <!-- Pricing End -->


    <!-- Blog Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">{{ $blog_section->sub_heading->value }}</h4>
                <h1 class="display-5 mb-4">{{ $blog_section->main_heading->value }}</h1>
                <p class="mb-0">
                    {{ $blog_section->text->value }}
                </p>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($blogs as $blog)
                    <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="{{ asset('blogs').'/'.$blog->image ?? '' }}" class="img-fluid w-100" alt="">
                                <div class="blog-info">
                                    <span><i class="fa fa-clock"></i> {{ $blog->created_at->diffForHumans() }}</span>
                                    <div class="d-flex">
                                        <span class="me-3"> 3 <i class="fa fa-heart"></i></span>
                                        <a href="#" class="text-white">0 <i class="fa fa-comment"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-content text-dark border p-4 ">
                                <h5 class="mb-4">{{ substr($blog->title, 0, 50) }}</h5>
                                <p class="mb-4">{{ substr($blog->description, 0, 100) }}</p>
                                <a class="btn btn-light rounded-pill py-2 px-4" href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Blog End -->


    <!-- Testimonial Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">{{ $testimonial_section->sub_heading->value }}</h4>
                <h1 class="display-5 mb-4">{{ $testimonial_section->main_heading->value }}</h1>
                <p class="mb-0">
                    {{ $testimonial_section->text->value }}
                </p>
            </div>
            <div class="testimonial-carousel owl-carousel wow zoomInDown" data-wow-delay="0.2s">
                <div class="testimonial-item" data-dot="<img class='img-fluid' src='{{ asset('frontend/img/testimonial-img-1.jpg') }}' alt=''>">
                    <div class="testimonial-inner text-center p-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <div class="testimonial-inner-img border border-primary border-3 me-4" style="width: 100px; height: 100px; border-radius: 50%;">
                                <img src="{{ asset('frontend/img//testimonial-img-1.jpg') }}" class="img-fluid rounded-circle" alt="">
                            </div>
                            <div>
                                <h5 class="mb-2">John Abraham</h5>
                                <p class="mb-0">New York, USA</p>
                            </div>
                        </div>
                        <p class="fs-7">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores nemo facilis tempora esse explicabo sed! Dignissimos quia ullam pariatur blanditiis sed voluptatum. Totam aut quidem laudantium tempora. Minima, saepe earum!
                        </p>
                        <div class="text-center">
                            <div class="d-flex justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item" data-dot="<img class='img-fluid' src='{{ asset('frontend/img/testimonial-img-2.jpg') }}' alt=''>">
                    <div class="testimonial-inner text-center p-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <div class="testimonial-inner-img border border-primary border-3 me-4" style="width: 100px; height: 100px; border-radius: 50%;">
                                <img src="{{ asset('frontend/img//testimonial-img-2.jpg') }}" class="img-fluid rounded-circle" alt="">
                            </div>
                            <div>
                                <h5 class="mb-2">John Abraham</h5>
                                <p class="mb-0">New York, USA</p>
                            </div>
                        </div>
                        <p class="fs-7">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores nemo facilis tempora esse explicabo sed! Dignissimos quia ullam pariatur blanditiis sed voluptatum. Totam aut quidem laudantium tempora. Minima, saepe earum!
                        </p>
                        <div class="text-center">
                            <div class="d-flex justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item" data-dot="<img class='img-fluid' src='{{ asset('frontend/img/testimonial-img-3.jpg') }}' alt=''>">
                    <div class="testimonial-inner text-center p-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <div class="testimonial-inner-img border border-primary border-3 me-4" style="width: 100px; height: 100px; border-radius: 50%;">
                                <img src="{{ asset('frontend/img//testimonial-img-3.jpg') }}" class="img-fluid rounded-circle" alt="">
                            </div>
                            <div>
                                <h5 class="mb-2">John Abraham</h5>
                                <p class="mb-0">New York, USA</p>
                            </div>
                        </div>
                        <p class="fs-7">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores nemo facilis tempora esse explicabo sed! Dignissimos quia ullam pariatur blanditiis sed voluptatum. Totam aut quidem laudantium tempora. Minima, saepe earum!
                        </p>
                        <div class="text-center">
                            <div class="d-flex justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection