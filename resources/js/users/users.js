
$('#file_photo1').on('change',function(e){
  console.log("test");
  var reader = new FileReader();
  reader.onload = function(e) {
      $('.file_photo1').css({'background-image':'','background-color':'transparent'});
      $('.signupPage .file_photo1 .fa-camera').css('color','transparent');
      $('.file_photo1').css('background-image','url(' + e.target.result +')');
      console.log("Onroead");
  }
  console.log("test2");
  reader.readAsDataURL(e.target.files[0]);
  console.log(e.target.files[0]);
  console.log(e.target.files[0].size);
  console.log(e.target.files[0].type);
  console.log("test3");
  $("#fileError_required").text('');
  const photo1size = e.target.files[0].size;
  const photo1type = e.target.files[0].type;
  if(photo1size > 5242880){
		reader.abort();
		$('#fileError_size').text("※５Mバイト以下のファイルにしてください");
		$('#file_photo1').addClass("errored");
  } else if(photo1type != 'image/jpeg' && photo1type != 'image/jpg' && photo1type != 'image/gif' && photo1type != 'image/png' ) {
		reader.abort();
		$('#fileError_type').text("※jpeg,jpg,gif,png形式のファイルにしてください");
		$('#file_photo1').addClass("errored");
  } else {
		$('#fileError_size').text("");
		$('#fileError_type').text("");
		$('#file_photo1').removeClass("errored");
  }
});

  $('#file_photo2').on('change',function(e){
    var reader = new FileReader();
    reader.onload = function(e) {
        $('.file_photo2').css({'background-image':'','background-color':'transparent'});
        $('.signupPage .file_photo2 .fa-camera').css('color','transparent');
        $('.file_photo2').css('background-image','url(' + e.target.result +')');
    }
    reader.readAsDataURL(e.target.files[0]);
  });


  $('#file_photo3').on('change',function(e){
    var reader = new FileReader();
    reader.onload = function(e) {
        $('.file_photo3').css({'background-image':'','background-color':'transparent'});
        $('.signupPage .file_photo3 .fa-camera').css('color','transparent');
        $('.file_photo3').css('background-image','url(' + e.target.result +')');
    }
    reader.readAsDataURL(e.target.files[0]);
  });

  $('.userProfileImg_mini').on('click',function(){
    var bg = $(this).css('background-image');
    bg = bg.replace('url(','').replace(')','').replace(/\"/gi, "");
    $('.thumbnail').css('background-image','url(' + bg + ')');
  });
  $('.report_area').hide();
  $('.reportbtn').on('click',function(){
    $('.btn .fas').stop().toggleClass('active');
    $('.report_area').stop().slideToggle();
  });
  $('input[name="report"]').on('change',function(){
    var report_val = $(this).val();
    if(report_val >= 1 && report_val <= 4){
      $('.report_submit').removeClass('disabled');
    }else{
      $('.report_submit').addClass('disabled');
    }
  });
