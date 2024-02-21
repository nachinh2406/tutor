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
  $("#contractId").select2();
  // DataTable with buttons
  // --------------------------------------------------------------------

  if (dt_basic_table.length) {
     dt_basic = dt_basic_table.DataTable({
      ajax: '/admin/api/classes-register',
      columns: [
        { data: 'id' },
        { data: 'full_name' },
        { data: 'email' },
        { data: 'start_date' },
        { data: 'salary' },
        { data: '' },
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
        render: function (data, type, full, meta) {
            return full['code_class'];
        }
        },
        {
          // Label
          targets: 2,
          responsivePriority: 3,
          render: function (data, type, full, meta) {
            var className = full['class']["name_class"];
            var subjectName = full['subject']["name"];
            return subjectName + "-" + className;
          }
        },
        {
            // Label
            targets: 3,
            responsivePriority: 2,
            render: function (data, type, full, meta) {
              return full["price_class"]+" ₫";
            }
          },
          {
            // Label
            targets: 4,
            orderable: false,
            responsivePriority: 1,
            render: function (data, type, full, meta) {
                return `<span class="badge bg-primary">${full["fee__percentage_class"]}%</span>`
            }
          },
          {
            // Label
            targets: 5,
            orderable: false,
            responsivePriority: 1,
            render: function (data, type, full, meta) {
                return `<span class="badge bg-primary">${full["number_lesson_week"]}</span>`
            }
          },
        {
          // Label
          targets: 6,
          render: function (data, type, full, meta) {
            var $status_number = full['status'];
            var $status = {
              1: { title: 'Trạng thái chờ', class: 'badge-light-primary' },
              2: { title: 'Trạng thái đã giao', class: ' badge-light-success' },
              0: { title: 'Trạng thái hủy', class: ' badge-light-danger' },
            };
            return (
              '<span class="badge rounded-pill ' +
              $status[$status_number].class +
              '">' +
              $status[$status_number].title +
              '</span>'
            );
          }
        },
        {
          // Actions
          targets: 7,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) {
            let filter = "";
            console.log(full['status']);
            if(full['status'] == 1) {
                filter = `<a href="#javascript" onClick="handleShowFilter(${full['id']})" ><span class="badge bg-secondary"><i class="fas fa-filter"></i></span></a>`;
            }
            return `<a href="/admin/classes-register/${full['id']}/edit"><span class="badge bg-primary"><i class="fas fa-pen-to-square"></i></span></a>
                    <a href="javascript:void(0);"><span class="badge bg-danger"
                    onclick="if (confirm('Are you sure to delete this record?'))
                    {document.getElementById('delete-class-register-${full['id']}').submit();} else {return false;}"
                    ><i class="fas fa-trash"></i></span></a>

                    <form action="/admin/classes-register/${full['id']}"
                        method="POST"
                        id="delete-class-register-${full['id']}" class="d-none">
                        <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                    <a href="#javascript" onClick="handleShowUsers(${full['id']})"><span class="badge bg-warning"><i class="fas fa-circle-arrow-right"></i></span></a>
                    <a href="#javascript" onClick="handleShowAssignHistory(${full['id']})"><span class="badge bg-info"><i class="fas fa-clock-rotate-left"></i></span></a>
                    ${filter}
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
    window.location.replace("/admin/classes-register/create");
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
  $('#form-assign').validate({

    submitHandler: function(form) {
        const userId = $("#addMemberSelect").val();
        const classId = $("#class_id").val();
        $.ajax({
            url: `/admin/api/classes-register/${classId}/class/${userId}/assign`,
            type: form.method,
            data: $(form).serialize(),
            dataType:"json",
            success: function(response) {
                toastr['success'](response.message, { showDuration: 300, rtl: false });
                $("#assignClassRegister").modal("hide");
                dt_basic.ajax.reload( null, false );
                // setTimeout(() => {
                //     location.reload();
                // }, 2000);
            },
            error: function(response)
            {
                if(response.status == 500) {
                    toastr['error'](response.responseJSON.message, { showDuration: 300, rtl: false });
                }
            }
        });
    }
});
});
function handleShowUsers(idClass, idUser = false) {
    $("#listFilterUsers").modal("hide");
    $("#assignClassRegister").modal("show");
    $("#class_id").val(idClass);
    $("#contractId").val("").change();
    $.ajax({
        type: "GET",
        url: "/admin/api/users",
        data: {id_class:idClass},
        dataType: "json",
        success: function (response) {
            const dataUsers = response.data;
            let listHtmlUsers = "";
            let listOptions = '<option value="" label="Thực hiện giao lớp ngay và luôn..."></option>';
            let checkExistUser;
            $.each(dataUsers, function (i, v) {
                const classSelected = v.classes[0];
                const checkSelected = classSelected ? (classSelected.id == idClass ? "selected" : "") : "";
                if(classSelected) checkExistUser = classSelected;
                listHtmlUsers += `<li class="list-group-item d-flex align-items-start border-0 px-0">
                                    <div class="avatar me-75">
                                        <img src="${ROOT_S3+v.image?.url}" alt="avatar" width="38" height="38" />
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between w-100">
                                        <div class="me-1">
                                            <h5 class="mb-25">${v.name}</h5>
                                            <span>${v.email}</span>
                                        </div>
                                    </div>
                                </li>`;
                listOptions += `<option ${checkSelected} data-avatar="${v.image?.url}" value="${v.id}">${v.name}</option>`;
            });
            $(".list-group").html(listHtmlUsers);
            $("#addMemberSelect").html(listOptions);
            if(idUser) $("#addMemberSelect").val(idUser).change();
            $("#contractId").val(checkExistUser?.pivot?.contract_id).change();

        }
    });
}

function handleShowFilter(idClass) {
    $("#listFilterUsers").modal("show");
    $("#titleFilter").html("Lọc gia sư phù hợp...");
    $.ajax({
        type: "GET",
        url: `/admin/api/classes-register/${idClass}/filter/tutors`,
        dataType: "json",
        success: function (response) {
            console.log(response);
            let htmlResponses = "";
            $("#FilterUsers").html("");
            if(response.length == 0) {
                $("#FilterUsers").html(`<tr><td colspan='7' class='text-center'>Không có dữ liệu</td></tr>`);
                return;
            }
            $.each(response, function (i, v) {
                htmlResponses += `<tr>
                                    <td>
                                        <span class="fw-bold">${v.name}</span>
                                    </td>
                                    <td>${v.phone}</td>
                                    <td>${v.email}</td>
                                    <td>${v?.school?.name}</td>
                                    <td>${v.major_name}</td>
                                    <td>${v.position == 1 ? "Giáo viên" : (v.position == 2 ? "Sinh viên" : "--")}</td>
                                    <td class='text-center'><a href="#javascript" onClick="handleShowUsers(${idClass}, ${v.id})"><span class="badge bg-warning"><i class="fas fa-circle-arrow-right"></i></span></a></td>
                                </tr>`
            });
            $("#FilterUsers").html(htmlResponses);
        }
    });
}
function handleShowAssignHistory(idClass) {
    // call api thực hiện lấy danh sách lớp
    $("#listAssignedUsers").modal("show");
    $("#titleAssign").html("Lịch sử lớp được giao");
    let status = {
        1: { title: 'Đã nhận', class: ' badge-light-success' },
        0: { title: 'Bị hủy', class: ' badge-light-danger' },
      };
    $.ajax({
        type: "GET",
        url: `/admin/api/classes-register/${idClass}/userAssigned`,
        dataType: "json",
        success: function (response) {
            let htmlResponses = "";

            $.each(response, function (i, v) {
                htmlResponses += `<tr>
                                    <td>
                                        <span class="fw-bold">${v.name}</span>
                                    </td>
                                    <td>${v.email}</td>
                                    <td>${v?.school?.name}₫</td>
                                    <td>${v.major_name}</td>
                                    <td>${v.position == 1 ? "Giáo viên" : (v.position == 2 ? "Sinh viên" : "--")}</td>
                                    <td>${v?.pivot?.file_contract ?? "--"}</td>
                                    <td>${v?.created_at_assign ?? "--"}</td>
                                    <td><span class="badge rounded-pill ${status[v.pivot.status].class}">${status[v.pivot.status].title}</span></td>
                                </tr>`
            });
            $("#UserAssigned").html(htmlResponses);
        }
    });
}
