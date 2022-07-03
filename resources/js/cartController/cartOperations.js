const Cart = require('../class/cart');
//Call static Funtion addToCart. Every Buttuons '.addToCart' has as an Attribute the ArticleId
$('body').delegate('.addToCart', 'click', function(e) {
    if (Cart.checkArticle(this.getAttribute('articleId')) == undefined) {
        Cart.addToCart(this.getAttribute('articleId'));
        //Animation at successfuly Adding of new Article in Cart
        Cart.animation(e.target);
    }
});
$(".addToThecart").click(function(e) {
        if (Cart.checkArticle(this.getAttribute('articleId')) == undefined) {
            Cart.addToCart(this.getAttribute('articleId'));
            //Animation at successfuly Adding of new Article in Cart
            Cart.animation(e.target);
        }
    })
    //Call static Funtion removeFromCart. Every Buttuons '.removeFromCart' has as an Attribute the ArticleId
$('.removeFromCart').click(function(e) {
    e.preventDefault;
    Cart.removeFromCart(this.getAttribute('articleId'));
});
//With Changing the Count Of an Article in Cart, shoud be changed his Price and Total Price too
$(".articleCount").change(function(e) {
    Cart.countArticleChanged(e.target)
});
//Click Button '.btn-order' so Customer would like to order the Article(s) in Cart
$(".btn-order").click(function(e) {
    e.preventDefault;
    //Custumer orders the Article(s) 
    Cart.order();
});