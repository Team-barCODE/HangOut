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
