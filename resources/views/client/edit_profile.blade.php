<!DOCTYPE html>
<html lang="en">
  @include('structures.head')
  <body class="  ">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        @include('structures.sidebar')
        @include('structures.topbar')
      <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-body p-0">
                     <div class="iq-edit-list usr-edit">
                        <ul class="iq-edit-profile d-flex nav nav-pills">
                           <li class="col-md-4 p-0">
                              <a class="nav-link active" data-toggle="pill" href="#personal-information">
                              Personal Information
                              </a>
                           </li>
                           <li class="col-md-4 p-0">
                              <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                              Change Password
                              </a>
                           </li>
                           {{-- <li class="col-md-3 p-0">
                              <a class="nav-link" data-toggle="pill" href="#emailandsms">
                              Email and SMS
                              </a>
                           </li> --}}
                           <li class="col-md-4 p-0">
                              <a class="nav-link" data-toggle="pill" href="#manage-contact">
                              Manage Contact
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-12">
               <div class="iq-edit-list-data">
                  <div class="tab-content">
                     <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                        <div class="card">
                           <div class="card-header d-flex justify-content-between">
                              <div class="header-title">
                                 <h4 class="card-title">Personal Information</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form method="POST" action="{{route('profile.update_personal_info')}}" id="personalInfoForm">
                                 @csrf
                                 <div class="form-group row align-items-center">
                                    <div class="col-md-12">
                                       <div class="profile-img-edit">
                                          <div class="crm-profile-img-edit">
                                             <img class="crm-profile-pic rounded-circle avatar-100" src="{{asset('templates/datum/images/user/1.jpg')}}" alt="profile-pic">
                                             <div class="crm-p-image bg-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                                <input class="file-upload" type="file" accept="image/*">
                                             </div>
                                          </div>                                          
                                       </div>
                                    </div>
                                 </div>
                                 <div class=" row align-items-center">
                                    <div class="form-group col-sm-6">
                                       <label for="first_name">First Name:</label>
                                       <input type="text" class="form-control" name="first_name" id="first_name" value="{{$user_details->first_name}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="last_name">Last Name:</label>
                                       <input type="text" class="form-control" name="last_name" id="last_name" value="{{$user_details->last_name}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="user_name">User Name:</label>
                                       <input type="text" class="form-control" name="user_name" id="user_name" value="{{$user_details->user_name}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label class="d-block">Gender:</label>
                                       <div class="custom-control custom-radio custom-control-inline">
                                          <input type="radio" id="gender1" name="gender" class="custom-control-input" value="M">
                                          <label class="custom-control-label" for="gender1"> Male </label>
                                       </div>
                                       <div class="custom-control custom-radio custom-control-inline">
                                          <input type="radio" id="gender2" name="gender" class="custom-control-input" value="F">
                                          <label class="custom-control-label" for="gender2"> Female </label>
                                       </div>
                                       <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="gender3" name="gender" class="custom-control-input" value="P">
                                        <label class="custom-control-label" for="gender3"> Prefer not to say </label>
                                     </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="dob">Date Of Birth:</label>
                                        <input type="date" class="form-control" name="dob" id="dob" value="{{$user_details->dob}}">
                                     </div>                                     
                                    <div class="form-group col-sm-6">
                                       <label>Marital Status:</label>
                                       <select class="form-control" id="marital_status" name="marital_status">
                                          <option value="single">Single</option>
                                          <option value="married">Married</option>
                                          <option value="widowed">Widowed</option>
                                          <option value="divorced">Divorced</option>
                                          <option value="seperated">Separated </option>
                                       </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="qualification">Highest Qualification:</label>
                                        <input type="text" class="form-control" name="qualification" id="qualification" value="{{$user_details->qualification}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="occupation">Occupation:</label>
                                        <input type="text" class="form-control" name="occupation" id="occupation" value="{{$user_details->occupation}}">
                                     </div>
                                     <div class="form-group col-sm-12">
                                        <label for="about">Tell us something about yourself:</label>
                                        <textarea class="form-control" name="about" id="about" rows="5" style="line-height: 22px;">{{$user_details->about}}</textarea>
                                     </div>
                                    <div class="form-group col-sm-12">
                                       <label for="address">Address:</label>
                                       <textarea class="form-control" id="address" name="address" rows="5" style="line-height: 22px;">{{$user_details->address}}</textarea>
                                    </div>
                                 </div>
                                 <button type="reset" class="btn btn-outline-primary mr-2">Cancel</button>
                                 <button type="submit" class="btn btn-primary">Submit</button>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                        <div class="card">
                           <div class="card-header d-flex justify-content-between">
                              <div class="header-title">
                                 <h4 class="card-title">Change Password</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form>
                                 <div class="form-group">
                                    <label for="cpass">Current Password:</label>
                                    <a href="javascripe:void();" class="float-right">Forgot Password</a>
                                    <input type="Password" class="form-control" id="cpass" value="">
                                 </div>
                                 <div class="form-group">
                                    <label for="npass">New Password:</label>
                                    <input type="Password" class="form-control" id="npass" value="">
                                 </div>
                                 <div class="form-group">
                                    <label for="vpass">Verify Password:</label>
                                    <input type="Password" class="form-control" id="vpass" value="">
                                 </div>
                                 <button type="reset" class="btn btn-outline-primary mr-2">Cancel</button>
                                 <button type="submit" class="btn btn-primary">Submit</button>
                              </form>
                           </div>
                        </div>
                     </div>
                     {{-- <div class="tab-pane fade" id="emailandsms" role="tabpanel">
                        <div class="card">
                           <div class="card-header d-flex justify-content-between">
                              <div class="header-title">
                                 <h4 class="card-title">Email and SMS</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form>
                                 <div class="form-group row align-items-center">
                                    <label class="col-md-3" for="emailnotification">Email Notification:</label>
                                    <div class="col-md-9 custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="emailnotification" checked="">
                                       <label class="custom-control-label" for="emailnotification"></label>
                                    </div>
                                 </div>
                                 <div class="form-group row align-items-center">
                                    <label class="col-md-3" for="smsnotification">SMS Notification:</label>
                                    <div class="col-md-9 custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="smsnotification" checked="">
                                       <label class="custom-control-label" for="smsnotification"></label>
                                    </div>
                                 </div>
                                 <div class="form-group row align-items-center">
                                    <label class="col-md-3" for="npass">When To Email</label>
                                    <div class="col-md-9">
                                       <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="email01">
                                          <label class="custom-control-label" for="email01">You have new notifications.</label>
                                       </div>
                                       <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="email02">
                                          <label class="custom-control-label" for="email02">You're sent a direct message</label>
                                       </div>
                                       <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="email03" checked="">
                                          <label class="custom-control-label" for="email03">Someone adds you as a connection</label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group row align-items-center">
                                    <label class="col-md-3" for="npass">When To Escalate Emails</label>
                                    <div class="col-md-9">
                                       <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="email04">
                                          <label class="custom-control-label" for="email04"> Upon new order.</label>
                                       </div>
                                       <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="email05">
                                          <label class="custom-control-label" for="email05"> New membership approval</label>
                                       </div>
                                       <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="email06" checked="">
                                          <label class="custom-control-label" for="email06"> Member registration</label>
                                       </div>
                                    </div>
                                 </div>
                                 <button type="reset" class="btn btn-outline-primary mr-2">Cancel</button>
                                 <button type="submit" class="btn btn-primary">Submit</button>
                              </form>
                           </div>
                        </div>
                     </div> --}}
                     <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                        <div class="card">
                           <div class="card-header d-flex justify-content-between">
                              <div class="header-title">
                                 <h4 class="card-title">Manage Contact</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form>
                                 <div class="form-group">
                                    <label for="cno">Contact Number:</label>
                                    <input type="text" class="form-control" id="cno" value="{{$user_details->phone}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control" id="email" value="{{$user_details->email}}">
                                 </div>
                                 <div class="form-group">
                                    <label for="url">Url:</label>
                                    <input type="text" class="form-control" id="url" value="{{$user_details->portfolio_url}}">
                                 </div>
                                 <button type="reset" class="btn btn-outline-primary mr-2">Cancel</button>
                                 <button type="submit" class="btn btn-primary">Submit</button>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
    </div>
    @include('structures.footer')
    @include('structures.footer_scripts')
    <!-- Wrapper End-->
    {{-- <footer class="iq-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="../backend/privacy-policy.html">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="../backend/terms-of-service.html">Terms of Use</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 text-right">
                    <span class="mr-1">
                        Copyright
                        <script>document.write(new Date().getFullYear())</script>© <a href="#" class="">Datum</a>
                        All Rights Reserved.
                    </span>
                </div>
            </div>
        </div>
    </footer>    <!-- Backend Bundle JavaScript --> --}}
    {{-- <script src="../assets/js/backend-bundle.min.js"></script>
    <!-- Chart Custom JavaScript -->
    <script src="../assets/js/customizer.js"></script>
    
    <script src="../assets/js/sidebar.js"></script>
    
    <!-- Flextree Javascript-->
    <script src="../assets/js/flex-tree.min.js"></script>
    <script src="../assets/js/tree.js"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="../assets/js/table-treeview.js"></script>
    
    <!-- SweetAlert JavaScript -->
    <script src="../assets/js/sweetalert.js"></script>
    
    <!-- Vectoe Map JavaScript -->
    <script src="../assets/js/vector-map-custom.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="../assets/js/chart-custom.js"></script>
    <script src="../assets/js/charts/01.js"></script>
    <script src="../assets/js/charts/02.js"></script>
    
    <!-- slider JavaScript -->
    <script src="../assets/js/slider.js"></script>
    
    <!-- Emoji picker -->
    <script src="../assets/vendor/emoji-picker-element/index.js" type="module"></script>
    
    
    <!-- app JavaScript -->
    <script src="../assets/js/app.js"></script>   --}}
</body>
</html>