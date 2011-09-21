<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'webpages', 'action' => 'frontpage'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
        //Router::connect('*.myspree2shop.com/', array('controller' => 'pages', 'action' => 'display', 'shopfront'));

        // webpages links
        Router::connect('/pages/*', array('controller' => 'webpages', 'action' => 'view'));


        // dynamic css
         Router::connect('/css/:theme_name',
                    array('controller' => 'redirect_files',
                        'action' => 'theme'),
                    array('pass' => array('theme_name'),
                        'theme_name' => '[a-zA-Z0-9\-_\.]+'
                ));

        // product links
        Router::connect('/products/:handle',
                        array('controller' => 'products',
                              'action' => 'view'),
                        array('pass' => array('handle'),
                              'handle' => '[a-zA-Z0-9\-_]+'
                              ));

		//display 1 product WITHIN collection
		Router::connect('/collections/:handle/products/:product_handle',
                        array('controller' 	=> 'products',
                              'action' 		=> 'view_within_group'),
                        array('pass' 			=> array('handle', 'product_handle'),
                              'handle' 			=> '[a-zA-Z0-9\-_]+',
							  'product_handle' 	=> '[a-zA-Z0-9\-_]+',
                              ));

        
        // display list of products by collections
        Router::connect('/collections/:handle',
                        array('controller' => 'products',
                              'action' => 'view_by_group'),
                        array('pass' => array('handle'),
                              'handle' => '[a-zA-Z0-9\-_]+'
                              ));
		
        
        Router::connect('/collections/:handle/*',
                        array('controller' => 'products',
                              'action' => 'view_by_group'),
                        array('pass' => array('handle'),
                              'handle' => '[a-zA-Z0-9\-_]+'
                              ));


        
        // rename product_groups into collections inside admin interface
        Router::connect('/admin/collections',
                        array('controller' => 'product_groups',
                              'admin'      => true,
                              'action'     => 'index',
                              ));
        
        Router::connect('/admin/collections/:action/*',
                        array('controller' => 'product_groups',
                              'admin'      => true,
                              ));
        
        // admin add, edit, delete variants via product
        Router::connect('/admin/products/:id/variants/add',
                        array('controller' => 'products',
                              'action' => 'add_variant',
                              'admin'=>true),
                        array('pass' => array('id'),
                              'id' => '[0-9]+'
                              ));
        
        Router::connect('/admin/products/:id/variants/edit/:variantId',
                        array('controller' => 'products',
                              'action' => 'edit_variant',
                              'admin'=>true),
                        array('pass' => array('id', 'variantId'),
                              'id' => '[0-9]+',
                              'variantId' => '[0-9]+',
                              ));
        
        Router::connect('/admin/products/:id/variants/delete/:variantId',
                         array('controller' => 'products',
                              'action' => 'delete_variant',
                              'admin'=>true),
                        array('pass' => array('id', 'variantId'),
                              'id' => '[0-9]+',
                              'variantId' => '[0-9]+',
                              ));


        // account links

        Router::connect('/admin', array('admin' => true, 'controller' => 'merchants', 'action' => 'index'));
        
        
        Router::connect('/admin/account', array('admin' => true, 'controller' => 'shops', 'action' => 'account'));

	Router::connect('/admin/account/cancel', array('admin' => true,'controller' => 'shops', 'action' => 'cancelaccount'));
	


	Router::connect('/admin/login', array('admin' => true,'controller' => 'merchants', 'action' => 'login'));

        Router::connect('/admin/logout', array('admin' => true,'controller' => 'merchants', 'action' => 'logout'));

        Router::connect('/admin/profile/edit', array('admin' => true,'controller' => 'merchants', 'action' => 'edit'));
        
        // cart links        
        Router::connect('/cart/checkout',
                        array('controller' => 'products',
                              'action' => 'checkout')
                        );
        
        Router::connect('/cart',
                        array('controller' => 'products',
                              'action' => 'view_cart')
                        );
        
        Router::connect('/cart/change/:variant_id',
                        array('controller' => 'products',
                              'action' => 'change_qty_for_1_item_in_cart'),
                        array('pass' => array('variant_id'),
                              'variant_id' => '[0-9]+',
                              
                              ));
        
        Router::connect('/cart/delete/:cart_id-:id',
                        array('controller' => 'products',
                              'action' => 'delete_from_cart'
                              ),
                        array('pass' => array('id', 'cart_id'),
                              'id' => '[0-9]+',
                              'cart_id' => '[0-9]+'
                              ));
        
        Router::connect('/cart/add',
                        array('controller' => 'products',
                              'action' => 'add_to_cart',
                             ));

        Router::connect('/platform/login', array('platform'=>true, 'controller' => 'users', 'action' => 'login'));

	Router::connect('/login', array('controller' => 'customers', 'action' => 'login'));

        Router::connect('/logout', array('controller' => 'customers', 'action' => 'logout'));

        Router::connect('/admin/settings', array('admin' => true,'controller' => 'shops', 'action' => 'edit'));

        // this is for the listing of images by product
        // the /* is necessary so that the reverse routing works and appends the page:2 etc. at the back
        Router::connect('/admin/products/:product_id/images/index/*',
                        array('controller' => 'product_images',
                              'action' => 'list_by_product',
                              'admin' => true),
                        // order matters since this will simply map ":product_id" to $product_id in your action
                        array('pass' => array('product_id'),
                              'product_id' => '[0-9]+'
                              ));
        
        // this is for the changing of active status for product images. format as above route
        Router::connect('/admin/products/:product_id/images/:id/cover',
                        array('controller' => 'product_images',
                              'action' => 'make_this_cover',
                              'admin' => true),
                        // order matters since this will simply map ":product_id" to $product_id in your action
                        array('pass' => array('id', 'product_id'),
                              'product_id' => '[0-9]+',
                              'id' => '[0-9]+',
                              ));
        
        // this is for the adding of images for product. format as above route
        Router::connect('/admin/products/:product_id/images/add',
                        array('controller' => 'product_images',
                              'action' => 'add_by_product',
                              'admin' => true),
                        
                        array('pass' => array('product_id'),
                              'product_id' => '[0-9]+',
                              ));
        
        // this is for the removal of images for product. format as above route
        Router::connect('/admin/products/:product_id/images/delete',
                        array('controller' => 'product_images',
                              'action' => 'delete',
                              'admin' => true),
                        
                        array('pass' => array('id', 'product_id'),
                              'id' => '[0-9]+',
                              'product_id' => '[0-9]+',
                              )); 
      // this is for the removal of images for product. format as above route
        /**/
        
        // this is for the ajax edit of images for saved_themes
        
        Router::connect('/admin/saved_themes/:id-:folder_name/edit/:image',
                        array('controller' => 'saved_themes',
                              'action' => 'edit_image',
                              'admin' => true),
                        
                        array('pass' => array('id','folder_name', 'image'),
                              'id' => '[0-9]+',
                              
                              ));
        
        // this is for the ajax delete of images for saved_themes
        Router::connect('/admin/saved_themes/:id-:folder_name/delete/:image',
                        array('controller' => 'saved_themes',
                              'action' => 'delete_image',
                              'admin' => true),
                        
                        array('pass' => array('id','folder_name', 'image'),
                              'id' => '[0-9]+',
                              
                              ));
        
        // this is for the ajax edit of images for saved_themes
        Router::connect('/admin/saved_themes/:id-:folder_name/edit-css',
                        array('controller' => 'saved_themes',
                              'action' => 'edit_css',
                              'admin' => true),
                        
                        array('pass' => array('id','folder_name'),
                              'id' => '[0-9]+',
                              
                              ));
        
        // this is for the ajax edit of images for saved_themes
        Router::connect('/admin/product_images/delete/:id-:product_id',
                        array('controller' => 'product_images',
                              'action' => 'delete',
                              'admin' => true),
                        
                        array('pass' => array('id','product_id'),
                              'id' => '[0-9]+',
                              'product_id' => '[0-9]+',
                              ));

        Router::connect('/admin/product_images/deleteme/:id-:product_id',
                        array('controller' => 'product_images',
                              'action' => 'delete_me',
                              'admin' => true),
                        
                        array('pass' => array('id','product_id'),
                              'id' => '[0-9]+',
                              'product_id' => '[0-9]+',
                              ));
        /**
         *blogs & pages
         ***/
        Router::connect('/admin/blogs/:blog_id/posts/add',
                        array('controller' => 'posts',
                              'action' => 'add',
                              'admin' => true),
                        
                        array('pass' => array('blog_id'),
                              'blog_id' => '[0-9]+',
                              
                              ));
        
        
        Router::connect('/admin/blogs/:blog_id/posts/edit/:id',
                        array('controller' => 'posts',
                              'action' => 'edit',
                              'admin' => true),
                        
                        array('pass' => array('blog_id', 'id'),
                              'blog_id' => '[0-9]+',
                              'id' => '[0-9]+',
                              ));
        
        Router::connect('/admin/blogs/:blog_id/posts/delete/:id',
                        array('controller' => 'posts',
                              'action' => 'delete',
                              'admin' => true),
                        
                        array('pass' => array('blog_id', 'id'),
                              'blog_id' => '[0-9]+',
                              'id' => '[0-9]+',
                              ));
        
        Router::connect('/pages/:handle',
                        array('controller' => 'webpages',
                              'action' => 'view'),
                        array('pass' => array('handle'),
                              'handle' => '[a-zA-Z0-9\-_]+'
                              ));
        
        Router::connect('/blogs/:short_name/:id-:slug',
                        array('controller' => 'posts',
                              'action' => 'view'),
                        array('pass' => array('short_name', 'id', 'slug'),
                              'short_name' => '[a-zA-Z0-9\-_]+',
                              'id' => '[0-9]+',
                              'slug' => '[a-zA-Z0-9\-_]+'
                              ));
        
        Router::connect('/blogs/:short_name',
                        array('controller' => 'posts',
                              'action' => 'index'),
                        array('pass' => array('short_name'),
                              'short_name' => '[a-zA-Z0-9\-_]+'
                              ));


        Router::connect('/admin/shipping',
                        array('controller' => 'shipping_rates',
                              'action' => 'index',
                              'admin'=>true));
        
        Router::connect('/admin/shipping/add-price/:country_id',
                        array('controller' => 'shipping_rates',
                              'action' => 'add_price_based',
                              'admin'=>true,
                              ),
                        array('pass'=>array('country_id'),
                              'country_id'=> '[0-9]+'));
        
        Router::connect('/admin/shipping/add-weight/:country_id',
                        array('controller' => 'shipping_rates',
                              'action' => 'add_weight_based',
                              'admin'=>true,
                              ),
                        array('pass'=>array('country_id'),
                              'country_id'=> '[0-9]+'));
    
        
        Router::connect('/admin/shipping/delete/*',
                        array('controller' => 'shipping_rates',
                              'action' => 'delete',
                              'admin'=>true,)
                        );
        
        Router::connect('/admin/:based/:id',
                        array('controller' => 'shipping_rates',
                              'action' => 'edit',
                              'admin'=>true,
                              ),
                        array('pass'=>array('based', 'id'),
                              'based'=> 'price-based-shipping|weight-based-shipping',
                              'id' => '[0-9]+',
                             ));
        
        /**
         * admin domains
         * */
        Router::connect('/admin/domains/make_primary/:id-:shopId',
                        array('controller' => 'domains',
                              'action' => 'make_this_primary',
                              'admin'=>true,
                              ),
                        array('pass' =>array('id', 'shopId'),
                              'id' => '[0-9]+',
                              'shopId' => '[0-9]+',
                        ));
    
    
        /**
         * checkout app links
         **/


    
        Router::connect('/orders/:shop_id/:hash/checkout',
                        array('controller' => 'orders',
                              'action' => 'checkout'),
                        array('pass' => array('shop_id','hash'),
                              'hash' => '[0-9a-zA-Z]+',
                              'shop_id' => '[0-9]+')
                        );
    
        
        Router::connect(CHECKOUT_LINK . '/orders/:shop_id/:hash/checkout',
                        array('controller' => 'orders',
                              'action' => 'checkout'),
                        array('pass' => array('shop_id','hash'),
                              'hash' => '[0-9a-zA-Z]+',
                              'shop_id' => '[0-9]+')
                        );
        
        Router::connect('/orders/:shop_id/:hash/pay',
                        array('controller' => 'orders',
                              'action' => 'pay'),
                        array('pass' => array('shop_id', 'hash'),
                              'hash' => '[0-9a-zA-Z]+',
                              'shop_id' => '[0-9]+')
                        );
        
        Router::connect(CHECKOUT_LINK . '/orders/:shop_id/:hash/pay',
                        array('controller' => 'orders',
                              'action' => 'pay'),
                        array('pass' => array('shop_id', 'hash'),
                              'hash' => '[0-9a-zA-Z]+',
                              'shop_id' => '[0-9]+')
                        );
        
        Router::connect('/orders/:shop_id/success',
                        array('controller' => 'orders',
                              'action' => 'success'),
                        array('pass' => array('shop_id'),
                              'shop_id' => '[0-9]+')
                        );
        
        Router::connect(CHECKOUT_LINK . '/orders/:shop_id/success',
                        array('controller' => 'orders',
                              'action' => 'success'),
                        array('pass' => array('shop_id'),
                              'shop_id' => '[0-9]+')
                        );
        
        /** webpages for blogs and pages
         * */
        Router::connect('/admin/pages',
                        array('controller' => 'webpages',
                              'admin'      => true,
                              'action'     => 'index',
                              ));
        
        Router::connect('/admin/pages/:action/*',
                        array('controller' => 'webpages',
                              'admin'      => true,
                              ));
        
        /**
         * admin link lists
         **/
        Router::connect('/admin/links/edit/*',
                        array('controller' => 'link_lists',
                              'action'     => 'edit',
                              'admin'      => true,
                              ));
        
        Router::connect('/admin/general_settings',
                        array('controller' => 'shops',
                              'action' => 'general_settings',
                              'admin'=>true));

?>
