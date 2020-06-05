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

	// ファイルチェック
	// $('#file_photo1').change(function() {
	// 	let file = $(this).prop('files')[0];
	// 	let fileSize = getFiseSize(file.size);
	// 	$('#file_status').html('ファイル名:' + file.name + ' / サイズ:' + fileSize + ' / 種類:' + file.type);
	// 	if(fileSize > 8388608){ //8MB
    //         $("#fileError_size").text("※8M以下のファイルにしてください");
    //      	return false;
    //     }else{
    //         $("#fileError_size").text("");
    //     }
    //     if (!file.type.match(/.(jpg|jpeg|gif|ping)$/i)){
    //         $("#fileError_type").text("※jpg,jpeg,gif,ping形式のファイルにしてください");
    //      	return false;
    //     }else{
    //         $("#fileError_type").text("");
    //     }

    // });

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
        if($("#file_photo1").val() == ""){
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
