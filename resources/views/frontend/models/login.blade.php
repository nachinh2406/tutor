<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="registermodal">
            <div class="modal-header">
                <div class="logo-thumb">
                    <img src="{{asset("frontend/assets/img/logo-light.png")}}" class="img-fluid" alt="" />
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="ti-close"></i></span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <h4 class="modal-header-title">Đăng nhập</h4>
                <div class="social-login">
                    <ul>
                        {{-- <li><a href="#" class="btn connect-fb"><i class="ti-facebook"></i>Login with Facebook</a></li>
                        <li><a href="#" class="btn connect-linked"><i class="ti-linkedin"></i>Login with Linkedin</a></li> --}}
                    </ul>
                </div>
                <div class="login-form">
                    <form action="{{ route('login') }}" id="form-login" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-with-icon">
                                <input type="text" name="email" id="email" class="form-control"  placeholder="Email">
                                <i class="ti-user"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <div class="input-with-icon">
                                <input type="password" name="password" class="form-control" id="password"  placeholder="*******">
                                <i class="ti-unlock"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md full-width pop-login">Đăng nhập</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="mf-link"><i class="ti-user"></i>Bạn chưa có tài khoản?<a href="javascript:void(0)" data-toggle="modal" data-target="#signup" data-dismiss="modal">Đăng ký tại đây</a></div>
                {{-- <div class="mf-forget"><a href="#"><i class="ti-help"></i>Forget Password</a></div> --}}
            </div>
        </div>
    </div>
</div>
