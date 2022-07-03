class Order {
    //get the baseUrl of website
    static baseUrl = window.location.origin;
    constructor(invoiceId, orderId, email, orderAction) {
        this.invoiceId = invoiceId;
        this.orderId = orderId;
        this.email = email;
        this.orderAction = orderAction;
    }
    alertQuestion($question) {
        $(".delete-delivered-alert .alert-body h4").text($question);
    }
    showAlert() {
        $(".delete-delivered-alert").fadeIn(1000);
    }
    hiddenAlert() {
        $(".delete-delivered-alert").fadeOut(1000);
    }
    delete() {
        $(".order-alert-spinner").removeClass("d-none");
        $.ajax({
            type: "post",
            url: Order.baseUrl + "/order/delete",
            data: {
                invoiceId: this.invoiceId,
                orderId: this.orderId,
                email: this.email,
            },
            success(data) {
                $(".order-alert-spinner").addClass("d-none");
                $(".order-alert-sms h6").html("<i class='fa fa-thumbs-up' aria-hidden='true'></i>");
                $(".delete-delivered-alert").fadeOut(1000);
                location.reload();
            },
            error(data) {
                console.log(data);
            }
        });
    }
    deliver() {
        $(".order-alert-spinner").removeClass("d-none");
        $.ajax({
            type: "post",
            url: Order.baseUrl + "/order/deliver",
            data: {
                invoiceId: this.invoiceId,
                orderId: this.orderId,
                email: this.email,
            },
            success(data) {
                console.log("data" + data);
                $(".order-alert-spinner").addClass("d-none");
                $(".order-alert-sms h6").html("<i class='fa fa-thumbs-up' aria-hidden='true'></i>");
                $(".delete-delivered-alert").fadeOut(1000);
                location.reload();
            },
            error(data) {
                console.log(data);
            }
        });
    }
}
module.exports = Order;