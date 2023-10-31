<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= base_url();?></loc> 
        <priority>1.0</priority>
    </url>
	<url>
        <loc><?= base_url().'login';?></loc> 
        <priority>0.5</priority>
    </url>
	<url>
        <loc><?= base_url().'sign-up';?></loc> 
        <priority>0.5</priority>
    </url>
	<url>
        <loc><?= base_url().'buy-from-turkey';?></loc> 
        <priority>0.5</priority>
    </url>
	<url>
        <loc><?= base_url().'wholesale-products';?></loc> 
        <priority>0.5</priority>
    </url>
	<url>
        <loc><?= base_url().'contact';?></loc> 
        <priority>0.5</priority>
    </url>
	<url>
        <loc><?= base_url().'about';?></loc> 
        <priority>0.5</priority>
    </url>
	<url>
        <loc><?= base_url().'term_and_conditions';?></loc> 
        <priority>0.5</priority>
    </url>
	<url>
        <loc><?= base_url().'privacy';?></loc> 
        <priority>0.5</priority>
    </url>
	<url>
        <loc><?= base_url().'refund';?></loc> 
        <priority>0.5</priority>
    </url>
	<url>
        <loc><?= base_url().'shipping_policy';?></loc> 
        <priority>0.5</priority>
    </url>
	<url>
        <loc><?= base_url().'feedback';?></loc> 
        <priority>0.5</priority>
    </url>
	<url>
        <loc><?= base_url().'faq';?></loc> 
        <priority>0.5</priority>
    </url>
	<url>
        <loc><?= base_url().'help';?></loc> 
        <priority>0.5</priority>
    </url>
	<url>
        <loc><?= base_url().'offers';?></loc> 
        <priority>0.5</priority>
    </url>
	<url>
        <loc><?= base_url().'become_seller';?></loc> 
        <priority>0.5</priority>
    </url>
	<url>
        <loc><?= base_url().'track';?></loc> 
        <priority>0.5</priority>
    </url>
	
    <?php foreach($category as $category_data) { ?>
    <url>
        <loc><?= base_url().$category_data['cat_slug']; ?></loc>
        <priority>0.5</priority>
    </url>
    <?php } ?>
	
	<?php foreach($product as $product_data) { ?>
    <url>
        <loc><?= base_url(). $product_data['sku'] . '?pid=' . $product_data['id'] . '&amp;sku=' . $product_data['sku'] . '&amp;sid=' . $product_data['vendor_id']; ?></loc>
        <priority>0.5</priority> 
    </url>
    <?php } ?>

</urlset> 