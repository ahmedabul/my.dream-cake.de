//get the baseUrl of website
var baseUrl = window.location.origin;
//Search Articles per Ajax
//Send the Value of Input '.articleSearch' to articleController 'method research' per ajax

$('.articleSearch').keyup(function(e) {
    $.ajax({
        type: "post",
        url: baseUrl + "/article/research",
        data: {
            research: $(e.target).val()
        },
        //get researche Articles from articleController@research
        success: function(data) {
            //First empty all Articles in Div .researched-articles .articles
            $('.researched-articles .articles').empty();
            //Apend results of Articles in Div .researched-articles .articles
            $(data.articles).each(function(articles, article) {
                $('.researched-articles .articles').append(
                    "<div class='card col-md-3'>" +
                    "<img class='card-img-top' src='" + article.mainPhoto + "' alt='Card image cap'></img>" +
                    "<div class='card-body'>" +
                    "<div class='card-title row'><h5 class='col-6'>" + article.articleName + "</h5> <h5 class='col-6 text-right text-primary' style='text-align: right'>" + article.price + "€</h5></div>" +
                    "<p class='card-text'>" + article.description + "</p>" +
                    "</div>" +
                    "<div class='card-body '>" +
                    "<a href='" + baseUrl + "/article/edit/" + article.id + "' class='btn btn-primary'>Update</a>" +
                    "</div>" +
                    "</div>"
                );
            });
        }
    });
});