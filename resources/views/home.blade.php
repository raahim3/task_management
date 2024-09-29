@extends('layouts.dashboard')
@section('content')
<div class="container-fluid site-width">
    <!-- START: Breadcrumbs-->
    <div class="row">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Dashboard</h4> <p>Welcome to liner admin panel</p></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->

    <!-- START: Card Data-->
    <div class="row">
        <div class="col-12 col-lg-12 ">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="card bg-primary">
                                <div class="card-body">
                                    <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                        <i class="icon-basket icons card-liner-icon mt-2 text-white"></i>
                                        <div class='card-liner-content'>
                                            <h2 class="card-liner-title text-white">{{ number_format($total_projects) }}</h2>
                                            <h6 class="card-liner-subtitle text-white">Total Projects</h6>                                       
                                        </div>                                
                                    </div>
                                    <div id="apex_primary_chart"></div>                               
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                        <i class="icon-user icons card-liner-icon mt-2"></i>
                                        <div class='card-liner-content'>
                                            <h2 class="card-liner-title">{{ number_format($total_users) }}</h2>
                                            <h6 class="card-liner-subtitle">Team</h6> 
                                        </div>                                
                                    </div>
                                    <div id="apex_today_visitors"></div> 
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6  mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                        <i class="icon-bag icons card-liner-icon mt-2"></i>
                                        <div class='card-liner-content'>
                                            <h2 class="card-liner-title">$4,390</h2>
                                            <h6 class="card-liner-subtitle">Today's Sale</h6> 
                                        </div>                                
                                    </div>
                                    <div id="apex_today_sale"></div> 
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                        <span class="card-liner-icon mt-1">$</span>
                                        <div class='card-liner-content'>
                                            <h2 class="card-liner-title">$4,390</h2>
                                            <h6 class="card-liner-subtitle">Total Profit</h6> 
                                        </div>                                
                                    </div>
                                    <div id="apex_today_profit"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12  col-md-5 col-lg-5 ">
                    <div class="card">                           
                        <div class="card-content">
                            <div class="card-body pt-0">
                                <button class="btn btn-primary " id="syncBtn"><i class="fas fa-sync syncIcon"></i> Sync</button>
                                <div class="row">                                           
                                    <div class="col-12">
                                        <ul class="activities mt-3 mb-2" id="activities">
                                            
                                        </ul> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        <div class="col-12 col-lg-12 mt-3">
            <div class="card">                           
                <div class="card-content">
                    <div class="card-body">

                        <div id="apex_bar_chart" class="height-500"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4 mt-3">
            <div class="card">                            
                <div class="card-content">
                    <div class="card-body">  
                        <div class="d-flex"> 
                            <div class="media-body align-self-center ">
                                <span class="mb-0 h5 font-w-600">Daily Reports</span><br>
                                <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                                    
                            </div>
                            <div class="ml-auto border-0 outline-badge-warning circle-50"><span class="h5 mb-0">$</span></div>
                        </div>
                        <div id="flot-report" class="height-175 w-100 mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mt-3">
            <div class="card">                            
                <div class="card-content">
                    <div class="card-body"> 
                        <div class="d-flex"> 
                            <div class="media-body align-self-center ">
                                <span class="mb-0 h5 font-w-600">Stats Reports</span><br>
                                <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                                    
                            </div>
                            <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0">$</span></div>
                        </div>
                        <div class="d-flex mt-4">
                            <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0">Income</span><br/>                                        
                                $78,600
                            </div>
                            <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0">Sales</span><br/>                                        
                                $1,24,600
                            </div>
                        </div>

                        <div class="d-flex mt-3">
                            <div class="border-0 outline-badge-dark w-50 p-3 rounded text-center"><span class="h5 mb-0">Users</span><br/>                                        
                                4,600
                            </div>
                            <div class="border-0 outline-badge-danger w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0">Orders</span><br/>                                        
                                2,600
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mt-3">
            <div class="card">                            
                <div class="card-content">
                    <div class="card-body">  
                        <div class="height-235">
                            <canvas id="chartjs-other-pie"></canvas>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-12  col-md-6 col-lg-3 mt-3">
            <div class="card border-bottom-0">                            
                <div class="card-content border-bottom border-primary border-w-5">
                    <div class="card-body p-4">                                   
                        <div class="d-flex">                                        
                            <img src="{{ asset('assets/images/author1.jpg') }}" alt="author" width="55" class="rounded-circle  ml-auto">
                            <div class="media-body align-self-center pl-3">
                                <span class="mb-0 font-w-600">Jonathan</span><br>
                                <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3 border-bottom-0">                            
                <div class="card-content border-bottom border-warning border-w-5">
                    <div class="card-body p-4">
                        <p class="mb-3 font-w-600">View Order > Confirm Order</p>
                        <p class="font-w-500 tx-s-12"><i class="icon-calendar"></i> March 14th, 2021</p> 
                        <p class="font-w-500 tx-s-12">Time estimate: 12 days</p> 
                        <div class="d-flex">
                            <div class="my-auto line-h-1">
                                <span class="badge outline-badge-secondary">Medium</span> 
                                <span class="badge outline-badge-success ml-2">Tracking</span>                                       
                            </div>
                            <img src="{{ asset('assets/images/author9.jpg') }}" alt="author" width="30" class="rounded-circle  ml-auto">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-bottom-0 mt-3">                            
                <div class="card-content border-bottom border-info border-w-5">
                    <div class="card-body p-4">                                   
                        <div class="d-flex">                                        
                            <img src="{{ asset('assets/images/author9.jpg') }}" alt="author" width="55" class="rounded-circle  ml-auto">
                            <div class="media-body align-self-center pl-3">
                                <span class="mb-0 font-w-600">Kelvin</span><br>
                                <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mt-3">
            <div class="card overflow-hidden">
                <div class="card-header d-flex justify-content-between align-items-center">                               
                    <h6 class="card-title">New Users</h6>
                </div>
                <div class="card-content">
                    <div class="card-body p-0">
                        <ul class="list-group list-unstyled">
                            <li class="p-2 border-bottom zoom">
                                <div class="media d-flex w-100">
                                    <a href="#"><img src="{{ asset('assets/images/author1.jpg') }}" alt="" class="img-fluid ml-0 mt-2  rounded-circle" width="40"></a>
                                    <div class="media-body align-self-center pl-2">
                                        <span class="mb-0 font-w-600">Jonathan</span><br>
                                        <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                                    
                                    </div>
                                    <div class="ml-auto my-auto">
                                        <a href="#"  data-toggle="dropdown">
                                            <i class="icon-options icons h6 font-weight-bold"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                                            <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                <span class="icon-user mr-2 h6 mb-0"></span> View Profile</a>
                                            <a href="#" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                                <span class="icon-trash mr-2 h6  mb-0"></span> Delete</a>
                                        </div>
                                    </div>
                                </div> 
                            </li>
                            <li class="p-2 border-bottom zoom">
                                <div class="media d-flex w-100">
                                    <a href="#"><img src="{{ asset('assets/images/author2.jpg') }}" alt="" class="img-fluid ml-0 mt-2  rounded-circle" width="40"></a>
                                    <div class="media-body align-self-center pl-2">
                                        <span class="mb-0 font-w-600">kelvin</span><br>
                                        <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                                    
                                    </div>
                                    <div class="ml-auto my-auto">
                                        <a href="#"  data-toggle="dropdown">
                                            <i class="icon-options icons h6 font-weight-bold"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                                            <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                <span class="icon-user mr-2 h6 mb-0"></span> View Profile</a>
                                            <a href="#" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                                <span class="icon-trash mr-2 h6  mb-0"></span> Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="p-2 border-bottom zoom">
                                <div class="media d-flex w-100">
                                    <a href="#"><img src="{{ asset('assets/images/author3.jpg') }}" alt="" class="img-fluid ml-0 mt-2 rounded-circle" width="40"></a>
                                    <div class="media-body align-self-center pl-2">
                                        <span class="mb-0 font-w-600">Peter</span><br>
                                        <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                                   
                                    </div>
                                    <div class="ml-auto my-auto">
                                        <a href="#"  data-toggle="dropdown">
                                            <i class="icon-options icons h6 font-weight-bold"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                                            <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                <span class="icon-user mr-2 h6 mb-0"></span> View Profile</a>
                                            <a href="#" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                                <span class="icon-trash mr-2 h6  mb-0"></span> Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="p-2 border-bottom zoom">
                                <div class="media d-flex w-100">
                                    <a href="#"><img src="{{ asset('assets/images/author9.jpg') }}" alt="" class="img-fluid ml-0 mt-2 rounded-circle" width="40"></a>
                                    <div class="media-body align-self-center pl-2">
                                        <span class="mb-0 font-w-600">Ray Sin</span><br>
                                        <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                                 
                                    </div>
                                    <div class="ml-auto my-auto">
                                        <a href="#"  data-toggle="dropdown">
                                            <i class="icon-options icons h6 font-weight-bold"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                                            <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                <span class="icon-user mr-2 h6 mb-0"></span> View Profile</a>
                                            <a href="#" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                                <span class="icon-trash mr-2 h6  mb-0"></span> Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="p-2 border-bottom zoom">
                                <div class="media d-flex w-100">
                                    <a href="#"><img src="{{ asset('assets/images/author6.jpg') }}" alt="" class="img-fluid ml-0 mt-2 rounded-circle" width="40"></a>
                                    <div class="media-body align-self-center pl-2">
                                        <span class="mb-0 font-w-600">Abexon Dixon</span><br/>
                                        <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                              
                                    </div>

                                    <div class="ml-auto mail-tools">
                                        <a href="#"  data-toggle="dropdown">
                                            <i class="icon-options icons h6 font-weight-bold"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                                            <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                <span class="icon-user mr-2 h6 mb-0"></span> View Profile</a>
                                            <a href="#" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                                <span class="icon-trash mr-2 h6  mb-0"></span> Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="p-2 zoom">
                                <div class="media d-flex w-100">
                                    <a href="#"><img src="{{ asset('assets/images/author7.jpg') }}" alt="" class="img-fluid ml-0 mt-2 rounded-circle" width="40"></a>
                                    <div class="media-body align-self-center pl-2">
                                        <span class="mb-0 font-w-600">Nathan S. Johnson</span><br/>
                                        <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                              
                                    </div>

                                    <div class="ml-auto mail-tools">
                                        <a href="#"  data-toggle="dropdown">
                                            <i class="icon-options icons h6 font-weight-bold"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                                            <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                <span class="icon-user mr-2 h6 mb-0"></span> View Profile</a>
                                            <a href="#" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                                <span class="icon-trash mr-2 h6  mb-0"></span> Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        </ul> 
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-12 col-lg-5 mt-3">
            <div class="card">
                <div class="card-header  justify-content-between align-items-center">                               
                    <h6 class="card-title">Visits by Countries</h6> 
                </div>
                <div class="card-body table-responsive p-0">                         

                    <table class="table font-w-600 mb-0">
                        <thead>
                            <tr>                                           
                                <th>Country</th>
                                <th>Visits</th>
                                <th>Sessions</th>
                                <th>Page View</th>                                           

                            </tr>
                        </thead>
                        <tbody>
                            <tr class="zoom">                                           
                                <td>France</td>
                                <td class="text-success">2,51,520 <i class="ion ion-arrow-graph-up-right"></i></td>
                                <td class="text-danger">3,23,55,479 <i class="ion ion-arrow-graph-down-right"></i></td>
                                <td class="text-info">23,27,346</td>

                            </tr>   
                            <tr  class="zoom">                                           
                                <td>United States</td>
                                <td class="text-success">1,40,000 <i class="ion ion-arrow-graph-up-right"></i></td>
                                <td class="text-danger">3,23,55,479 <i class="ion ion-arrow-graph-down-right"></i></td>
                                <td class="text-info">23,27,346</td>                                           
                            </tr> 
                            <tr  class="zoom">                                           
                                <td>China</td>
                                <td class="text-success">2,70,000 <i class="ion ion-arrow-graph-up-right"></i></td>
                                <td class="text-danger">3,23,55,479 <i class="ion ion-arrow-graph-down-right"></i></td>
                                <td class="text-info">23,27,346</td>                                         
                            </tr> 
                            <tr  class="zoom">                                           
                                <td>Spain</td>
                                <td class="text-success">7,60,000 <i class="ion ion-arrow-graph-up-right"></i></td>
                                <td class="text-danger">3,23,55,479 <i class="ion ion-arrow-graph-down-right"></i></td>
                                <td class="text-info">23,27,346</td>                                         
                            </tr> 
                            <tr  class="zoom">                                           
                                <td>Italy</td>
                                <td class="text-success">6,70,000 <i class="ion ion-arrow-graph-up-right"></i></td>
                                <td class="text-danger">3,23,55,479 <i class="ion ion-arrow-graph-down-right"></i></td>
                                <td class="text-info">23,27,346</td>                                          
                            </tr> 
                            <tr  class="zoom">                                           
                                <td>United Kingdom</td>
                                <td class="text-success">8,40,000 <i class="ion ion-arrow-graph-up-right"></i></td>
                                <td class="text-danger">3,23,55,479 <i class="ion ion-arrow-graph-down-right"></i></td>
                                <td class="text-info">23,27,346</td>                                          
                            </tr> 
                            <tr  class="zoom">                                           
                                <td>Malaysia</td>
                                <td class="text-success">4,90,000 <i class="ion ion-arrow-graph-up-right"></i></td>
                                <td class="text-danger">3,23,55,479 <i class="ion ion-arrow-graph-down-right"></i></td>
                                <td class="text-info">23,27,346</td>                                           
                            </tr> 
                            <tr  class="zoom">                                           
                                <td>India</td>
                                <td class="text-success">12,51,520 <i class="ion ion-arrow-graph-up-right"></i></td>
                                <td class="text-danger">3,23,55,479 <i class="ion ion-arrow-graph-down-right"></i></td>
                                <td class="text-info">23,27,346</td>                                           
                            </tr>  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="col-12 col-md-6 col-lg-6 mt-3">
            <div class="card border">                            
                <div class="card-content">
                    <div class="card-body p-4">   
                        <div class="d-md-flex">
                            <div class="my-auto">
                                <img src="{{ asset('assets/images/wallet.png') }}" alt="author" width="48" class="my-auto">
                            </div>
                            <div class="content px-md-3 my-3 my-md-0">                                           
                                <span class="mb-0 font-w-600 h5">Lorem ipsum dolor sit</span><br>
                                <p class="mb-0 font-w-500 tx-s-12">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis.</p>                                                    

                            </div>
                            <div class="my-auto">
                                <a href="#" class="btn btn-outline-primary font-w-600 my-auto text-nowrap">Get More</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-6 mt-3">
            <div class="card outline-badge-primary">                            
                <div class="card-content">
                    <div class="card-body p-4">   
                        <div class="d-md-flex">
                            <div class="my-auto">
                                <img src="{{ asset('assets/images/money.png') }}" alt="author"  class="my-auto">
                            </div>
                            <div class="content px-md-3 my-3 my-md-0">                                           
                                <span class="mb-0 font-w-600 h5">Lorem ipsum dolor sit</span><br>
                                <p class="mb-0 font-w-500 tx-s-12">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis.</p>                                                    

                            </div>
                            <div class="my-auto">
                                <a href="#" class="btn btn-outline-primary font-w-600 my-auto text-nowrap">Get More</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="col-12  col-md-6 col-lg-4 mt-3">
            <div class="card overflow-hidden">
                <div class="card-header d-flex justify-content-between align-items-center">                               
                    <h6 class="card-title">Todo List</h6>

                </div>
                <div class="card-content">
                    <div class="card-body p-0">
                        <div class="row">                                           
                            <div class="col-12">
                                <ul class="tasks">
                                    <li class="outline-badge-success border-0 d-flex py-3 px-2 zoom">
                                        <label class="chkbox d-flex">
                                            <input type="checkbox" checked="checked">                                                      
                                            <img src="{{ asset('assets/images/author.jpg') }}" alt="author" width="30" height="30" class="rounded-circle"/>
                                            <img src="{{ asset('assets/images/author2.jpg') }}" alt="author" width="30"  height="30" class="rounded-circle"/>
                                            <span class="mb-0 ml-2 my-auto font-w-600">Aenean ligula porttitor consequat vitae eleifend enim.</span>

                                            <span class="checkmark mt-1"></span>
                                        </label>
                                        <div class="ml-auto d-flex my-auto"><a href="#"><i class="ion ion-edit"></i></a> <a href="#" class="ml-2"><i class="ion ion-trash-a"></i></a></div>
                                    </li>
                                    <li class="outline-badge-warning border-0 d-flex py-3 px-2 zoom">
                                        <label class="chkbox d-flex">
                                            <input type="checkbox">                                                      
                                            <img src="{{ asset('assets/images/author2.jpg') }}" alt="author" width="30" height="30" class="rounded-circle "/>
                                            <img src="{{ asset('assets/images/author3.jpg') }}" alt="author" width="30" height="30" class="rounded-circle"/>
                                            <span class="mb-0 ml-2 my-auto font-w-600">In enim justo, rhoncus ut imperdiet a, venenatis vitae justo.</span>

                                            <span class="checkmark mt-1"></span>
                                        </label>
                                        <div class="ml-auto d-flex my-auto"><a href="#"><i class="ion ion-edit"></i></a> <a href="#" class="ml-2"><i class="ion ion-trash-a"></i></a></div>
                                    </li>

                                    <li class="outline-badge-info border-0 d-flex py-3 px-2 zoom">
                                        <label class="chkbox d-flex">
                                            <input type="checkbox">                                                      
                                            <img src="{{ asset('assets/images/author3.jpg') }}" alt="author" width="30" height="30" class="rounded-circle "/>
                                            <img src="{{ asset('assets/images/author7.jpg') }}" alt="author" width="30" height="30" class="rounded-circle"/>
                                            <span class="mb-0 ml-2 my-auto font-w-600">Cras dapibus vivamus elementum semper nisi.</span>

                                            <span class="checkmark mt-1"></span>
                                        </label>
                                        <div class="ml-auto d-flex my-auto"><a href="#"><i class="ion ion-edit"></i></a> <a href="#" class="ml-2"><i class="ion ion-trash-a"></i></a></div>
                                    </li>
                                    <li class="outline-badge-secondary border-0 d-flex py-3 px-2 zoom">
                                        <label class="chkbox d-flex">
                                            <input type="checkbox">                                                      
                                            <img src="{{ asset('assets/images/author6.jpg') }}" alt="author" width="30" height="30" class="rounded-circle "/>
                                            <img src="{{ asset('assets/images/author8.jpg') }}" alt="author" width="30" height="30" class="rounded-circle"/>
                                            <span class="mb-0 ml-2 my-auto font-w-600">Donec quam felis ultricies nec, pellentesque eu pretium quis.</span>

                                            <span class="checkmark mt-1"></span>
                                        </label>
                                        <div class="ml-auto d-flex my-auto"><a href="#"><i class="ion ion-edit"></i></a> <a href="#" class="ml-2"><i class="ion ion-trash-a"></i></a></div>
                                    </li>
                                    <li class="outline-badge-primary border-0 d-flex py-3 px-2 zoom">
                                        <label class="chkbox d-flex">
                                            <input type="checkbox">                                                      
                                            <img src="{{ asset('assets/images/author.jpg') }}" alt="author" width="30" height="30" class="rounded-circle "/>
                                            <img src="{{ asset('assets/images/author8.jpg') }}" alt="author" width="30" height="30" class="rounded-circle"/>
                                            <span class="mb-0 ml-2 my-auto font-w-600">Donec quam felis ultricies nec, pellentesque eu pretium quis.</span>

                                            <span class="checkmark mt-1"></span>
                                        </label>
                                        <div class="ml-auto d-flex my-auto"><a href="#"><i class="ion ion-edit"></i></a> <a href="#" class="ml-2"><i class="ion ion-trash-a"></i></a></div>
                                    </li>
                                </ul>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12  col-md-6 col-lg-4 mt-3">
            <!-- Card -->
            <div class="card promoting-card">

                <!-- Card content -->
                <div class="card-body d-flex flex-row">

                    <!-- Avatar -->
                    <img src="{{ asset('assets/images/author1.jpg') }}" class="rounded-circle mr-3" height="50" width="50" alt="avatar">

                    <!-- Content -->
                    <div>

                        <!-- Title -->
                        <h6 class="card-title font-weight-bold mb-2">New spicy meals</h6>
                        <!-- Subtitle -->
                        <p class="card-text"><i class="far fa-clock pr-2"></i>07/24/2020</p>

                    </div>

                </div>

                <!-- Card image -->
                <div class="view overlay">
                    <img class="card-img-top rounded-0" src="{{ asset('assets/images/portfolio13.jpg') }}" alt="Card image cap">

                </div>

                <!-- Card content -->
                <div class="card-body">

                    <div class="collapse-content">


                        <a class="btn btn-flat font-w-600">Read More</a>
                        <i class="fas fa-share-alt text-muted float-right p-1 my-1" data-toggle="tooltip" data-placement="top" title="Share this post"></i>
                        <i class="fas fa-heart text-muted float-right p-1 my-1 mr-3" data-toggle="tooltip" data-placement="top" title="I like it"></i>

                    </div>

                </div>

            </div>
            <!-- Card -->
        </div>

    </div>
    <!-- END: Card DATA-->                 
</div>
@endsection


@section('script')
    <script>
        $(document).ready(function(){
            activities();
            $(document).on('click','#syncBtn',function(){
                activities();
            });
        }); 

        function activities(){
            $.ajax({
                url:"{{ route('activities') }}",
                type:"GET",
                beforeSend:function(){
                    $('#syncBtn').attr('disabled',true); 
                    $('.syncIcon').css('animation','spin 1s infinite linear'); 
                },
                success:function(data){
                    $('#activities').html(data);
                    $('#syncBtn').attr('disabled',false); 
                    $('.syncIcon').css('animation','none'); 
                }
            });
        }
    </script>
@endsection