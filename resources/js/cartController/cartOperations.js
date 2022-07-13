const Cart = require('../class/cart');
var baseUrl = window.location.origin;
//Call static Funtion addToCart.Buttun has Class '.addToCart' 
$(".addToCart").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: baseUrl + "/cart/add",
        data: {
            articleId: $(this).attr("articleId"),
        },
        //get researche Articles from articleController@research
        success: function(data) {
            if (data.sts == 'true') {
                //animation Red-Light at the Button
                Cart.animation(e.target);
                //change the Number at the Cart-Symbol in the 'Navbar'
                Cart.changeCountSymbol(data.count);
            } else {
                Cart.alert();
            }
        }
    });
    //Animation light in The Button

});
//With Changing the Count Of an Article in Cart, shoud be changed his Price and Total Price too
$(".articleCount").change(function(e) {
    Cart.countArticleChanged(e.target)
});
//When click the Button 'zurück' in cart-alert
$(".cart-alert-remove").click(function(e) {
    $(".cart-alert").addClass('d-none');
});
//Click Button '.btn-order' so Customer would like to order the Article(s) in Cart
$(".btn-order").click(function(e) {
    e.preventDefault;
    //Custumer orders the Article(s)  
    Cart.order();
});