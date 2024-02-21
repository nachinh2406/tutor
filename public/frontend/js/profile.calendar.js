
document.addEventListener('DOMContentLoaded', function() {
    showTimeCalendar();
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'local',
        events:fetchEvents(),
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
        dateClick: function(info) {
            var date = moment(info.date).format('YYYY-MM-DD');
            var day = moment(info.date).format('ddd');
            var time = moment(info.date).format('H:mm');
            $(".add-event-btn").removeClass("d-none");
            $(".update-event-btn").addClass("d-none");
            $(".btn-delete-event").addClass("d-none");
            $("#calendar_id").val("");
            $(".date_class").val(date);
            $("#day_user").val(day);
            $("#start_time").val(time);
            $("#end_time").val(time);
            showTimeCalendar();
            $(".modal-title").html("Thêm lịch dạy cho lớp học");
            $("#add-new-sidebar").modal('show');
        },
        eventClick: function (event, jsEvent, view) {
            const idCalendar = event.event.id;
            const date = moment(event.event.start).format('YYYY-MM-DD');
            var day = moment(event.event.start).format('ddd');
            const startTime = moment(event.event.start).format('H:mm');
            const endTime = moment(event.event.end).format('H:mm');
            $(".add-event-btn").addClass("d-none");
            $(".update-event-btn").removeClass("d-none");
            $(".btn-delete-event").removeClass("d-none");
            $("#calendar_id").val(idCalendar);
            $(".date_class").val(date);
            $("#day_user").val(day);
            $("#start_time").val(startTime);
            $("#end_time").val(endTime);
            showTimeCalendar();
            $(".modal-title").html("Cập nhật lịch dạy cho lớp học");
            $("#add-new-sidebar").modal('show');
        },
        viewDidMount: function(event, element) {
        $('.fc-col-header-cell').each(function() {
            const headerShowDay = $(this).children().children();
            const textHeader = headerShowDay.html().slice(0,3);
            headerShowDay.html(textHeader);
        });
    },
    });
    calendar.render();
    let count = 1;
    $(".add-calendar-register-class").click(function() {
        if(count == 1) calendar.render();
        count++;
    })
    $('#form-calendar-register').validate({
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    toastr['success'](response.message, { showDuration: 300, rtl: false });
                    $("#add-new-sidebar").modal('hide');
                    var newEvent = {
                        id: response.data.id,
                        start: response.data.date + " " + response.data.start_time,
                        end: response.data.date + " " + response.data.end_time
                    }
                    if(!$("#calendar_id").val()) {
                        calendar.addEvent(newEvent);
                    } else updateEventInCalendar(newEvent, ["id","start","end"]);
                },
                error: function(error){
                    toastr['error'](error.message, { showDuration: 300, rtl: false });
                }
            });
        }
    });
    $(".btn-delete-event").click(function() {
        const idCalendar = $("#calendar_id").val();
        const urlDelete = '/profile/calendar/'+idCalendar+'/delete';
        $.ajax({
            type: "DELETE",
            url: urlDelete,
            dataType: "json",
            success: function (response) {
                toastr['success'](response.message, { showDuration: 300, rtl: false });
                $("#add-new-sidebar").modal('hide');
                calendar.getEventById(idCalendar).remove();
            },
            error: function(error){
                console.log(error);
                toastr['error'](error.message, { showDuration: 300, rtl: false });
            }
        });
    })
    function fetchEvents() {
        // Fetch Events from API endpoint reference
        var calendars = [];
        var response = $.ajax({
            url: "/profile/calendar/getEvents",
            data: {model:"USER"},
            type: 'GET',
            async: false,
            dataType:"JSON",
        });
        if(response.status == 200) {
            calendars = response.responseJSON.data;
        }
        return calendars;
    }
    const updateEventInCalendar = (updatedEventData, propsToUpdate) => {
    const existingEvent = calendar.getEventById(updatedEventData.id);
    for (var index = 0; index < propsToUpdate.length; index++) {
    var propName = propsToUpdate[index];
    existingEvent.setProp(propName, updatedEventData[propName]);
    }
    existingEvent.setDates(updatedEventData.start, updatedEventData.end, { allDay: updatedEventData.allDay });
    };

});
function showTimeCalendar() {
    $(".time_flatpickr").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
    });
}
function reloadPage() {
setTimeout(() => {
    location.reload();
}, 2000);
}
