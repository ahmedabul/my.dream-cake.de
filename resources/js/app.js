$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});
require('./bootstrap');
require('./artcleController/index');
require('./productController/index/pagination');
require('./cartController/cartOperations');
require('./orderController/orderOperation');
require('./categoryController/pagination');
require('./orderController/research.js');
require('./orderController/show');
require('./homeController/index');