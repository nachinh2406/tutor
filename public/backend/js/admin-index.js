/**her
 * DataTables Basic
 */

$(function () {
    'use strict';
    var dt_basic_table = $('.datatables-basic'),
        dt_basic,
        addMemberSelect = $('#addMemberSelect'),
        assetsPath = '../../../app-assets/',
        dt_date_table = $('.dt-date');
      // assetPath = '../../../app-assets/';

    if ($('body').attr('data-framework') === 'laravel') {
      assetPath = $('body').attr('data-asset-path');
    }
    $(".select2").select2();
    // DataTable with buttons
    // --------------------------------------------------------------------

    if (dt_basic_table.length) {
       dt_basic = dt_basic_table.DataTable({
        ajax: '/admin/api/admins',
        columns: [
          { data: 'id' },
          { data: 'name' },
          { data: 'email' },
          { data: 'phone' },
          { data: '' }
        ],
        columnDefs: [
           {
             // For Checkboxes
             targets: 0,
             orderable: false,
           },
          {
          // Label
          targets: 1,
          responsivePriority: 1,
          orderable: false,
          },
          {
            // Label
            targets: 2,
            responsivePriority: 3,
          },
          {
            // Label
            targets: 3,
            responsivePriority: 2,
            },
          {
            // Actions
            targets: -1,
            title: 'Actions',
            orderable: false,
            render: function (data, type, full, meta) {
              const jsonInfoUser = esc_attr(JSON.stringify(full));
              return `<a href="#javascript" onclick="handleEdit(${jsonInfoUser})"><span class="badge bg-primary"><i class="fas fa-pen-to-square"></i></span></a>
                      <a href="javascript:void(0);"><span class="badge bg-danger"
                      onclick="if (confirm('Are you sure to delete this record?'))
                      {document.getElementById('delete-admin-${full['id']}').submit();} else {return false;}"
                      ><i class="fas fa-trash"></i></span></a>

                      <form action="/admin/admins/${full['id']}"
                          method="POST"
                          id="delete-admin-${full['id']}" class="d-none">
                          <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                          <input type="hidden" name="_method" value="DELETE">
                      </form>
                      `;
            }
          }
        ],
        order: [[2, 'desc']],
        dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        displayLength: 10,
        lengthMenu: [10, 25, 50, 75, 100],
        buttons: [
          {
            text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Thêm mới',
            className: 'create-new btn btn-primary',
            attr: {
              'data-bs-toggle': 'modal',
              'data-bs-target': '#modals-slide-in'
            },
            init: function (api, node, config) {
              $(node).removeClass('btn-secondary');
            }
          }
        ],
        language: {
          paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
          }
        }
      });
    }

  $(".create-new").click(function (e) {
        $("#form-admin").trigger("reset");
        $("#email").prop("disabled",false);
        $("#password").prop("disabled",false);
        $("#password_confirmation").prop("disabled",false);
        $("#modal_admin").modal("show");
        $("#form-admin").attr("method", "POST");
        $("#form-admin").attr("action",'/admin/admins');
        $("#adminTitle").html("Thêm thành viên");
  });
    // Add New record
    // ? Remove/Update this code as per your requirements ?
    // Delete Record
    $('.datatables-basic tbody').on('click', '.delete-record', function () {
      dt_basic.row($(this).parents('tr')).remove().draw();
    });
    if (addMemberSelect.length) {
      function renderGuestAvatar(option) {
        if (!option.id) {
          return option.text;
        }

        var $avatar =
          "<div class='d-flex flex-wrap align-items-center'>" +
          "<div class='avatar avatar-sm my-0 me-50'>" +
          "<span class='avatar-content'>" +
          "<img src='" +
          ROOT_S3 +
          $(option.element).data('avatar') +
          "' alt='avatar' />" +
          '</span>' +
          '</div>' +
          option.text +
          '</div>';

        return $avatar;
      }

      addMemberSelect.wrap('<div class="position-relative"></div>').select2({
        placeholder: 'Thực hiện giao lớp ngay và luôn...',
        dropdownParent: addMemberSelect.parent(),
        templateResult: renderGuestAvatar,
        templateSelection: renderGuestAvatar,
        escapeMarkup: function (es) {
          return es;
        }
      });
    }
    $('#form-admin').validate({
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
              equalTo: '#password'
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
              required: 'Vui lòng điền mật khẩu',
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
          const userId = $("#addMemberSelect").val();
          const classId = $("#class_id").val();
          $.ajax({
                url: $(form).attr("action"),
                method: $(form).attr("method"),
              data: $(form).serialize(),
              dataType:"json",
              success: function(response) {
                  toastr['success'](response.message, { showDuration: 300, rtl: false });
                  $("#modal_admin").modal("hide");
                  dt_basic.ajax.reload( null, false );
              },
              error: function(response)
              {
                  if(response.status == 500) {
                      toastr['error'](response.responseJSON.message, { showDuration: 300, rtl: false });
                  }
                  else if(response.status == 422) {
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
  });
  function handleEdit(user) {
    $("#form-admin").trigger("reset");
    $("#modal_admin").modal("show");
    $("#form-admin").attr("method", "PUT");
    $("#form-admin").attr("action",'/admin/admins/'+user.id);
    $("#adminTitle").html("Cập nhật thành viên "+`<span class='text-success'>${user.name}</span>`);
    $("#name").val(user.name);
    $("#email").val(user.email).prop("disabled",true);
    $("#password").prop("disabled",true);
    $("#password_confirmation").prop("disabled",true);
    $("#phone").val(user.phone);
    $("#roles").val($.map( user.roles, (val, i )=>val.id)).change();

  }
  function esc_attr(string) {
    if (!string) {
      return "";
    }
    return ("" + string).replace(/[&<>"'\/\\]/g, function(s) {
      return {
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': '&quot;',
        "'": '&#39;',
        "/": '&#47;',
        "\\": '&#92;'
      }[s];
    });
  }
