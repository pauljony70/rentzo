<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string	
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//user login
$route['auth/login'] = 'UserAuthController/login';
$route['auth/thirdPartyLogin'] = 'UserAuthController/loginUsingThirdPartyMethod';
$route['auth/signup'] = 'UserAuthController/signup';
$route['auth/verify_otp'] = 'UserAuthController/verify_otp';
$route['app/getUserReview'] = 'UserAuthController/getUserReview';
$route['app/getUserProfile'] = 'UserAuthController/getUserProfile';
$route['auth/forgot_otp'] = 'UserAuthController/forgot_otp';
$route['auth/update_password'] = 'UserAuthController/update_password';
$route['app/send_otp'] = 'UserAuthController/send_otp';
$route['app/send_otp_verify'] = 'UserAuthController/send_otp_verify';
$route['app/login_banner'] = 'UserAuthController/login_banner';

//category
$route['app/getCategory'] = 'CategoryController/getCategory';
$route['app/getCategoryToolbar'] = 'CategoryController/getCategoryToolbar';

//homepage banners
$route['app/getHomeCategory'] = 'CategoryController/getHomeCategory';
$route['app/getHeaderCategory'] = 'CategoryController/getHeaderCategory';
$route['app/getHomeBanners'] = 'BannerController/getHomeBanners';
$route['app/getCustomBanners'] = 'BannerController/getCustomBanners';
$route['app/getSubCategory'] = 'CategoryController/getSubCategory';
$route['app/special-deals-banners'] = 'BannerController/getSpecialDealsBanners';

//category product
$route['app/getCategoryProduct'] = 'CategoryProductController/getCategoryProduct';
$route['app/getCategoryProduct_sponsor'] = 'CategoryProductController/getCategoryProduct_sponsor';

//Wholesale Products
$route['app/wholesale-products'] = 'Product/getWholesaleProduct';
$route['app/wholesale-product-filters'] = 'Product/getWholesaleProductFilters';


// Buy from turkey
$route['app/turkish-brands'] = 'BuyFromTurkey/getTurkishBrands';
$route['app/submit-shopping-request'] = 'BuyFromTurkey/submitShoppingRequest';

//Popular product
$route['app/getPopularProduct'] = 'HomeController/getPopularProduct';
$route['app/search'] = 'HomeController/search';
$route['app/search_sponsor'] = 'HomeController/search_sponsor';
$route['app/delete_user_data'] = 'SellerController/delete_user_data';
$route['app/get_storesetting'] = 'HomeController/get_storesetting';
$route['app/coupon_code'] = 'HomeController/get_coupon_code';
$route['app/offers'] = 'HomeController/get_offers';
$route['app/home_top_category'] = 'HomeController/home_top_category';
$route['app/home_top_slider'] = 'HomeController/home_top_slider';
$route['app/home_top_banner'] = 'HomeController/home_top_banner';
$route['app/home_today_deal'] = 'HomeController/home_today_deal';
$route['app/home_top_selling_banner'] = 'HomeController/home_top_selling_banner';
$route['app/home_top_selling'] = 'HomeController/home_top_selling';
$route['app/home_trending_products_banner'] = 'HomeController/home_trending_products_banner';
$route['app/home_trending_products'] = 'HomeController/home_trending_products';
$route['app/home_three_banner'] = 'HomeController/home_three_banner';
$route['app/home_you_may_like'] = 'HomeController/home_you_may_like';
$route['app/home_most_populor_banner'] = 'HomeController/home_most_populor_banner';
$route['app/home_most_populor'] = 'HomeController/home_most_populor';
$route['app/home_customize_clothing_banner'] = 'HomeController/home_customize_clothing_banner'; 
$route['app/home_customize_clothing'] = 'HomeController/home_customize_clothing'; 
$route['app/customize_clothing_products'] = 'HomeController/customize_clothing_products'; 
$route['app/home_all_data'] = 'HomeController/home_all_data'; 
$route['app/home_all_data2'] = 'HomeController/home_all_data2';
$route['app/top-notifications'] = 'HomeController/getTopNotifications';

//product detail
$route['app/getProductDetails'] = 'Product/getProductDetails';
$route['app/getRelatedProductDetails'] = 'Product/getRelatedProductDetails';
$route['app/getUpsellProductDetails'] = 'Product/getUpsellProductDetails';
$route['app/getProductPrice'] = 'Product/getProductPrice';
$route['app/getProductReview'] = 'Product/getProductReview';

//sort product
$route['app/getProductSortby'] = 'Product/getProductSortby';
$route['app/getProductFilter'] = 'Product/getProductFilter';

//cart product
$route['app/addProductCart'] = 'Cart/addProductCart';
$route['app/deleteProductCart'] = 'Cart/deleteProductCart';
$route['app/getProductCart'] = 'Cart/getProductCart';
$route['app/getCartCount'] = 'Cart/getCartCount';
$route['app/delete_all_cart'] = 'Cart/delete_all_cart';

//wishlist product
$route['app/addProductWishlist'] = 'Wishlist/addProductWishlist';
$route['app/deleteProductWishlist'] = 'Wishlist/deleteProductWishlist';
$route['app/getProductWishlist'] = 'Wishlist/getProductWishlist';
$route['app/getWishlistCount'] = 'Wishlist/getWishlistCount';

//user address
$route['app/addUserAddress'] = 'UserAddress/addUserAddress';
$route['app/updateUserAddress'] = 'UserAddress/updateUserAddress';
$route['app/deleteUserAddress'] = 'UserAddress/deleteUserAddress';
$route['app/getUserAddress'] = 'UserAddress/getUserAddress';

//checkout
$route['app/validateCoupon'] = 'Checkout/validateCoupon';
$route['app/checkout'] = 'Checkout/checkout';
$route['app/placeOrder'] = 'Checkout/placeOrder';
$route['app/send_email'] = 'Checkout/send_email';

//brand
$route['app/top-brands'] = 'BrandController/getTopBrands';
$route['app/getBrand'] = 'BrandController/getBrand';
$route['app/getBrandProduct'] = 'BrandController/getBrandProduct';

// User Wallet
$route['app/my-wallet'] = 'WalletController/getIndexPage';
$route['app/add-money'] = 'WalletController/addMoney';
$route['app/user-wallet-transactions'] = 'WalletController/getuserWalletTransaction';

//Order
$route['app/getOrder'] = 'OrderController/getOrder';
$route['app/getOrderDetails'] = 'OrderController/getOrderDetails';
$route['app/trackOrder'] = 'OrderController/trackOrder';
$route['app/cancelOrder'] = 'OrderController/cancelOrder';
$route['app/returnOrder'] = 'OrderController/returnOrder';
$route['app/getOrderProd'] = 'OrderController/getOrderProd';
$route['app/getOrderDetailsProd'] = 'OrderController/getOrderDetailsProd';

$route['sellerapp/updateOrder'] = 'OrderController/updateOrder';
$route['sellerapp/getOrder_seller'] = 'OrderController/getOrder_seller';
$route['sellerapp/order_full_details'] = 'OrderController/order_full_details';
$route['sellerapp/sellerlogin'] = 'HomeController/login';
$route['sellerapp/add_seller_product'] = 'HomeController/add_seller_product';
$route['sellerapp/update_seller_product'] = 'HomeController/update_seller_product';


//seller details
$route['app/getSellerDetails'] = 'SellerController/getSellerDetails';


//Review details
$route['app/addProductReview'] = 'ProductReviewController/productReview'; //add product review
$route['app/deleteProductReview'] = 'ProductReviewController/deleteproductReview'; 

//firebase notification

$route['app/getnotification'] = 'HomeController/getnotification';
$route['app/getnotification_newpost'] = 'HomeController/getnotification_newpost';
$route['app/get_app_update'] = 'HomeController/get_app_update';

//delivery details
$route['app/delivery_city'] = 'DeliveryController/get_delivery_city';
$route['app/validate_city'] = 'DeliveryController/delivery_city_details';

//Delivery Boy login
$route['auth/delivery_boy_login'] = 'DeliveryAuthController/login';

$route['auth/delivery_boy_profile'] = 'DeliveryAuthController/getUserProfile';
$route['auth/delivery_boy_order_list'] = 'DeliveryAuthController/getOrder';
$route['auth/delivery_boy_order_list_sortby'] = 'DeliveryAuthController/getOrder_sortby';
$route['auth/delivery_boy_update_status'] = 'DeliveryAuthController/UpdateOrderStatus';
$route['auth/get_delivery_status'] = 'DeliveryAuthController/get_delivery_status';
$route['auth/delivery_boy_search_order_list'] = 'DeliveryAuthController/search_order_list';
$route['auth/delivery_boy_token'] = 'DeliveryAuthController/delivery_boy_token';

$route['app/ccavenue'] = 'welcome/index';
$route['app/ccavenue/save'] = 'welcome/save';
$route['app/ccavenue/success/(:any)'] = 'welcome/success/$1';
$route['app/ccavenue/fail'] = 'welcome/fail';
$route['app/ccavenue/cancel'] = 'welcome/cancel';
$route['app/ccavenue/redirect'] = 'welcome/redirect';

$route['app/city_list'] = 'HomeController/city_list';
$route['app/state_list'] = 'HomeController/state_list';

$route['get_country'] = 'DeliveryController/get_country';
$route['get_region'] = 'DeliveryController/get_region';
$route['get_governorate'] = 'DeliveryController/get_governorates';
$route['get_area'] = 'DeliveryController/get_areas';

$route['default_controller'] = 'welcome';
$route['404_override'] = 'welcome/errors';
$route['translate_uri_dashes'] = FALSE;
