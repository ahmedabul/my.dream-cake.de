class Cart {
    //get the baseUrl of website
    static baseUrl = window.location.origin;

    //Animation at successfuly Adding of new Article in Cart
    static animation(elem) {
            //Add class light to show the Animation
            $(elem).addClass('light');
            //After 1s remove the Class light and Class light "to shwo at nixt Time the Animation again"
            setTimeout(
                function() {
                    $(elem).removeClass('light');
                }, 1000);
        }
        //Alert that the Article is allrady in the Cart
    static alert() {
            $(".cart-alert").removeClass('d-none');
        }
        //Change the Number at Cart-Symbol in 'Navbar'
    static changeCountSymbol(count) {
            $(".articlesLength").text(count);
        }
        //Increment or discrement the Count of an Article in Cart during Select
    static countArticleChanged(elem) {
            $("#" + elem.getAttribute("articleId")).text(elem.getAttribute("price") * elem.value + '€');
            $totalPrice = 0;
            $('.price').each(function() {
                $totalPrice += parseInt($(this).text());
            });
            $(".totalPrice").text($totalPrice + "€");
            $.ajax({
                type: "post",
                url: Cart.baseUrl + "/cart/change",
                data: {
                    articleId: elem.getAttribute("articleId"),
                    count: elem.value
                },
                success: function(data) {
                    console.log(data);
                }
            });
        }
        // Customer would like to order the Article(s) in Cart
    static order() {

        $.ajax({
            type: "post",
            url: Cart.baseUrl + "/order/checkLogin",
            success: function(user) {
                if (user.type == 'admin') {
                    $(".no-order .admin").addClass('messageAdmin');
                } else if (user.type == 'customer') {
                    console.log(user.articles);
                    if (user.articlesCount > 0) {
                        var deliveryAddressId = $(".delivery-address-id").val();
                        window.location.replace(Cart.baseUrl + "/order/pay/" + deliveryAddressId);
                    } else {
                        $(".no-order .customer-cart-empty").addClass('messageCartEmpty');
                    }
                } else {
                    $(".no-order .no-customer").addClass('messageCustomer');
                }

            }
        });

    }
}
module.exports = Cart;