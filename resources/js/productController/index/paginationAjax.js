//get the baseUrl of website
var baseUrl = window.location.origin;
//Click a Button in the Pagination in 'Product Page'
$('.product-nav-link').click(function() {
    //Get the Articles from productController from Method 'Show' per Ajax
    $.ajax({
        type: "post",
        url: baseUrl + "/product/show",
        data: {
            //Send the Page Nummber 'in evry Buttuns exisits the Pagenummber as an Attributte'
            page: this.getAttribute('page')
        },
        success: function(articles) {
            //Empty the Div '.products-content-index' to accept the new Articles
            $(".products-content-index").empty();
            //Empty the Div '.products-content-pagination' to accept the new Articles
            $(".products-content-pagination").empty();
            //Use map Function to clear the Multidimensional Array 'Articles'.The Index of Array 'Articles' DONT begin from 0.(Skip && take Laravel)
            $.map(articles, function(article) {
                //Append all Results 'Articles' in Div '.products-content-pagination'
                $('.products-content-pagination').append(
                    "<div class='card col-md-3'>" +
                    "<a href=" + baseUrl + "/product/myProduct/" + article.id + "> <img class='card-img-top' src='" + article.mainPhoto + "' alt='Card image cap'></a>" +
                    "<div class='card-body'>" +
                    "<div class='card-title row'> <h5 class='col-6'><a class='text-decoration-none text-dark' href=" + baseUrl + "/product/myProduct/" + article.id + ">" + article.articleName + "</a></h5> <h5 class='col-6 text-right text-dark' style='text-align: right'>" + article.price + "€</h5></div>" +
                    "<p class='card-text'>" + article.description.substring(0, 100) + "</p>" +
                    "</div>" +
                    "<div articleId=" + article.id + " class='card-body addToCart'>" +
                    "<a  class='btn btn-danger'>In den Warenkorb <i class='fa fa-shopping-cart' aria-hidden='true' style='color: white'></i></a>" +
                    "</div>" +
                    "</div>"
                );
            });
        },
    });
});