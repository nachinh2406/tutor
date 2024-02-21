$(document).ready(function() {
    $('#form-login').validate({
        rules: {
            email: {
              required: true
            },
            password: {
                required: true,
                minlength:8
            },
          },
          messages: {
            'email': {
                required: 'Vui lòng điền email',
                },
            'password': {
              required: 'Vui lòng điền mật khẩu',
              },
          },
      submitHandler: function(form) {
          form.submit();
      }
  });
  $('#form-register').validate({
    rules: {
        name: {
          required: true
        },
        email: {
          required: true,
        },
        password: {
            required: true,
            minlength:8
        },
        password_confirmation: {
          required: true,
          minlength:8,
          equalTo: '#new_password'
        },
      },
      messages: {
        'name': {
            required: 'Vui lòng điền tên thành viên',
            },
        'email': {
            required: 'Vui lòng điền email thành viên',
            },
        'password': {
          required: 'Vui lòng điền mật khẩu mới',
          minlength: 'Yêu cầu ít nhất 8 ký tự'
        },
        'password_confirmation': {
          required: 'Vui lòng xác nhận lại mật khẩu',
          minlength: 'Yêu cầu ít nhất 8 ký tự',
          equalTo: 'Mật khẩu xác nhận không chính xác'
        }
      },
     submitHandler: function(form) {
      form.submit();
    }
});
})

