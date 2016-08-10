var adding = false;

(function( $ ){

    $("#newMsg").on('click', function(){
        if (adding) return;
        adding = true;
        $('<tr id="new"><td id="mid"></td><td><input type="text" placeholder="Имя" class="form-control" name="name_N" id="name_N"></td>' +
            '<td><input type="text" placeholder="телефон" class="form-control" name="phone_N" id="phone_N"></td>' +
            '<td><input type="text" placeholder="email" class="form-control" name="mail_N" id="mail_N"></td>' +
            '<td><input type="text" placeholder="сообщение" class="form-control" name="message_N" id="message_N"></td>' +
            '<td>'+$(new Date())[0].toISOString()+'</td>' +
            '<td id="cntrls" width="100"><button type="button" class="btn btn-default btn-sm" onclick="saveConfirm()">' +
            '<span class="glyphicon glyphicon-ok"></span></button>  ' +
            '<button type="button" class="btn btn-warning btn-sm" onclick="dismiss()">' +
            '<span class="glyphicon glyphicon-remove"></span></button></td></tr>').insertAfter($("tr:first"));
        return;
    });

    $("#msglist").on('click', ".editMsg", function(){
        var id = $(this).data('id');
        // $(this).closest('tr').find('input').prop('disabled', false);
        $(this).closest('tr').find('input').removeAttr('disabled');
        $(this).closest('td').html('<button type="button" class="btn btn-default btn-sm confirmEd" data-id="'+id+'">' +
            '<span class="glyphicon glyphicon-ok"></span></button>  ' +
            '<button type="button" class="btn btn-warning btn-sm cancelEd" data-id="'+id+'">' +
            '<span class="glyphicon glyphicon-remove"></span></button>');
        return;
    });

    $("#msglist").on('click', ".delMsg", function(){
        //
        if (!confirm('Точно удаляем?')) return;
        var id = $(this).data('id');
        var currRow = $(this).closest('tr');
        //----------------
        $.ajax({
            type: 'POST',
            url: '/index/remove',
            data: {id: id},
            success: function(data) {
                //
                if (data=='OK') {
                    adding = false;
                    $("#svli").fadeIn();
                    $("#errmsg").removeClass('btn btn-warning').html('').show();
                    $("#errmsg").addClass('btn btn-success').html('Сообщение удалено').fadeOut({duration:3000});
                    currRow.remove();
                }
                else {
                    // alert(data);
                    $("#svli").fadeIn();
                    $("#errmsg").removeClass('btn btn-success').html('').show();
                    $("#errmsg").addClass('btn btn-warning').html(data).fadeOut({duration:5000});
                }
            },
            error:  function(xhr, str){
                $("#svli").fadeIn();
                $("#errmsg").removeClass('btn btn-success').html('').show();
                $("#errmsg").addClass('btn btn-warning').html('Произошла ошибка :(' + xhr.responseCode).fadeOut({duration:5000});
            }
        });
    });

    $("#msglist").on('click', '.cancelEd', function(){
        var id = $(this).data('id');
        $(this).closest('tr').find('input').prop("disabled", true);
        $(this).closest('td').html('<a type="button" class="btn btn-default btn-sm editMsg" data-id="'+id+'">' +
            '<span class="glyphicon glyphicon-pencil"></span></a> ' +
            '<a type="button" class="btn btn-danger btn-sm delMsg" data-id="'+id+'">' +
            '<span class="glyphicon glyphicon-trash"></span></a>');

        return;
        });

    $("#msglist").on('click', '.confirmEd', function(){
        var id = $(this).data('id');
        var name = $('#name'+id).val();
        var phone = $('#phone'+id).val();
        var mail = $('#mail'+id).val();
        var message = $('#message'+id).val();
        var currRow = $(this);
        console.log(id,name,phone,mail,message);
        //----------------
        $.ajax({
            type: 'POST',
            url: '/index/store',
            data: {id: id, name: name, phone: phone, mail: mail, message: message},
            success: function(data) {
                //
                if ($.isNumeric(data)) {
                    adding = false;
                    $("#svli").fadeIn();
                    $("#errmsg").removeClass('btn btn-warning').html('').show();
                    $("#errmsg").addClass('btn btn-success').html('Сообщение сохранено').fadeOut({duration:3000});
                    //----------------------------------------
                    currRow.closest('tr').find('input').prop("disabled", true);
                    currRow.closest('td').html('<a type="button" class="btn btn-default btn-sm editMsg" data-id="'+id+'">' +
                        '<span class="glyphicon glyphicon-pencil"></span></a> ' +
                        '<a type="button" class="btn btn-danger btn-sm delMsg" data-id="'+id+'">' +
                        '<span class="glyphicon glyphicon-trash"></span></a>');
                }
                else {
                    // alert(data);
                    $("#svli").fadeIn();
                    $("#errmsg").removeClass('btn btn-success').html('').show();
                    $("#errmsg").addClass('btn btn-warning').html(data).fadeOut({duration:5000});
                }
            },
            error:  function(xhr, str){
                $("#svli").fadeIn();
                $("#errmsg").removeClass('btn btn-success').html('').show();
                $("#errmsg").addClass('btn btn-warning').html('Произошла ошибка :(' + xhr.responseCode).fadeOut({duration:5000});
            }
            });
        });

})( jQuery );

function dismiss() {
    adding = false;
    $('tr#new').remove();
}

function saveConfirm() {
    //----------------
    var name = $('#name_N').val();
    var phone = $('#phone_N').val();
    var mail = $('#mail_N').val();
    var message = $('#message_N').val();
    var date = $('#date_N').val();
    //----------------
    $.ajax({
        type: 'POST',
        url: '/index/store',
        data: {name: name, phone: phone, mail: mail, message: message},
        success: function(data) {
            //
            if ($.isNumeric(data)) {
                adding = false;
                $("#svli").fadeIn();
                $("#errmsg").removeClass('btn btn-warning').html('').show();
                $("#errmsg").addClass('btn btn-success').html('Сообщение сохранено').fadeOut({duration:3000});
                //----------------------------------------
                $('td#mid').html(data);
                $('td#cntrls').html('<a type="button" class="btn btn-default btn-sm editMsg" data-id="'+data+'">' +
                    '<span class="glyphicon glyphicon-pencil"></span></a> ' +
                    '<a type="button" class="btn btn-danger btn-sm delMsg" data-id="'+data+'">' +
                    '<span class="glyphicon glyphicon-trash"></span></a>');
                $('tr#new').find('input').each(function (){
                    var id0 = $(this).attr("id");
                    $(this).attr("id", id0.replace(/_N/, data));
                    $(this).prop("disabled", true);
                });
                $('td#mid').removeAttr("id");
                $('td#cntrls').removeAttr("id");
                $('tr#new').removeAttr("id");
            }
            else {
                // alert(data);
                $("#svli").fadeIn();
                $("#errmsg").removeClass('btn btn-success').html('').show();
                $("#errmsg").addClass('btn btn-warning').html(data).fadeOut({duration:5000});
            }
        },
        error:  function(xhr, str){
            $("#svli").fadeIn();
            $("#errmsg").removeClass('btn btn-success').html('').show();
            $("#errmsg").addClass('btn btn-warning').html('Произошла ошибка :(' + xhr.responseCode).fadeOut({duration:5000});
        }
    });
}


