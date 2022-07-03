const Pagination = require('../../class/pagination');
//Get Count of Children in Pagination
var itemCount = $('.product-pagination .product-navigation .navigation').children().length;
//Get Width of Slider in Pagination
var sliderWidth = parseInt($('.product-pagination .product-navigation').css('width'));
//Set the Count of Items, they musst be showed in Pagination-Slider
var showCount = 3;
//Slider,which should move to left and to right
var navigation = '.product-pagination .product-navigation .navigation';
//pagination 
var pagination = new Pagination(itemCount, sliderWidth, showCount, navigation);
//Left '<<' btn click in the Pagination
$('.product-pagination .left-btn').click(function() {
    pagination.left();
});
//Right '>>' btn click in the Pagenation
$('.product-pagination .right-btn').click(function() {
    pagination.right();
});