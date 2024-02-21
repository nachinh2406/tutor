$(document).ready(function() {
    $("#province_id").val(provinceSelected).change();
})




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
            if(id == '#district_id')  $(id).val(districtSelected).change();
            if(id == '#ward_id')   $(id).val(wardSelected).change();
        }
    });
}
