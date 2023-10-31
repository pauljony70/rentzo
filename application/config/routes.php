<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
//$route['auth/login'] = 'UserAuthController/login';




//user login
$route['auth/signup'] = 'UserAuthController/signup';
$route['auth/verify_otp'] = 'UserAuthController/verify_otp';
$route['app/getUserReview'] = 'UserAuthController/getUserReview';
$route['app/getUserProfile'] = 'UserAuthController/getUserProfile';

//category
$route['app/getCategory'] = 'CategoryController/getCategory';

//homepage banners
$route['app/getHomeCategory'] = 'CategoryController/getHomeCategory';
$route['app/getHeaderCategory'] = 'CategoryController/getHeaderCategory';
$route['app/getHomeBanners'] = 'BannerController/getHomeBanners';
$route['app/getCustomBanners'] = 'BannerController/getCustomBanners';
$route['app/getSubCategory'] = 'CategoryController/getSubCategory';

//category product
$route['app/getCategoryProduct'] = 'CategoryProductController/getCategoryProduct';

//Popular product
$route['app/getPopularProduct'] = 'HomeController/getPopularProduct';
$route['app/search'] = 'HomeController/search';

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
$route['checkout'] = 'Checkout/checkout';
$route['placeOrder'] = 'Checkout/placeOrder';
$route['send_email'] = 'Checkout/send_email';
$route['placeOrderAdd'] = 'Checkout/addorder';
$route['send-order-notification'] = 'Checkout/sendOrderNotifications';
$route['thankyou/(:any)'] = 'Checkout/thankyou/$1';

$route['deleteUserAddress'] = 'UserAddress/deleteUserAddress';


$route['track'] = 'Home/track_order';
$route['order'] = 'OrderController/get_order';
$route['orderDetails/(:any)/(:any)'] = 'OrderController/order_details/$1/$2';
$route['cancelOrder'] = 'OrderController/cancelOrder';
$route['returnOrder'] = 'OrderController/returnOrder';

$route['apply_coupon'] = 'Checkout/validateCoupon';

$route['get_state'] = 'Checkout/get_state';
$route['get_city'] = 'Checkout/get_city';
$route['get_region'] = 'Checkout/get_region';
$route['get_governorates'] = 'Checkout/get_governorates';
$route['get_areas'] = 'Checkout/get_areas';

$route['ccavenue_payment'] = 'Checkout/payment_form';

$route['google-login'] = 'UserAuthController/googleLogin';
$route['google-login/callback'] = 'UserAuthController/googleCallback';
$route['login'] = 'UserAuthController/login_data';
$route['sign-up'] = 'UserAuthController/signUpView';
$route['signup'] = 'UserAuthController/signup';
$route['verify_otp'] = 'UserAuthController/verify_otp';
$route['user_login'] = 'UserAuthController/login';
$route['email-login'] = 'UserAuthController/emailLogin';
$route['login_otp'] = 'UserAuthController/login_otp';
$route['send-reg-email-otp'] = 'UserAuthController/sendRegistrationEmailOtp';
$route['send-login-email-otp'] = 'UserAuthController/sendLoginEmailOtp';

//brand
$route['app/getBrand'] = 'BrandController/getBrand';
$route['app/getBrandProduct'] = 'BrandController/getBrandProduct';

//Order
$route['app/getOrder'] = 'OrderController/getOrder';
$route['app/getOrderDetails'] = 'OrderController/getOrderDetails';
$route['app/trackOrder'] = 'OrderController/trackOrder';
$route['app/cancelOrder'] = 'OrderController/cancelOrder';
$route['app/returnOrder'] = 'OrderController/returnOrder';
$route['app/getOrderProd'] = 'OrderController/getOrderProd';
$route['app/getOrderDetailsProd'] = 'OrderController/getOrderDetailsProd';

//seller details
$route['app/getSellerDetails'] = 'SellerController/getSellerDetails';

$route['addProductReview'] = 'ProductReviewController/productReview';


//Review details
$route['app/addProductReview'] = 'ProductReviewController/productReview'; //add product review
$route['app/deleteProductReview'] = 'ProductReviewController/deleteproductReview';

//firebase notification

$route['app/getnotification'] = 'HomeController/getnotification';
$route['app/get_app_update'] = 'HomeController/get_app_update';
// website 
//$route['productdetail'] = 'ProductDetail/index';

//category product
$route['get-wholesale-products'] = 'Product/getWholesaleProduct';
$route['wholesale-products'] = 'Product/WholesaleProducts';

//category product
$route['getCategoryProduct'] = 'CategoryProductController/getCategoryProduct';
$route['getCategorysponsorProduct'] = 'CategoryProductController/getCategorysponsorProduct';

//wishlist product
$route['addProductWishlist'] = 'Wishlist/addProductWishlist';
$route['wishlist'] = 'Wishlist/wishlist_list';
$route['deleteProductWishlist'] = 'Wishlist/deleteProductWishlist';

$route['getUserAddress'] = 'UserAddress/getUserAddress';

$route['addUserAddress'] = 'UserAddress/addUserAddress';
$route['getshippingcost'] = 'UserAddress/getshippingcost';

//user login
$route['logout'] = 'Home/logout_data';
$route['register'] = 'Home/register';
$route['set_language'] = 'Home/set_language';
$route['myaddress'] = 'Home/myaddress';
$route['notification'] = 'Home/notification';
$route['personal_info'] = 'Home/personal_info';
$route['send_whatsapp_msg'] = 'Home/send_whatsapp_msg';
$route['checkpincode'] = 'Home/checkpincode';

// search
$route['search/(:any)'] = 'Home/search_data/$1';
$route['sitemap\.xml'] = "Home/sitemap";


$route['editUserAddress'] = 'UserAddress/editUserAddress';

// Buy From Turkey
$route['buy-from-turkey'] = 'BuyFromTurkey/getIndexPage';
$route['buy-from-turkey-orders'] = 'BuyFromTurkey/getBuyFromTurkeyOrders';
$route['buy-from-turkey-checkout'] = 'BuyFromTurkey/buyFromTurkeyCheckout';
$route['turkish-brands'] = 'BuyFromTurkey/getTurkishBrands';
$route['submit-shopping-request'] = 'BuyFromTurkey/submitShoppingRequest';
$route['shipping-price-calculator'] = 'BuyFromTurkey/shippingPriceCalculator';

$route['place-other-country-order'] = 'BuyFromTurkey/placeOtheCountryOrders';
$route['cancel-other-country-order'] = 'BuyFromTurkey/cancelotherCountryOrder';
$route['thankyou'] = 'BuyFromTurkey/thankyou';

//brand
$route['brands'] = 'BrandController/all_brand';
$route['shop/brand'] = 'BrandController/getBrandProduct';
$route['shop/brand/(:any)'] = 'BrandController/brand_product/$1'; 

// User Wallet
$route['my-wallet'] = 'WalletController/getIndexPage';
$route['add-money'] = 'WalletController/addMoney';
$route['withdraw-money'] = 'WalletController/withdrawMoney';
$route['send-withdraw-money-request'] = 'WalletController/sendWithdrawMoneyRequest';
$route['user-wallet-transactions'] = 'WalletController/getuserWalletTransaction';
$route['search-transaction-data'] = 'WalletController/searchWalletTransaction';

// Bank
$route['bank-details'] = 'Home/bankDetails';
$route['add-bank-details'] = 'Home/addBankDetails';

// cart
$route['cart'] = 'Home/cart_details';
$route['deleteProductCart'] = 'Cart/deleteProductCart';
$route['addProductCart'] = 'Cart/addProductCart';
$route['buynowProductCart'] = 'Cart/buynowProductCart';
$route['deleteProductCart_buynow'] = 'Cart/deleteProductCart_buynow';
$route['cart_count'] = 'Home/cart_count';
$route['wishlist_count'] = 'Home/wishlist_count';

$route['getProductFilter'] = 'Product/getProductFilter';
$route['getProductPrice'] = 'Product/getProductPrice';
$route['get_related_products'] = 'Product/getRelatedProductDetails';
$route['get_upsell_products'] = 'Product/getUpsellProductDetails';

$route['shop/(:any)'] = 'Home/sub_category/$1';
$route['offers'] = 'Home/offers';

$route['become_seller'] = 'SellerController/seller_form';
$route['send-become-seller-phone-otp'] = 'SellerController/sendPhoneOtp';
$route['validate-become-seller-phone-otp'] = 'SellerController/validatePhoneOtp';
$route['send-become-seller-email-otp'] = 'SellerController/sendEmailOtp';
$route['validate-become-seller-email-otp'] = 'SellerController/validateEmailOtp';
$route['add_seller'] = 'SellerController/add_sellers';
$route['thankyouseller'] = 'SellerController/thankyouseller';


//Order
$route['track'] = 'Home/track_order';

// pages
$route['privacy'] = 'Home/privacy';
$route['refund'] = 'Home/refund';
$route['about'] = 'Home/about';
$route['faq'] = 'Home/faq';
$route['shipping_policy'] = 'Home/free_shipping';
$route['feedback'] = 'Home/feedback';
$route['contact'] = 'Home/contact';
$route['help'] = 'Home/help';
$route['term_and_conditions'] = 'Home/tearm';
$route['404'] = 'Home/error';
$route['get_search_products'] = 'Home/get_search_products';
$route['all_category'] = 'Home/all_category';
$route['coupon_list'] = 'Home/coupon_list';
$route['explore'] = 'Home/explore';
$route['home'] = 'Home/home_page';
$route['explore_sub/(:any)'] = 'Home/explore_sub/$1';

$route['send_subscriber'] = 'HomeController/send_subscriber';
$route['send_mail'] = 'HomeController/send_mail';
$route['get_home_products'] = 'Home/get_home_products';
$route['get_home_cat_products'] = 'Home/get_home_cat_products';
$route['get_home_bottom_banner'] = 'Home/get_home_bottom_banner';
$route['get_home_small_banner'] = 'Home/get_home_small_banner';
$route['recent_products'] = 'HomeController/get_recent_products';

if (isset($_REQUEST['pid']) && isset($_REQUEST['sku'])) {
	$route['(:any)'] = 'ProductDetail/details/$1';
} else {
	$route['(:any)'] = 'CategoryProductController/index/$1';
}

$route['default_controller'] = 'Home';
$route['404_override'] = 'Home/error';
$route['translate_uri_dashes'] = FALSE;



