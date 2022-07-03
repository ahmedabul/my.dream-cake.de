const Order = require('../class/order');
//pay 
$('.pay-btn').click(function() {
    localStorage.removeItem('articles');
});
//Button .order-delte clicked to cancel the Order => show Alert
var order;
$(".order-delete").click(function(e) {
        e.pereventDefault;
        order = new Order($(this).attr("invoiceId"), $(this).attr("orderId"), $(this).attr("email"), 'delete');
        order.alertQuestion("Möchten Sie Wircklich diese Bestellung stönieren?");
        order.showAlert();
    })
    //Button 'No' in the Alert
$('.order-alert-no').click(function() {
    order.hiddenAlert();
});
//Button 'Yes' in the Alert
$('.order-alert-yes').click(function() {
    if (order.orderAction == 'delete') {
        order.delete();
    } else if (order.orderAction == 'deliver') {
        order.deliver();
    } else {
        console.log('no Action');
    }
});
//Button .order-delivered clicked => show Alert
$('.order-deliver').click(function(e) {
    e.preventDefault;
    order = new Order($(this).attr("invoiceId"), $(this).attr("orderId"), $(this).attr("email"), 'deliver');
    order.alertQuestion("Wurde diese Bestellung wircklich geliefert?");
    order.showAlert();
})