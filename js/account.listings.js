function removeById(str, email) {
    $.ajax({
        url:"resources/functions/account/account.listings.remove.function.php",
        type: "POST",
        data:{
            id: str,
            user: email
        },
        success:function(data) {
            $('#' + str).fadeOut(function() {
                if (Number(data) === 0) {
                    $('#no-listings').removeClass( "d-none" );
                }
            });
        },
        error:function(data){
            alert("Whoops, something went wrong! Please try again.");
        }
    });
}