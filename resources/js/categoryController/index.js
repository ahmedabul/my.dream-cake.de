const { forEach } = require("lodash");
//get the baseUrl of website
var baseUrl = window.location.origin;
$(".category-nav-link").click(function(e) {
    e.preventDefault;
    if ($(e.target).attr('page') == 0) {
        window.location.replace(baseUrl + "/category/index/" + $(e.target).attr('categoryId') + "/0");
    } else {
        $.ajax({
            type: "get",
            url: baseUrl + "/category/index/" + $(e.target).attr('categoryId') + "/" + $(e.target).attr('page'),
            success: function(articles) {
                console.log(articles);
                $(".category-articles").empty();
                $.map(articles, function(article) {
                    $(".category-articles").append("<div class='card col-md-3' >" +
                        "<a href=" + baseUrl + "/product/myProduct/" + article.id + "> <img class='card-img-top' src='" + article.mainPhoto + "' alt='Card image cap'></a>" +
                        "<div class='card-body'>" +
                        "<div class='card-title row'>" +
                        "<h5 class='col-6'><a class='text-decoration-none text-dark' href=" + baseUrl + "/product/myProduct/" + article.id + ">" + article.articleName + "</a></h5>" +
                        "<h5 class='col-6 text-right' style='text-align: right'>" + article.price + "€</h5>" +
                        "<p class='card-text'>" + article.description.substring(0, 100) + "</p>" +
                        "</div>" +
                        "<div><a articleId=" + article.id + " class='btn btn-danger addToCart'>In den Warenkorb <i class='fa fa-shopping-cart' aria-hidden='true' style='color: white'></i></a></div>"
                    );
                });
            }
        });
    }
});