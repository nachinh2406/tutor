$(function () {
  ('use strict');

  // variables
  var form = $('.validate-form'),
    select2 = $('.select2'),
    accountNumberMask = $('.account-number-mask');

  // jQuery Validation for all forms
  // --------------------------------------------------------------------
  if (form.length) {
    form.validate({
        rules: {
          current_password: {
            required: true
          },
          password: {
            required: true,
            minlength: 8
          },
          password_confirmation: {
            required: true,
            minlength: 8,
            equalTo: '#account-new-password'
          },
          apiKeyName: {
            required: true
          }
        },
        messages: {
        'current_password': {
            required: 'Vui lòng điền mật khẩu hiện tại',
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
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    toastr['success'](response.message, { showDuration: 300, rtl: false });
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                },
                error: function(response)
                {
                    if(response.status == 422) {
                        const errors = response.responseJSON.errors;
                         // Lặp qua từng lỗi và xử lý
                        for (let key in errors) {
                            const errorMessages = errors[key].join('<br>');
                            toastr['error'](errorMessages, { showDuration: 300, rtl: false });
                        }
                    }
                }
            });
        }
    });
  }

  //phone
  if (accountNumberMask.length) {
    accountNumberMask.each(function () {
      new Cleave($(this), {
        phone: true,
        phoneRegionCode: 'US'
      });
    });
  }

  // For all Select2
  if (select2.length) {
    select2.each(function () {
      var $this = $(this);
      $this.wrap('<div class="position-relative"></div>');
      $this.select2({
        dropdownParent: $this.parent()
      });
    });
  }
});
