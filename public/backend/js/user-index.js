/**her
 * DataTables Basic
 */
var calendar;
$(function () {
    'use strict';

    var dt_basic_table = $('.datatables-basic'),

        dt_date_table = $('.dt-date');
      // assetPath = '../../../app-assets/';

    if ($('body').attr('data-framework') === 'laravel') {
      assetPath = $('body').attr('data-asset-path');
    }

    // DataTable with buttons
    // --------------------------------------------------------------------

    if (dt_basic_table.length) {
      var dt_basic = dt_basic_table.DataTable({
        ajax: '/admin/api/users',
        columns: [
          { data: 'id' },
          { data: 'name' },
          { data: 'phone' },
          { data: 'gender' },
          { data: 'position' },
          { data: 'school_id' },
          { data: 'major_name' },
          { data: 'is_honnor' },
          { data: 'status' },
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
          width:100,
          orderable: false,
          render: function (data, type, full, meta) {
              return "<b>"+full['name']+"</b>";
          }
          },
          {
            // Label
            targets: 2,
            render: function (data, type, full, meta) {
              return full['phone'] ?? "";
            }
          },
          {
              width:80,
              targets: 3,
              render: function (data, type, full, meta) {
                return full["gender"] == 1 ? "Nam" : (full["gender"] == 0 ? "Nữ" : "");
              }
            },
            {
              // Label
              targets: 4,
              orderable: false,
              render: function (data, type, full, meta) {
                return full["position"] == 1 ? "Giáo viên" : (full["position"] == 2 ? "Sinh viên" : "");
              }
            },
            {
              // Label
              targets: 5,
              width:150,
              orderable: false,
              render: function (data, type, full, meta) {
                return full["school"] ? full["school"]["name"] : "";
              }
            },
            {
                // Label
                targets: 6,
                orderable: false,
                render: function (data, type, full, meta) {
                  return full["major_name"];
                }
              },
              {
                // Label
                targets: 7,
                orderable: false,
                render: function (data, type, full, meta) {
                  const honnor = full["is_honnor"];
                  const honnorLabel = {
                    1: { title: '--', class: ' badge-light-info' },
                    0: { title: 'Vinh danh', class: ' badge-light-success' },
                  };
                  return (
                    honnor == 1 ? '<span class="badge rounded-pill ' +
                    honnorLabel[honnor].class +
                    '">' +
                    '<i class="fas fa-award"></i>' +
                    '</span>'  : ""
                  );
                }
              },
          {
            // Label
            targets: 8,
            render: function (data, type, full, meta) {
              var $status_number = full['status'];
              var $status = {
                1: { title: 'Đang hoạt động', class: ' badge-light-success' },
                0: { title: 'Đang bị khóa', class: ' badge-light-danger' },
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
            targets: -1,
            title: 'Actions',
            orderable: false,
            render: function (data, type, full, meta) {
              return `
              <a href="#javascript" onclick="handleInfoUser(${full['id']})"><span class="badge badge-glow bg-info"><i class="fas fa-eye"></i></span></a>
              <a onclick="if (confirm('Bạn có đồng ý khóa user này không?'))
              {document.getElementById('update-status-user-${full['id']}').submit();} else {return false;}" href="#javascript"><span class="badge badge-glow bg-primary">${full['status'] == 1 ? '<i class="fas fa-lock"></i>' : '<i class="fas fa-lock-open"></i>'}</span></a>
              <form action="/admin/users/${full['id']}/update/status"
                method="POST"
                id="update-status-user-${full['id']}" class="d-none">
                <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
              </form>
              <a href="#javascript" onclick="document.getElementById('update-honnor-user-${full['id']}').submit();"><span class="badge badge-glow bg-danger"><i class="fas fa-award"></i></span></a>
              <form action="/admin/users/${full['id']}/update/honnor"
                method="POST"
                id="update-honnor-user-${full['id']}" class="d-none">
                <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
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
  });



  document.addEventListener('DOMContentLoaded', function() {
    calendarEl = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'local',
        events:[],
        headerToolbar: {
        start: '',
        end: ''
        },
        initialView: 'timeGridWeek',
        validRange: { // Cụ thể một lịch trong tuần để show ra các lịch dạy các thứ trong tuần, lịch ngày thì không phải quan tâm
            start: '2023-03-19',
            end: '2023-03-26'
        },
        slotLabelFormat:
            {
            hour: 'numeric',
            minute: '2-digit',
            omitZeroMinute: false,
            hour12: false
            },
        viewDidMount: function(event, element) {
            console.log("ok");
        $('.fc-col-header-cell').each(function() {
            const headerShowDay = $(this).children().children();
            const textHeader = headerShowDay.html().slice(0,3);
            headerShowDay.html(textHeader);
        });
    },
});
$("#calendar-tab").click(function() {
    calendar.render();
    $('.fc-col-header-cell').each(function() {
        const headerShowDay = $(this).children().children();
        const textHeader = headerShowDay.html().slice(0,3);
        headerShowDay.html(textHeader);
    });
})
});

  function handleInfoUser(idUser) {
    $(".nav-link").removeClass("active");
    $(".tab-pane").removeClass("active");
    $(".nav-pills .nav-link").first().addClass("active");
    $(".tab-pane").first().addClass("active");
    $("#info_user").modal("show");
    $("#title_user").html("Thông tin chi tiết gia sư");
    // call api thực hiện lấy danh sách lớp
    let status = {
        1: { title: 'Đã nhận', class: ' badge-light-success' },
        0: { title: 'Bị hủy', class: ' badge-light-danger' },
      };
    $.ajax({
        type: "GET",
        url: `/admin/users/${idUser}/info`,
        dataType: "json",
        success: function (response) {
            const userInfo = response.data.user;
            const cardInfo = response.data.card;
            const events = response.data.events;
            /* Thông tin gia sư */
            $(".name_info").html(userInfo?.name);
            $(".email_info").html(userInfo?.email);
            $(".phone_info").html(userInfo?.phone);
            $(".gender_info").html(userInfo?.gender == 1 ? "Nam" : (userInfo?.gender == 0 ? "Nữ" : ""));
            $(".born_info").html(userInfo?.date_of_birth);
            $(".info_school").html(userInfo?.school?.name);
            $(".info_major").html(userInfo?.major_name);
            $(".info_start_from").html(userInfo?.start_from);
            $(".info_end_from").html(userInfo?.end_from);
            $(".info_position").html(userInfo?.position == 1 ? "Giáo viên" : (userInfo?.position == 2 ? "Sinh viên" : ""));
            $(".info_experience").html(userInfo.is_experience ? "Đã có kinh nghiệm" : "Chưa có kinh nghiệm");
            $(".comment").html(userInfo.comment);
            /* End thông tin gia sư */

            /* Thông tin căn cước công dân */
            $("#number_card").val(cardInfo?.number_card);
            $("#date_card").val(cardInfo?.date_card);
            $("#expire_card").val(cardInfo?.expire_card);
            $("#address").val(cardInfo?.address);
            $(".photo_after img").attr("src", 'http://tutorproject.test/'+cardInfo?.photo_after);
            $(".photo_before img").attr("src", 'http://tutorproject.test/'+cardInfo?.photo_before);
            /* Kết thúc thông tin căn cước công dân */


            // các lớp từng nhận
            let htmlResponsesAssign = "";
            $.each(response.data.classedAssign, function (i, v) {
                htmlResponsesAssign += `<tr>
                                    <td>
                                        <span class="fw-bold">${v.code_class}</span>
                                    </td>
                                    <td>${v?.subject?.name + " - " + v?.class?.name_class}</td>
                                    <td>${v.price_class}₫</td>
                                    <td>${v.fee__percentage_class}%</td>
                                    <td>${v.number_lesson_week}</td>
                                    <td>${v.file_contract ?? "--"}</td>
                                    <td>${v?.created_at_assign ?? "--"}</td>
                                    <td><span class="badge rounded-pill ${status[v.pivot.status].class}">${status[v.pivot.status].title}</span></td>
                                </tr>`
            });
            $("#classAssigned").html(htmlResponsesAssign);
            // Kết thúc các lớp từng nhận


            /* Hiển thị lịch dạy */
               // remove all events
                calendar.getEvents().forEach(event => event.remove());
                calendar.addEventSource(events.length > 0 ? events : []);

            /* Kết thúc lịch dạy */
        }
    });
  }
