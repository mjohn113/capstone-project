function subscribeByCrn(str, email) {
    $.ajax({
        url:"resources/functions/course/course.details.subscribe.function.php",
        type: "POST",
        data:{
            id: str,
            email: email
        },
        success:function(data) {
            $('#btn' + str).text('Subscribed');
            $('#btn' + str).prop('disabled', true);
        },
        error:function(data){
            alert("Whoops, something went wrong! Please try again.");
        }
    });
}

function addReview(email, id) {
    if ($("#crn").val() === null || $("#reviewDescription").val() === "" || $("#ratingValue").val() === "0" ||
        $("#semester").val() === null || $("#year").val() === "" || $("#instructor").val() === "" || $("#campus").val() === null) {
        $('#checkForm').removeClass('d-none');
        $('#checkMessage').empty().append('Please enter all fields.');
    }
    else {
        $.ajax({
            url: "resources/functions/course/course.details.addreview.function.php",
            type: "POST",
            data: {
                email: email,
                crn: $("#crn").val(),
                review: $("#reviewDescription").val(),
                rating: $("#ratingValue").val(),
                instructor: $("#instructor").val(),
                semester: $("#semester").val() + " " + $("#year").val(),
                campus: $("#campus").val()
            },
            success: function (data) {
                if (data.status === 'error') {
                    $('#checkForm').removeClass('d-none');
                    $('#checkMessage').empty().append(data.error);
                } else {
                    $('#exampleModal').modal('hide');
                    $('#reviewPart').empty().load('resources/functions/course/course.details.fetchreviews.function.php?id=' + id);
                }
            },
            error: function (data) {
                alert(data);
            }
        });

    }

}

function highlightStar($this) {
    $('#rating').children('i').each(function () {
        $("#"+this.id).removeClass("fas");
    });
    switch($this.id) {
        case "fiveStar":
            $("#fiveStar").addClass("fas");
            $("#fourStar").addClass("fas");
            $("#threeStar").addClass("fas");
            $("#twoStar").addClass("fas");
            $("#oneStar").addClass("fas");
            $("#ratingValue").val("5");
            break;
        case "fourStar":
            $("#fourStar").addClass("fas");
            $("#threeStar").addClass("fas");
            $("#twoStar").addClass("fas");
            $("#oneStar").addClass("fas");
            $("#ratingValue").val("4");
            break;
        case "threeStar":
            $("#threeStar").addClass("fas");
            $("#twoStar").addClass("fas");
            $("#oneStar").addClass("fas");
            $("#ratingValue").val("3");
            break;
        case "twoStar":
            $("#twoStar").addClass("fas");
            $("#oneStar").addClass("fas");
            $("#ratingValue").val("2");
            break;
        case "oneStar":
            $("#oneStar").addClass("fas");
            $("#ratingValue").val("1");
            break;
    }
}



