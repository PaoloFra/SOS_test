(function( $ ){


    // getEstimatesForUserLocation('rXFtyR­_8FnRpknNVFkDlkb1Psi_B­bdVa2mD_Pf');

    $("#newRoute").on('click', function(){
        var StartAddress = $('#StartAddress').val();
        var EndAddress   = $('#EndAddress').val();
        //----------------
        $('#estimate').html('<img src="/img/preloader.gif">');
        $.ajax({
            type: 'POST',
            url: '/index/getEstimate',
            data: {StartAddress: StartAddress, EndAddress: EndAddress},
            success: function(data) {
                //
                $('#estimate').html(data);
                if (data=='OK') {

                }
                else {
                    // // alert(data);
                    // $("#svli").fadeIn();
                    // $("#errmsg").removeClass('btn btn-success').html('').show();
                    // $("#errmsg").addClass('btn btn-warning').html(data).fadeOut({duration:5000});
                }
            },
            error:  function(xhr, str){
                // $("#svli").fadeIn();
                // $("#errmsg").removeClass('btn btn-success').html('').show();
                // $("#errmsg").addClass('btn btn-warning').html('Произошла ошибка :(' + xhr.responseCode).fadeOut({duration:5000});
            }
        });
    });

    function getEstimatesForUserLocation(uberServerToken) {
        $.ajax({
            url: "https://api.uber.com/v1/estimates/price",
            headers: {
                Authorization: "Token " + uberServerToken,
                CORS: 'Access-Control-Allow-Origin'
            },
            data: {
                start_latitude: 37.625732,
                start_longitude: -122.377807,
                end_latitude: 37.785114,
                end_longitude: -122.406677
            },
            success: function(result) {
                console.log(result);
            }
        });
    }

})( jQuery );

