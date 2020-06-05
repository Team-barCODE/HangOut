  $('#file_photo1').on('change',function(e){
    var reader = new FileReader();
    reader.onload = function(e) {
        $('.file_photo1').css({'background-image':'','background-color':'transparent'});
        $('.signupPage .file_photo1 .fa-camera').css('color','transparent');
        $('.file_photo1').css('background-image','url(' + e.target.result +')');
    }
    reader.readAsDataURL(e.target.files[0]);
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


  $('.hamburgeranime').click(function(){
    $('.hamburgeranime').stop().toggleClass('active');
    $('.gnavi-contents').stop().slideToggle();
  });
  $(window).resize(function(){
    var bodyWidth = $('body').width();
    if(bodyWidth < 768){
      $('.gnavi-contents').hide();
    }else{
      $('.gnavi-contents').show();
      $('.gnavi-contents').css('height','auto');
      $('.hamburgeranime').stop().removeClass('active');
    }
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