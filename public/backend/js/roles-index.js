// Add new role Modal JS
//------------------------------------------------------------------
$(function () {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
   });
    var addRoleForm = $('#addRoleForm');
    // add role form validation
    addRoleForm.validate({
        rules: {
            name: {
                required: true
            },
            description: {
                required: true
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: $(form).attr("action"),
                method: $(form).attr("method"),
                data: $(form).serialize(),
                dataType:"json",
                success: function(response) {
                    toastr['success'](response.message, { showDuration: 300, rtl: false });
                    $("#addRoleModal").modal("hide");
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
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
    // reset form on modal hidden
    $('.modal').on('hidden.bs.modal', function () {
      $(this).find('form')[0].reset();
    });

    // add new role
    $(".add-new-role").click(function() {
        $("#addRoleModal").modal("show");
        $("#addRoleForm").attr("method", "POST");
        $("#addRoleForm").attr("action",'/admin/roles');
        $(".role-title").html("Thêm vai trò");
    })
    // Select All checkbox click
    const selectAll = document.querySelector('#selectAll'),
      checkboxList = document.querySelectorAll('[type="checkbox"]');
    selectAll.addEventListener('change', t => {
      checkboxList.forEach(e => {
        e.checked = t.target.checked;
      });
    });
  });

  function handleEditRole(roleId,roleName) {
    $("#addRoleModal").modal("show");
    $("#addRoleForm").attr("method", "PUT");
    $("#addRoleForm").attr("action",`/admin/roles/${roleId}`);
    $(".role-title").html("Cập nhật vai trò "+"<span class='text-primary'>"+roleName+"</span>");
    $.ajax({
        type: "get",
        url: `/admin/roles/${roleId}/edit`,
        dataType: "json",
        success: function (response) {
            const roles = $.map( response.permissions, function( v, i ) { return v.id });
            $("#name").val(response.name);
            $("#description").val(response.description);
            let countRole = $(".role-checkbox").length;
            let checkcountRole = 0;
            $(".role-checkbox").each(function(i, obj) {
                if(roles.includes($(this).data("id"))) {
                    $(this).prop('checked', true);
                    checkcountRole++;
                };
            });
            if(countRole == checkcountRole) $('#selectAll').prop('checked', true);
        }
    });
  }
  function handleDeleteRole(idRole) {
    Swal.fire({
        title: 'Bạn đồng ý xóa vai trò này ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#ddd',
        confirmButtonText: 'Đồng ý',
        cancelButtonText: 'Đóng'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: "/admin/roles/"+idRole,
                dataType: "json",
                success: function (response) {
                    toastr['success'](response.message, { showDuration: 300, rtl: false });
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                },
                error: function(response) {
                    if(response.status == 500) {
                        toastr['error'](response.responseJSON.message, { showDuration: 300, rtl: false });
                    }
                }
            });
        }
      })
  }
