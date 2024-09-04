<!DOCTYPE html>
<html lang="en">
    @include('structures.head')
  <body class=" ">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    
      <div class="wrapper">
    <section class="login-content">
         <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">
               <div class="col-md-5">
                  <div class="card p-5">
                     <div class="card-body">
                        <div class="auth-logo">
                           <img src="{{asset('templates/datum/images/logo.png')}}" class="img-fluid  rounded-normal  darkmode-logo" alt="logo">
                           <img src="{{asset('templates/datum/images/logo-dark.png')}}" class="img-fluid rounded-normal light-logo" alt="logo">
                        </div>
                        <h3 class="mb-3 text-center">Reset Password</h3>
                        <p class="text-center small text-secondary mb-3">You can reset your password here</p>
                        <form method="POST" action="{{route('landing.process_forgot_password')}}">
                            @csrf
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label class="text-secondary" for="email">Email</label>
                                    <input class="form-control" type="email" name="email" id="email" placeholder="Enter Your Account Email" value="{{old('email')}}">
                                 </div>
                              </div>
                           </div>
                           <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      </div>
      @include('structures.footer_scripts')
    
    </body>
</html>