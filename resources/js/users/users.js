// // なぜか動かん
// for(var i = 1 ; i <= 3 ; i++){
//   console.log(i);

//   $("#file_photo" + i ).on('change',function(e){
//     console.log(i);

//     var reader = new FileReader();
//     reader.onload = function(e) {
//         $(this).parents('.userProfileImg').css('background-image','');
//         $(this).parents('.userProfileImg').css('background-image','url(' + e.target.result +')');
//     }
//     reader.readAsDataURL(e.target.files[0]);
//   });
// }
  $('#file_photo1').on('change',function(e){
    var reader = new FileReader();
    reader.onload = function(e) {
        $('.file_photo1').css({'background-image':'','background-color':'transparent'});
        $('.fa-camera').css('color','transparent');
        $('.file_photo1').css('background-image','url(' + e.target.result +')');
    }
    reader.readAsDataURL(e.target.files[0]);
  });


  $('#file_photo2').on('change',function(e){
    var reader = new FileReader();
    reader.onload = function(e) {
        $('.file_photo2').css({'background-image':'','background-color':'transparent'});
        $('.fa-camera').css('color','transparent');
        $('.file_photo2').css('background-image','url(' + e.target.result +')');
    }
    reader.readAsDataURL(e.target.files[0]);
  });


  $('#file_photo3').on('change',function(e){
    var reader = new FileReader();
    reader.onload = function(e) {
        $('.file_photo3').css({'background-image':'','background-color':'transparent'});
        $('.fa-camera').css('color','transparent');
        $('.file_photo3').css('background-image','url(' + e.target.result +')');
    }
    reader.readAsDataURL(e.target.files[0]);
  });


  $('.hamburgeranime').click(function(){
    $('.hamburgeranime').toggleClass('active');
    $('.gnavi-contents').slideToggle();
  });
  $(window).resize(function(){
    var bodyWidth = $('body').width();
    if(bodyWidth < 768){
      $('.gnavi-contents').hide();
    }else{
      $('.gnavi-contents').show();
    }

  });

