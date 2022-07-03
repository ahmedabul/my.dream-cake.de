class Cart {
    //get the baseUrl of website
    static baseUrl = window.location.origin;
    static checkArticle(articleId) {
            var articles = JSON.parse(localStorage.getItem('articles'));
            var articleExist;
            $(articles).each(function(index, article) {
                if (article.id == articleId) {
                    articleExist = true;
                }
            });
            return articleExist;
        }
        //Add the Article to Cart
    static addToCart(articleId) {
            $.ajax({
                type: "post",
                //Controller 'cartController' Method 'addToCart'
                url: Cart.baseUrl + "/cart/addToCart",
                data: {
                    articleId: articleId,
                },
                //Accept all Data of Article, which will be added to Cart
                success: function(myArticle) {
                    //Create Article Object
                    var article = new Object();
                    article.articleName = myArticle.articleName;
                    article.price = myArticle.price;
                    article.mainPhoto = myArticle.mainPhoto;
                    article.id = myArticle.id;
                    //Create Multi-Array 'articles' in Session, if it dose NOT exist
                    if (localStorage.getItem("articles") == null) {
                        var articles = [];
                        //Store the Multi-Array 'articles' in Session as a String
                        localStorage.setItem('articles', JSON.stringify(articles));
                    }
                    //Get Multi-Arrays 'articles' from Session as an Array
                    var articles = JSON.parse(localStorage.getItem('articles'));
                    //Add to it the Article-Object, which Customer choosed
                    articles.push(article);
                    //Store it again in the Session as a String
                    localStorage.setItem('articles', JSON.stringify(articles));
                    //Finally send it to Controller 'cartController' Method 'storeCart'
                    $.ajax({
                        type: "post",
                        url: Cart.baseUrl + "/cart/storeCart",
                        data: {
                            //Send the Multi-Arrays 'articles'
                            articles: JSON.parse(localStorage.getItem('articles'))
                        },
                        success: function(articlesLength) {
                            console.log(articlesLength);
                            Cart.changeCountInCartSymbol(articlesLength);
                        }
                    });
                }
            });
        }
        //Remove Article from the Cart
    static removeFromCart(articleId) {
            var articles = JSON.parse(localStorage.getItem('articles'));
            articles = $.grep(articles, function(article) {
                return article.id != articleId;
            });
            console.log(articles)
            localStorage.setItem('articles', JSON.stringify(articles));
            $.ajax({
                type: "post",
                url: Cart.baseUrl + "/cart/removeFromCart",
                data: {
                    articles: JSON.parse(localStorage.getItem('articles'))
                },
                success: function(articlesLength) {
                    location.reload();
                    Cart.changeCountInCartSymbol(articlesLength);
                }
            });

        }
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
        //Change the Nummber in Cart-Sympol, which exists in 'Navbar'
    static changeCountInCartSymbol(articlesLength) {
            console.log(articlesLength);
            $('.articlesLength').text(articlesLength);
        }
        //
    static countArticleChanged(elem) {
            $("#" + elem.getAttribute("articleId")).text(elem.getAttribute("price") * elem.value + '€');
            $totalPrice = 0;
            $('.price').each(function() {
                $totalPrice += parseInt($(this).text());
            });
            $(".totalPrice").text($totalPrice + "€");
        }
        // Customer would like to order the Article(s) in Cart
    static order() {
        //localStorage.removeItem('articles');
        var articles = JSON.parse(localStorage.getItem('articles'));
        //Add the Attribute articleCount to each article in articles
        $(".articleCount").each(function(index) {
            articles[index].articleCount = this.value;
        });
        $.ajax({
            type: "post",
            url: Cart.baseUrl + "/order/checkLogin",
            data: {
                articles: articles
            },
            success: function(user) {
                if (user == 'admin') {
                    $(".no-order .admin").addClass('messageAdmin');
                } else if (user == 'customer') {
                    var articles = JSON.parse(localStorage.getItem('articles'));
                    if (articles.length > 0) {
                        var deliveryAddressId = $(".delivery-address-id").val();
                        window.location.replace("http://127.0.0.1:8000/order/pay/" + deliveryAddressId);
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