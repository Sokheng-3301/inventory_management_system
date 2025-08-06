@php
  // dd(Auth::user());
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.meta')
    <title>{{__('nav.login')}} | IMS</title>

    <style>

        @font-face {
            font-family: 'Akbalthom Naga';
            src: url({{ asset('fonts/AKbalthom-Naga.ttf') }});
        }

        @font-face {
            font-family: 'Poppins';
            src: url({{ asset('fonts/Poppins-Regular.ttf') }});
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        label,
        span,
        ul,
        li,
        a,
        input,
        textarea,
        select,
        small,
        div,
        section,
        select,
        table,
        th,
        td,
        button {
            font-family: 'Poppins', 'Akbalthom Naga', sans-serif !important;
        }

        .input-group-prepend{
            width: 100%;
        }
        .input-group-text{
            cursor: pointer;
        }
        /* .content-wrapper{
          background-image: url('{{asset('images/video-thumnail.jpg')}}');
          background-position:center;
          background-repeat: no-repeat;
        } */
        .auth-form-light{
            backdrop-filter: blur(15px); /* Apply blur effect */
            /* box-shadow: 0 1px 6px rgba(0, 81, 132, 0.677); */
            border-radius: 5px;
            background: white;
        }
        body{
          background: #f7f7f7;
        }
        #backgroundLogin{
          background: url('{{asset("images/Hi-Tech-AE-Prepare-Same-Res-but-15MB.gif")}}');
          background-position: left;
          background-size:55%;
          width: 100%;
          height: 100%;
          position: fixed;
          display: flex;
          float: left;
          align-items: center;
          justify-content: right;
          background-repeat: repeat-x;
          position: fixed;
          /* background-attachment: fixed; */
        }
        #backgroundLogin .filter{
          width: 100%;
          height: 100%;
          position: absolute;
          background: #a4a4a471;
        }
    </style>
</head>

<body>
  <div id="backgroundLogin">
    <div class="filter">

    </div>
    {{-- <div class="container-scroller"> --}}
      {{-- <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0" > --}}
          <div class="row w-100 mx-0">
            {{-- <div class="col-lg-4">
              <img src="{{asset('images/Hi-Tech-AE-Prepare-Same-Res-but-15MB.gif')}}" width="" alt="">
            </div> --}}
            <div class="col-9 col-sm-10 col-md-7 col-lg-4 col-xl-3 mx-auto">
              <div class="auth-form-light text-left py-5 px-4">
                <div class="brand-logo text-center mb-5">
                  <img src="{{asset('images/Hi-Tech Water Logo (ENG)-01.png')}}" width="45%" alt="logo">
                </div>
                <h4> {{__('nav.grettingLogin')}} </h4>
                <h6 class="font-weight-light"> {{__('nav.singinToContinue')}} </h6>
                {{-- <p>{{bcrypt('123')}}</p> --}}
                {{-- <p>{{bcrypt(666666)}}</p> --}}
                <form class="pt-3 ui form" method="POST" autocomplete="off" action="{{route('login.save')}}">
                  @csrf
                  <div class="ui left icon input d-block w-100 field ui input @error('email')
                                error
                              @enderror">

                    <input type="text" class="d-block w-100" id="email" placeholder="{{__('nav.username')}}"  name="email" value="{{old('email')}}">
                    <i class="user icon"></i>

                    {{-- @error('email')
                      <span class="invalid-feedback">Invalid username or password.</span>
                    @enderror --}}
                  </div>

                  <div class="ui left icon input d-block w-100 field mt-4 ui input @error('email')
                                error
                              @enderror">
                    <input type="password" id="password" class="d-block w-100 " id="password" placeholder="{{__('nav.password')}}" name="password">
                    <i class="lock icon"></i>
                  </div>
                  @error('email')
                  <small class="text-danger fs-sm">
                    {{ __('nav.invalidLogin') }}
                  </small>
                    {{-- <span class="text-danger"></span> --}}
                  @enderror
                  {{-- <div class="d-flex align-items-center justify-content-center"> --}}
                    {{-- <input type="checkbox" id="eyeBtn" onclick="password()" class="d-inline"> <label for="eyeBtn" class="d-inline">{{__('nav.showPass')}}</label> --}}
                  {{-- </div> --}}
                    {{-- <div class="input-group">
                      <div class="input-group-prepend">

                          <span class="input-group-text" id="eyeBtn" onclick="password()">
                              <span class="mdi mdi-eye-off-outline" id="eyeIcon"></span>
                          </span>
                      </div>
                    </div> --}}

                  <div class="my-1 d-flex justify-content-between align-items-center">
                      <div class="form-check">
                        <label class="form-check-label text-muted">
                          <input type="checkbox" class="form-check-input" id="eyeBtn">
                          {{__('nav.showPass')}}
                        </label>
                      </div>
                      {{-- <a href="#" class="auth-link text-black">Forgot password?</a> --}}
                    </div>
                  <div class="mt-3">
                    <button type="submit" class="ui button tiny blue d-block w-100 font-weight-medium auth-form-btn" >
                      <i class="icon sign-in"></i>
                      {{__('nav.signinBtn')}}</button>
                  </div>

                  {{-- <div class="mb-2">
                    <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                      <i class="ti-facebook mr-2"></i>Connect using facebook
                    </button>
                  </div>
                  <div class="text-center mt-4 font-weight-light">
                    Don't have an account? <a href="register.html" class="text-primary">Create</a>
                  </div> --}}
                </form>
              </div>
            </div>
          </div>
        {{-- </div>
      </div> --}}
    {{-- </div> --}}

  </div>

  @include('layout.script')

@if (session() -> has('error'))
    <script>
       const Toast = Swal.mixin({
                    toast: true,
                    position: "top",
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                    });
                    Toast.fire({
                    icon: "error",
                    title: "Invalid usename or password!"
                    });
    </script>
@endif

@if (session() -> has('blocked'))
    <script>
       const Toast = Swal.mixin({
                    toast: true,
                    position: "top",
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                    });
                    Toast.fire({
                    icon: "error",
                    title: "Your accoutn has blocked!"
                    });
    </script>
@endif

<script>
      const togglePassword = document.getElementById('eyeBtn');
      const passwordInput = document.getElementById('password');
      const eye = document.getElementById('eyeIcon');


      togglePassword.addEventListener('click', function () {
          // Toggle the type attribute
          const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordInput.setAttribute('type', type);

          // Toggle the eye icon or text
          // if(this.textContent = type === 'password'){
          //   eye.classList.remove('mdi-eye-off-outline')
          //   eye.classList.add('mdi-eye-outline')
          // }else{
          //   eye.classList.remove('mdi-eye-off-outline')
          // }

          if(type === 'password'){
            // alert('password');
            eye.classList.remove('mdi-eye-outline')
            eye.classList.add('mdi-eye-off-outline')
              // alert('open ey');
          }else{
              eye.classList.remove('mdi-eye-off-outline')
              eye.classList.add('mdi-eye-outline')
          }
      });
    // $(document).ready(function () {
    //     $('#eyeBtn').change(function(){
    //         $('#password').attr('text');
    //     });
    //     $('.selectpicker').selectpicker();
    //     $("#chosen_select").selectpicker();
    // });

    $('.ui.form')
      .form({
        fields: {
          email: {
            identifier: 'email',
            rules: [
              {
                type   : 'empty',
                prompt : 'Please enter email'
              }
            ]
          },

          password: {
            identifier: 'password',
            rules: [
              {
                type   : 'empty',
                prompt : 'Please enter a password'
              }
              // ,
              // {
              //   type   : 'minLength[6]',
              //   prompt : 'Your password must be at least {ruleValue} characters'
              // }
            ]
          },
        }
      });
</script>
</body>

</html>
