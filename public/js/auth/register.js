'use strict';
$(function(){

	//バリデーション
	//必須項目チェック
    $(".required").blur(function(){
        if($(this).val() == ""){
            $(this).siblings('span.error_required').text("※入力必須項目です");
            $(this).addClass("errored");
        } else {
            $(this).siblings('span.error_required').text("");
            $(this).removeClass("errored");
        }
    });

    $('#register_photo').on('change',function(e){
        console.log("test");
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.register_photo').css({'background-image':'','background-color':'transparent'});
            $('.signupPage .register_photo .fa-camera').css('color','transparent');
            $('.register_photo').css('background-image','url(' + e.target.result +')');
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
                $('#register_photo').addClass("errored");
        } else {
                $('#fileError_size').text("");
                $('#register_photo').removeClass("errored");
        }

        if(photo1type != 'image/jpeg' && photo1type != 'image/jpg' && photo1type != 'image/gif' && photo1type != 'image/png' ) {
                reader.abort();
                $('#fileError_type').text("※jpeg,jpg,gif,png形式のファイルにしてください");
                $('#register_photo').addClass("errored");
        } else {
                $('#fileError_type').text("");
                $('#register_photo').removeClass("errored");
        }
      });

	//名前入力チェック
    $("#name").blur(function(){
        if(!$(this).val().match(/^.{1,40}$/)){
            $(this).siblings('span.error_name').text("※40文字以下にしてください");
            $(this).addClass("errored");
        } else {
            $(this).siblings('span.error_name').text("");
            $(this).removeClass("errored");
        }
	});

	//メールアドレス入力チェック
    $("#mail").blur(function(){
        if(!$(this).val().match(/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/)){
            $(this).siblings('span.error_mail').text("※メール形式で入力してください");
            $(this).addClass("errored");
        } else {
            $(this).siblings('span.error_mail').text("");
            $(this).removeClass("errored");
        }
	});

	//パスワードチェック
    $("#password").blur(function(){
        if(!$(this).val().match(/^.{6,20}$/)){
            $(this).siblings('span.error_password').text("※6文字以上20文字以下にしてください");
            $(this).addClass("errored");
        } else if(!$(this).val().match(/^[a-zA-Z0-9!-/:-@¥[-`{-~]*$/)){
            $(this).siblings('span.error_password').text("※半角英数記号のみ入力してください");
            $(this).addClass("errored");
        } else {
            $(this).siblings('span.error_password').text("");
            $(this).removeClass("errored");
        }
	});

	//パスワード確認チェック
    $("#password_confirmation").blur(function(){
        if(!$(this).val().match(/^.{6,20}$/)){
            $(this).siblings('span.error_password_confirmation').text("※6文字以上20文字以下にしてください");
            $(this).addClass("errored");
        } else if(!$(this).val().match(/^[a-zA-Z0-9!-/:-@¥[-`{-~]*$/)){
            $(this).siblings('span.error_password_confirmation').text("※半角英数記号のみ入力してください");
            $(this).addClass("errored");
        } else {
            $(this).siblings('span.error_password_confirmation').text("");
            $(this).removeClass("errored");
        }
	});

	// 日付チェック
    // $("#datepicker").on('change', function(){
    //     if(!$(this).val().match(/^\d{1,4}(\/|-)\d{1,2}\1\d{1,2}$/)){
    //         $(this).siblings('span.error_datepicker').text("※日付形式にしてください");
    //         $(this).addClass("errored");
    //     } else {
    //         $(this).siblings('span.error_datepicker').text("");
    //         $(this).removeClass("errored");
    //     }
	// });

	//エリアチェック（漢字のみ
    $("#prefecture").change(function(){
        if(!$(this).val().match(/^[亜-黑]+$/)){
            $(this).siblings('span.error_prefecture').text("※正しい形式で入力してください");
            $(this).addClass("errored");
        } else {
            $(this).siblings('span.error_prefecture').text("");
            $(this).removeClass("errored");
        }
    });

    //送信時の必須項目入力チェック
    $("#submit_register").on('click',function(){
        if($("#register_photo").val() == ""){
            $("#fileError_required").text('※入力必須項目です');
        }
        $(".required").each(function(){
            if($(this).val() == ""){
                $(this).siblings('span.error_required').text("※入力必須項目です");
                $(this).addClass("errored");
            }
        });
        if($(".errored").length){
            return false;
        }
    });

    $("#datepicker").datepicker({
        showMonthAfterYear: true,
        yearSuffix: '年',
        monthNamesShort:["1月","2月","3月","4月","5月","6月","7月","8月","9月","10月","11月","12月"],
        dayNamesMin: ['日', '月', '火', '水', '木', '金', '土'],
        dateFormat: 'yy-mm-dd',
        showAnim: 'fadeIn',
        showMonthAfterYear: true,
        changeYear: true,
        changeMonth: true,
        yearRange: "-100:-20",
        maxDate: '-240m',
        hideIfNoPrevNext: true,
        defaultDate:"2000-01-01"
    });
});
