
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="sign-up">
            <div class="modal-header">
                <div class="logo-thumb"><img src="{{asset("frontend/assets/img/logo-light.png")}}" class="img-fluid" alt="" />
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="ti-close"></i></span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <h4 class="modal-header-title">Đăng ký</h4>
                <div class="social-login">
                    <ul>
                        {{-- <li><a href="#" class="btn btn-outline-success"><i class="ti-facebook"></i>SignUp with Facebook</a></li>
                        <li><a href="#" class="btn btn-outline-warning"><i class="ti-linkedin"></i>SignUp with Linkedin</a></li> --}}
                    </ul>
                </div>
                <div class="login-form">
                    <form method="POST" id="form-register" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label>Tên đầy đủ</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Full Name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" name="password" id="new_password" class="form-control" placeholder="*******">
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md full-width pop-login">Tạo tài khoản</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="mf-link"><i class="ti-user"></i>Have An Account?<a href="javascript:void(0)" data-toggle="modal" data-target="#login" data-dismiss="modal"> Log In</a></div>
                {{-- <div class="mf-forget"><a href="#"><i class="ti-help"></i>Forget Password</a></div> --}}
            </div>
        </div>
    </div>
</div>
