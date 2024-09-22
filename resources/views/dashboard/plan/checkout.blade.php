@extends('layouts.dashboard')

@section('content')
<form action="{{ route('plan.checkout.process', $plan->id) }}" method="post">
    @csrf
    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
    <div class="row">
        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">                               
                    <h4 class="card-title">Purchase the plan</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Duration</h5>
                    <div class="card mt-3">
                        <div class="card-body d-flex justify-content-between">
                            <div class="d-flex align-items-center ">
                                <input type="radio" name="duration" value="monthly" data-value="{{ $plan->monthly_price }}" id="monthly" class="mr-2" {{ request('duration') == 'monthly' ? 'checked' : (old('duration') == 'monthly' ? 'checked' : '') }}>
                                <label for="monthly" class="m-0"> Monthly</label>
                            </div>
                            <div>
                                <h5 class="m-0">$ {{ $plan->monthly_price }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body d-flex justify-content-between">
                            <div class="d-flex align-items-center ">
                                <input type="radio" name="duration" value="yearly" data-value="{{ $plan->yearly_price }}" id="yearly" class="mr-2" {{ request('duration') == 'yearly' ? 'checked' : (old('duration') == 'yearly' ? 'checked' : '') }}>
                                <label for="yearly" class="m-0"> Yearly</label>
                            </div>
                            <div>
                                <h5 class="m-0">$ {{ $plan->yearly_price }}</h5>
                            </div>
                        </div>
                    </div>
                    <h5 class="card-title my-3">Payment Method</h5>
                    <div class="card mt-3">
                        <div class="card-body d-flex justify-content-between">
                            <div class="d-flex align-items-center ">
                                <input type="radio" name="payment_method" value="stripe" id="stripe" class="mr-2">
                                <label for="stripe" class="m-0"> Stripe</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">                               
                    <h4 class="card-title">Plan Details</h4>
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $plan->name }}</h4>
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
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">                               
                    <h4 class="card-title">Order Summary</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex mt-3 justify-content-between align-items-center">
                        <p class="h6 m-0">Total</p>
                        <p class="h6 m-0">$ <span id="total">{{ request('duration') == 'monthly' ? $plan->monthly_price : $plan->yearly_price }}</span></p>
                    </div> 
                    <button class="btn btn-primary w-100 mt-3">Purchase</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $(document).on('change','input[name="duration"]',function(){
                var value = $(this).data('value');
                $('#total').text(value);
            });
        });
    </script>
@endsection