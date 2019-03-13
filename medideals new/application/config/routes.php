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
$route['default_controller'] = 'home';

// Load default controller when have only currency from multi language
$route['^(\w{2})$'] = $route['default_controller'];

//Checkout
$route['(\w{2})?/?checkout/successcash'] = 'checkout/successPaymentCashOnD';
$route['(\w{2})?/?checkout/successbank'] = 'checkout/successPaymentBank';
$route['(\w{2})?/?checkout/paypalpayment'] = 'checkout/paypalPayment';
$route['(\w{2})?/?checkout/order-error'] = 'checkout/orderError';



// Ajax called. Functions for managing shopping cart
$route['(\w{2})?/?manageShoppingCart'] = 'home/manageShoppingCart';
$route['(\w{2})?/?clearShoppingCart'] = 'home/clearShoppingCart';
$route['(\w{2})?/?discountCodeChecker'] = 'home/discountCodeChecker';

// home page pagination
$route[rawurlencode('home') . '/(:num)'] = "home/index/$1";
// load javascript language file
$route['loadlanguage/(:any)'] = "Loader/jsFile/$1";
// load default-gradient css
$route['cssloader/(:any)'] = "Loader/cssStyle";

// Template Routes
$route['template/imgs/(:any)'] = "Loader/templateCssImage/$1";
$route['templatecss/imgs/(:any)'] = "Loader/templateCssImage/$1";
$route['templatecss/(:any)'] = "Loader/templateCss/$1";
$route['templatejs/(:any)'] = "Loader/templateJs/$1";

// Products urls style
$route['(:any)_(:num)'] = "home/viewProduct/$2";
$route['(\w{2})/(:any)_(:num)'] = "home/viewProduct/$3";
$route['shop-product_(:num)'] = "home/viewProduct/$3";

// blog urls style and pagination
$route['blog/(:num)'] = "blog/index/$1";
$route['blog/(:any)_(:num)'] = "blog/viewPost/$2";
$route['(\w{2})/blog/(:any)_(:num)'] = "blog/viewPost/$3";

// Shopping cart page
$route['shopping-cart'] = "ShoppingCartPage/index";
$route['(\w{2})/shopping-cart'] = "ShoppingCartPage/index";
$route['shopping-cart/changeqtybyajax'] = "ShoppingCartPage/changeqtybyajax";
$route['shopping-cart/ajaxmanagecart'] = "ShoppingCartPage/ajaxmanagecart";
$route['shopping-cart/checkoutlater'] = "ShoppingCartPage/checkoutlater";
$route['shopping-cart/calccartitems'] = "ShoppingCartPage/calccartitems";

// Textual Pages links
$route['page/(:any)'] = "page/index/$1";
$route['(\w{2})/page/(:any)'] = "page/index/$2";

$route['about'] = "Home/about";
$route['(\w{2})/about'] = "Home/about";

$route['intellectual-property-rights'] = "Home/intellectual_property";
$route['(\w{2})/intellectual-property-rights'] = "Home/intellectual_property";


$route['faq'] = "Home/faq";
$route['(\w{2})/faq'] = "Home/faq";



// Login Public Users Page
$route['login'] = "Users/login";
$route['(\w{2})/login'] = "Users/login";

// Register Public Users Page
$route['register'] = "Users/register";
$route['(\w{2})/register'] = "Users/register";

// Users Profiles Public Users Page
$route['myaccount'] = "Users/myaccount";
$route['(\w{2})/myaccount'] = "Users/myaccount";

// Logout Profiles Public Users Page
$route['logout'] = "Users/logout";
$route['(\w{2})/logout'] = "Users/logout";

$route['sitemap.xml'] = "home/sitemap";

// Confirm link
$route['confirm/(:any)'] = "home/confirmLink/$1";

$route['verifyemail/(:any)/(:any)'] = "home/verifyemail/$1/$2";

$route['payment-information'] = "Checkout/payment_information";
$route['payment-information/(:any)'] = "Checkout/payment_information/$1";

/*
 * Vendor Controllers Routes
 */
$route['vendor/login'] = "vendor/auth/login";
$route['(\w{2})/vendor/login'] = "vendor/auth/login";
$route['vendor/register'] = "vendor/auth/register";
$route['(\w{2})/vendor/register'] = "vendor/auth/register";

$route['vendor/registerVendor'] = "vendor/auth/registerVendor";
$route['(\w{2})/vendor/registerVendor'] = "vendor/auth/registerVendor";

//$route['(\w{2})/vendor/register-vendor'] = "vendor/auth/registerVendor";
//$route['vendor/register-vendor'] = "vendor/auth/registerVendor";

$route['vendor/forgotten-password'] = "vendor/auth/forgotten";
//$route['vendor/registerVendor'] = "vendor/auth/registerVendor";

$route['VendorProfile/recover'] = "vendor/VendorProfile/recover";
$route['(\w{2})/vendor/forgotten-password'] = "vendor/auth/forgotten";
$route['vendor/me'] = "vendor/VendorProfile";
$route['(\w{2})/vendor/me'] = "vendor/VendorProfile";
$route['vendor/profile'] = "vendor/VendorProfile/profile";
$route['customer/order'] = "vendor/Orders/customer_orders";
$route['customer/order/(:num)'] = "vendor/Orders/customer_orders/index/$1";
$route['customer/orderreceive'] = "vendor/Orders/customer_orders_receive";
$route['customer/orderreceive/(:num)'] = "vendor/Orders/customer_orders_receive/index/$1";
$route['customer/orderreturn'] = "vendor/Orders/customer_orders_return";
$route['customer/orderreturn/(:num)'] = "vendor/Orders/customer_orders_return/index/$1";
$route['vendor/updateprofile'] = "vendor/VendorProfile/updateprofile";

$route['vendor/logout'] = "vendor/VendorProfile/logout";
$route['(\w{2})/vendor/logout'] = "vendor/VendorProfile/logout";
$route['vendor/products'] = "vendor/Products";
$route['vendor/csv'] = "vendor/Products/csv_import";
$route['vendor/subscribe'] = "vendor/Products/subscribe";
$route['vendor/bankdetails'] = "vendor/Products/bank_details";
$route['vendor/CustomerEnquiries'] = "vendor/Products/customer_enquiries";
$route['vendor/show_responses'] = "vendor/Products/show_responses";
$route['vendor/viewsubscribe'] = "vendor/Products/viewsubscribe";
$route['(\w{2})/vendor/products'] = "vendor/Products";
$route['vendor/products/(:num)'] = "vendor/Products/index/$1";
$route['(\w{2})/vendor/products/(:num)'] = "vendor/Products/index/$2";
$route['vendor/add/product'] = "vendor/AddProduct";
$route['(\w{2})/vendor/add/product'] = "vendor/AddProduct";
$route['vendor/edit/product/(:num)'] = "vendor/AddProduct/index/$1";
$route['vendor/Addproduct/location/(:num)'] = "vendor/AddProduct/location/$1";
$route['vendor/AddProduct/view_location/(:num)'] = "vendor/AddProduct/view_location/$1";
$route['vendor/Addproduct/find_city'] = "vendor/AddProduct/find_city";
$route['vendor/Addproduct/save_location'] = "vendor/AddProduct/save_location";
$route['(\w{2})/vendor/edit/product/(:num)'] = "vendor/AddProduct/index/$1";
$route['vendor/orders'] = "vendor/Orders";
$route['(\w{2})/vendor/orders'] = "vendor/Orders";
$route['vendor/orders/(:num)'] = "vendor/Orders/index/$1";
$route['vendor/uploadOthersImages'] = "vendor/AddProduct/do_upload_others_images";
$route['vendor/loadOthersImages'] = "vendor/AddProduct/loadOthersImages";
$route['vendor/removeSecondaryImage'] = "vendor/AddProduct/removeSecondaryImage";
$route['vendor/delete/product/(:num)'] = "vendor/products/deleteProduct/$1";
$route['vendor/searchproductforvendor'] = "vendor/products/searchproductforvendor";
$route['(\w{2})/vendor/delete/product/(:num)'] = "vendor/products/deleteProduct/$1";
$route['vendor/view/(:any)'] = "Vendor/index/0/$1";
$route['(\w{2})/vendor/view/(:any)'] = "Vendor/index/0/$2";
$route['vendor/view/(:any)/(:num)'] = "Vendor/index/$2/$1";
$route['(\w{2})/vendor/view/(:any)/(:num)'] = "Vendor/index/$3/$2";
$route['(:any)/(:any)_(:num)'] = "Vendor/viewProduct/$1/$3";
$route['(\w{2})/(:any)/(:any)_(:num)'] = "Vendor/viewProduct/$2/$4";
$route['vendor/changeOrderStatus'] = "vendor/orders/changeOrdersOrderStatus";
$route['vendor/affiliate'] = "vendor/VendorProfile/affiliate_code";
$route['vendor/affiliate/(:any)'] = "vendor/VendorProfile/affiliate_code/$1";
$route['vendor/add-affiliate-code'] = "vendor/VendorProfile/add_affiliate_code";
$route['vendor/gen-affiliate-code'] = "vendor/VendorProfile/gen_affiliate_code";
$route['vendor/send-affiliate-email/(:any)'] = "vendor/VendorProfile/send_affiliate_email/$1";
// Site Multilanguage
$route['^(\w{2})/(.*)$'] = '$2';

/*
 * Admin Controllers Routes
 */
// HOME / LOGIN
$route['admin'] = "admin/home/login";
// ECOMMERCE GROUP
$route['admin/publish'] = "admin/ecommerce/publish";
$route['admin/publish/(:num)'] = "admin/ecommerce/publish/index/$1";
$route['admin/removeSecondaryImage'] = "admin/ecommerce/publish/removeSecondaryImage";
$route['admin/convertCurrency'] = "admin/ecommerce/publish/convertCurrency";
$route['admin/products'] = "admin/ecommerce/products";
$route['admin/products/(:num)'] = "admin/ecommerce/products/index/$1";
$route['admin/productStatusChange'] = "admin/ecommerce/products/productStatusChange";
$route['admin/shopcategories'] = "admin/ecommerce/ShopCategories";
$route['admin/shopcategories/(:num)'] = "admin/ecommerce/ShopCategories/index/$1";
$route['admin/editshopcategorie'] = "admin/ecommerce/ShopCategories/editShopCategorie";
$route['admin/orders'] = "admin/ecommerce/orders";
$route['admin/state'] = "admin/ecommerce/State"; 
$route['admin/state/Savestate'] = "admin/ecommerce/State/Savestate"; 
$route['admin/state/stateshow/(:any)'] = "admin/ecommerce/State/stateshow/$1"; 
$route['admin/state/update/(:any)'] = "admin/ecommerce/State/update/$1"; 
$route['admin/state/deletestate/(:any)'] = "admin/ecommerce/State/deletestate/$1"; 
$route['admin/city/deletecity/(:any)'] = "admin/ecommerce/city/deletecity/$1"; 
$route['admin/city/Savecity'] = "admin/ecommerce/city/Savecity"; 
$route['admin/city'] = "admin/ecommerce/City";
$route['admin/city/cityshow/(:any)/(:any)'] = "admin/ecommerce/City/cityshow/$1/$1";
$route['admin/city/updatecity/(:any)'] = "admin/ecommerce/City/updatecity/$1";  
$route['admin/vendors'] = "admin/ecommerce/Vendors";
$route['admin/vendors/(:num)'] = "admin/ecommerce/Vendors/index/$1";
$route['admin/vendors/showvendors/(:any)'] = "admin/ecommerce/Vendors/showvendors/$1"; 
$route['admin/vendors/deletevendors/(:any)'] = "admin/ecommerce/Vendors/deletevendors/$1"; 
$route['admin/vendors/updatevendors/(:any)'] = "admin/ecommerce/Vendors/updatevendors/$1"; 
$route['admin/vendors/updatevendorsststus/(:any)/(:any)'] = "admin/ecommerce/vendors/updatevendorsststus/$1/$1"; 
$route['admin/vendors_product'] = "admin/ecommerce/vendors_product";
$route['admin/wholeseller_subs_msg'] = "admin/home/home/wholeseller_subs_msg";
$route['admin/wholeseller_subs_msg/(:any)'] = "admin/home/home/wholeseller_subs_msg/$1";
$route['admin/update_subs_status/(:any)/(:any)'] = "admin/home/home/update_subs_status/$1/$2";
$route['admin/csv_import'] = "admin/home/Home/csv_import";
$route['admin/product_list'] = "admin/home/Home/product_list";
$route['admin/showlist/(:any)'] = "admin/home/Home/showlist/$1";
$route['admin/updateproductlist/(:any)'] = "admin/home/Home/updateproductlist/$1";
$route['admin/deleteproductlist/(:any)'] = "admin/home/Home/deleteproductlist/$1";
$route['admin/import'] = "admin/home/Home/import";
$route['admin/load_data'] = "admin/home/Home/load_data";
$route['admin/customer_enquiries'] = "admin/home/home/customer_enquiries";
$route['admin/customer_enquiries/(:any)'] = "admin/home/home/customer_enquiries/$1";
$route['admin/update_cust_enq_status'] = "admin/home/home/update_cust_enq_status";
$route['admin/calc_earning'] = "admin/home/home/calc_earning";
$route['admin/response_customer'] = "admin/home/home/response_customer";
$route['admin/show_responses'] = "admin/home/home/show_responses";
$route['admin/show_responses/(:any)'] = "admin/home/home/show_responses/$1";
$route['admin/show_enquiry'] = "admin/home/home/show_enquiry";
$route['admin/show_enquiry/(:any)'] = "admin/home/home/show_enquiry/$1";
$route['admin/show_bank_details'] = "admin/home/home/show_bank_details";
$route['admin/show_bank_details/(:any)'] = "admin/home/home/show_bank_details/$1";
$route['admin/3rd_party'] = "admin/home/home/third_party";
$route['admin/3rd_party/(:any)'] = "admin/home/home/third_party/$1";
$route['admin/third_party_register'] = "admin/home/home/third_party_register";
$route['admin/third_show_city'] = "admin/home/home/third_show_city";
$route['admin/thirdparty_update/(:any)'] = "admin/home/home/thirdparty_update/$1";
$route['admin/thirdparty_update_details'] = "admin/home/home/thirdparty_update_details";
$route['admin/pcdcompanies_show'] = "admin/home/home/pcdcompanies_show";
$route['admin/pcdcompanies_show/(:any)'] = "admin/home/home/pcdcompanies_show/$1";
$route['admin/pcdcompanies_show_city'] = "admin/home/home/pcdcompanies_show_city";
$route['admin/pcd_companies_update/(:any)'] = "admin/home/home/pcd_companies_update/$1";
$route['admin/pcd_companies_update_details'] = "admin/home/home/pcd_companies_update_details";
$route['admin/pcdcompanies_register'] = "admin/home/home/pcdcompanies_register";

$route['admin/orders/(:num)'] = "admin/ecommerce/orders/index/$1";
$route['admin/changeOrdersOrderStatus'] = "admin/ecommerce/orders/changeOrdersOrderStatus";
$route['admin/brands'] = "admin/ecommerce/brands";
$route['admin/changePosition'] = "admin/ecommerce/ShopCategories/changePosition";
$route['admin/discounts'] = "admin/ecommerce/discounts";
$route['admin/discounts/(:num)'] = "admin/ecommerce/discounts/index/$1";
// BLOG GROUP
$route['admin/blogpublish'] = "admin/blog/BlogPublish";
$route['admin/blogpublish/(:num)'] = "admin/blog/BlogPublish/index/$1";
$route['admin/blog'] = "admin/blog/blog";
$route['admin/blog/(:num)'] = "admin/blog/blog/index/$1";
// SETTINGS GROUP
$route['admin/settings'] = "admin/settings/settings";
$route['admin/styling'] = "admin/settings/styling";
$route['admin/templates'] = "admin/settings/templates";
$route['admin/titles'] = "admin/settings/titles";
$route['admin/pages'] = "admin/settings/pages";
$route['admin/emails'] = "admin/settings/emails";
$route['admin/emails/(:num)'] = "admin/settings/emails/index/$1";
$route['admin/history'] = "admin/settings/history";
$route['admin/history/(:num)'] = "admin/settings/history/index/$1";
// ADVANCED SETTINGS
$route['admin/languages'] = "admin/advanced_settings/languages";
$route['admin/filemanager'] = "admin/advanced_settings/filemanager";
$route['admin/adminusers'] = "admin/advanced_settings/adminusers";
$route['admin/createroles'] = "admin/advanced_settings/admincreateroles";
$route['admin/rolemapping'] = "admin/advanced_settings/adminrolemapping";
$route['admin/newrolemapping'] = "admin/advanced_settings/adminrolemapping/maprole";
$route['admin/showsinglerole/(:any)/(:any)'] = "admin/advanced_settings/adminrolemapping/showsinglerole/$1/$2";
$route['admin/editroles'] = "admin/advanced_settings/adminrolemapping/editroles";
$route['admin/affiliate-program'] = "admin/advanced_settings/Adminaffiliatemkt";
// TEXTUAL PAGES
$route['admin/pageedit/(:any)'] = "admin/textual_pages/TextualPages/pageEdit/$1";
$route['admin/changePageStatus'] = "admin/textual_pages/TextualPages/changePageStatus";
// LOGOUT
$route['admin/logout'] = "admin/home/home/logout";
// Admin pass change ajax
$route['admin/changePass'] = "admin/home/home/changePass";
$route['admin/uploadOthersImages'] = "admin/ecommerce/publish/do_upload_others_images";
$route['admin/loadOthersImages'] = "admin/ecommerce/publish/loadOthersImages";

/*
  | -------------------------------------------------------------------------
  | Sample REST API Routes
  | -------------------------------------------------------------------------
 */
$route['api/products/(\w{2})/get'] = 'Api/Products/all/$1';
$route['api/product/(\w{2})/(:num)/get'] = 'Api/Products/one/$1/$2';
$route['api/product/set'] = 'Api/Products/set';
$route['api/product/(\w{2})/delete'] = 'Api/Products/productDel/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
