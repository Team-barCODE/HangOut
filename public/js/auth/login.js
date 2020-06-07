'use strict';
(function(){
    //標準エラーメッセージの変更
    $.extend($.validator.messages, {
        email: '*正しいメールアドレスの形式で入力して下さい',
        required: '*入力必須です',
    });

    //入力項目の検証ルール定義
    var rules = {
        email: {
            required: true,
            email: true,
        },
        password: {
            required: true,
            minlength: 6,
            maxlength: 30,
        },
    };

    //入力項目ごとのエラーメッセージ定義
    var messages = {
        email: {
            required: "*メールアドレスを入力してください",
            email: "*メアドを入力してください"
        },
        password: {
            required: "*パスワードは必須です",
            minlength: "*パスワードは6文字以上です",
            maxlength: "*パスワードは30文字以内です",
        },
    };

    $(function(){
        $('form').validate({
            rules: rules,
            messages: messages,
            errorClass: "login_error",

            //エラーメッセージ出力箇所調整
            errorPlacement: function(error, element){
                error.insertAfter(element);
            }
        });
    });

  })();
