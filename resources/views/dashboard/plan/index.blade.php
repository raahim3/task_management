@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">                               
                <h4 class="card-title">Plans</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center my-4">
                    <button class="durationBtn active" data-duration="monthly">Montly</button>
                    <button class="durationBtn" data-duration="yearly">Yearly</button>
                </div>
                <div class="row">
                    @foreach ($plans as $plan)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">{{ $plan->name }}</h4>    
                                    <h3 class="text-center text-primary fw-bold price" 
                                        data-monthly-price="{{ number_format($plan->monthly_price, 2) }}" 
                                        data-yearly-price="{{ number_format($plan->yearly_price, 2) }}">
                                        ${{ number_format($plan->monthly_price, 2) }}
                                    </h3>
                                    @php($current_plan = auth()->user()->organization->subscriptions()->where('status', 1)->first())
                                    @if(auth()->check() && $plan->id == 1)
                                        <button class="text-white btn btn-primary w-100" disabled>Current Plan</button>
                                    @elseif($plan->id == $current_plan->plan_id)
                                    <a class="text-white btn btn-primary w-100 choose_btn" href="{{ route('plan.checkout', $plan->id) }}?duration=monthly">Renew</a>
                                    @else
                                        <a class="text-white btn btn-primary w-100 choose_btn" href="{{ route('plan.checkout', $plan->id) }}?duration=monthly">Choose</a>  
                                    @endif
                                    <div class="d-flex mt-3 justify-content-between align-items-center">
                                        <p class="h6 m-0"><strong>{{ $plan->max_users }}</strong> Users</p>
                                        <p class="h6 m-0"><i class="icon-check"></i></p>
                                    </div>  
                                    <div class="d-flex mt-3 justify-content-between align-items-center">
                                        <p class="h6 m-0"><strong>{{ $plan->max_projects }}</strong> Projects</p>
                                        <p class="h6 m-0"><i class="icon-check"></i></p>
                                    </div> 
                                    <div class="d-flex mt-3 justify-content-between align-items-center">
                                        <p class="h6 m-0"><strong>{{ $plan->max_tasks }}</strong> Task <small>(Each Project)</small></p>
                                        <p class="h6 m-0"><i class="icon-check"></i></p>
                                    </div> 
                                </div>    
                            </div>        
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $(document).on('click','.durationBtn',function(){
               $('.durationBtn').removeClass('active');
               $(this).addClass('active'); 
               var selectedDuration = $(this).data('duration');
                $('.price').each(function() {
                    var monthlyPrice = $(this).data('monthly-price');
                    var yearlyPrice = $(this).data('yearly-price');
                    if (selectedDuration === 'monthly') {
                        $(this).text('$' + monthlyPrice);
                    } else {
                        $(this).text('$' + yearlyPrice);
                    }
                });
                $('.choose_btn').each(function() {
                    var originalHref = $(this).attr('href').split('?')[0];
                    $(this).attr('href', originalHref + '?duration=' + selectedDuration);
                });
            });
        });
    </script>
@endsection