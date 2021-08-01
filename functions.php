/*Change the Number Of Related Products loop | Single Products Page*/
/* posts_per_page = number of products you want to display*/

add_filter( 'woocommerce_output_related_products_args', 'digics_change_number_related_products', 9999 );
 
function digics_change_number_related_products( $args ) {

 $args['posts_per_page'] = 8; // Number of related products
 $args['columns'] = 4; // Number of columns per row
 return $args;
 
}

/*Add Social Media Share link to the Single Products Pages | After Add the Cart Button*/

add_action('woocommerce_after_add_to_cart_button','digics_show_whatsapp_icon_share_link',10,1);

function digics_show_whatsapp_icon_share_link($product){
  $permalink = get_permalink( $product->ID );
  echo '<a target="_blank" data-toggle="tooltip" data-placement="right" title="Ask to Client" href="https://api.whatsapp.com/send?phone=+919211xxxxxx&text=Hello%20Owner%20I%20am%20interested%20in%20'.$permalink.'%20" class="connect-whatsapp"><i class="fa fa-whatsapp"></i></a>';

}

/*Add Alt tag to all the woocommerce products Images as per the products title
* This Also Help making seo strong for your woocommerce website | Also remove the alt tag missing error to the SEO
*/

add_filter('wp_get_attachment_image_attributes', 'digics_change_attachement_image_attributes', 20, 2);
function digics_change_attachement_image_attributes( $attr, $attachment ){
    // Get post parent
    $parent = get_post_field( 'post_parent', $attachment);
    // Get post type to check if it's product
    $type = get_post_field( 'post_type', $parent);
    if( $type != 'product' ){
        return $attr;
    }
    /// Get title
    $title = get_post_field( 'post_title', $parent);
    $attr['alt'] = $title;
    $attr['title'] = $title;
    return $attr;
}

/* Display product variations SKU and GTIN info 
* This Option Help you to show the products sku after each variation selected on single products pages
*/

add_filter( 'woocommerce_available_variation', 'digics_display_variation_sku', 20, 3 );
function digics_display_variation_sku( $variation_data, $product, $variation ) {
    $html = ''; // Initializing
    // Inserting SKU
    if( ! empty( $variation_data['sku'] ) ){
        $html .= '</div><div class="woocommerce-variation-sku">' . __('SKU:') . ' ' . $variation_data['sku'];
    }
    // Using the variation description to add dynamically the SKU and the GTIN
    $variation_data['variation_description'] .= $html;

    return $variation_data;
}





