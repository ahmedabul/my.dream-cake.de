//get the baseUrl of website
var baseUrl = window.location.origin;
$("#noAcceptCount,#demagedAcceptCount").change(function() {

    if ($(this).val() != "null") {
        $.ajax({
            type: "post",
            url: baseUrl + "/order/unlock",
            data: {
                orderId: $(this).attr("orderId"),
                selectId: $(this).attr('id'),
                action: $(this).val(),
            },
            success: function(data) {
                console.log(data);
                location.reload();
            }
        });
    }
});