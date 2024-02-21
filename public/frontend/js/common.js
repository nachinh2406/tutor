$(document).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
   });
   var accountUploadBtn = $('#account-upload'),
       accountUploadImg = $('#account-upload-img'),
       accountUserImage = $('.uploadedAvatar');

  if (accountUserImage) {
    var resetImage = accountUserImage.attr('src');
    accountUploadBtn.on('change', function (e) {
      var reader = new FileReader(),
        files = e.target.files;
      reader.onload = function () {
        if (accountUploadImg) {
          accountUploadImg.attr('src', reader.result);
        }
      };
      var formData = new FormData();
      formData.append("file", files[0]);
      $.ajax({
        type:'POST',
        url: "/profile/avatar/store",
        data: formData,
        enctype: 'multipart/form-data',
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
            toastr['success'](data.message, { showDuration: 300, rtl: false });
            reader.readAsDataURL(files[0]);
        },
        error: function(data){
            toastr['error']("Có lỗi xảy ra trong quá trình cập nhật avatar", { showDuration: 300, rtl: false });
        }
        });
    });
  }
})
