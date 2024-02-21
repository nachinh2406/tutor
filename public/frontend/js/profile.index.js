    $(document).ready(function() {
        $("#province_id").val(provinceId).change();
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

    });
    function handleLoadData(event,type,id) {
        console.log($(event.target).val());
        $.ajax({
            type: "get",
            url: "/api/administrative-units",
            data: {type, value:$(event.target).val()},
            dataType: "json",
            success: function (response) {
                let htmlResponse = `<option value="">Lựa chọn</option>`;
                $.each(response, function( key, data ) {
                    htmlResponse += `<option value="${data.id}">${data.name}</option>`;
                });
                $(id).html(htmlResponse);
                if(id == '#district_id')  $(id).val(districtId).change();
                if(id == '#ward_id')   $(id).val(wardId).change();
            }
        });
    }

