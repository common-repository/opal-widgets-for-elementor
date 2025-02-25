<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class OSF_Elementor_Megaproducts_Widget extends OSF_Elementor_Slick_Widget {

    public function get_categories() {
        return array('opal-woo');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'opal-megaproducts';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Woo Mega Products', 'opalelementor');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-woocommerce';
    }


    public static function get_button_sizes() {
        return [
            'xs' => __('Extra Small', 'opalelementor'),
            'sm' => __('Small', 'opalelementor'),
            'md' => __('Medium', 'opalelementor'),
            'lg' => __('Large', 'opalelementor'),
            'xl' => __('Extra Large', 'opalelementor'),
        ];
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        //Section Query
        $this->start_controls_section(
            'section_setting',
            [
                'label' => __('Settings', 'opalelementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'heading',
            [
                'label'   => __('Heading', 'opalelementor'),
                'type'    => Controls_Manager::TEXT,
                'default' => "Category Heading",
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'   => __('Posts Per Page', 'opalelementor'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'   => __('columns', 'opalelementor'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 3,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5=> 5, 6 => 6],
            ]
        );


        $this->add_control(
            'advanced',
            [
                'label' => __('Advanced', 'opalelementor'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => __('Order By', 'opalelementor'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date'       => __('Date', 'opalelementor'),
                    'id'         => __('Post ID', 'opalelementor'),
                    'menu_order' => __('Menu Order', 'opalelementor'),
                    'popularity' => __('Number of purchases', 'opalelementor'),
                    'rating'     => __('Average Product Rating', 'opalelementor'),
                    'title'      => __('Product Title', 'opalelementor'),
                    'rand'       => __('Random', 'opalelementor'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => __('Order', 'opalelementor'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'  => __('ASC', 'opalelementor'),
                    'desc' => __('DESC', 'opalelementor'),
                ],
            ]
        );

        $this->add_control(
            'categories',
            [
                'label'    => __('Categories', 'opalelementor'),
                'type'     => Controls_Manager::SELECT2,
                'options'  => $this->get_product_categories(),
                'multiple' => true,
            ]
        );

        $this->add_control(
            'cat_operator',
            [
                'label'     => __('Category Operator', 'opalelementor'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'IN',
                'options'   => [
                    'AND'    => __('AND', 'opalelementor'),
                    'IN'     => __('IN', 'opalelementor'),
                    'NOT IN' => __('NOT IN', 'opalelementor'),
                ],
                'condition' => [
                    'categories!' => ''
                ],
            ]
        );

        $this->add_control(
            'product_type',
            [
                'label'   => __('Product Type', 'opalelementor'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'newest',
                'options' => [
                    'newest'       => __('Newest Products', 'opalelementor'),
                    'on_sale'      => __('On Sale Products', 'opalelementor'),
                    'best_selling' => __('Best Selling', 'opalelementor'),
                    'top_rated'    => __('Top Rated', 'opalelementor'),
                    'featured'     => __('Featured Product', 'opalelementor'),
                ],
            ]
        );

        $this->add_control(
            'paginate',
            [
                'label'   => __('Paginate', 'opalelementor'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'       => __('None', 'opalelementor'),
                    'pagination' => __('Pagination', 'opalelementor'),
                ],
            ]
        );

        $this->add_control(
            'ajaxfilter',
            [
                'label'   => __('Ajax Filter', 'opalelementor'),
                'type'    => Controls_Manager::SELECT,
                'default' => 0,
                'options' => [
                    0       => __('None', 'opalelementor'),
                    1 => __('Yes, Use', 'opalelementor'),
                ],
            ]
        );

        $this->add_control(
            'style_layout',
            [
                'label'   => __('Style Layout', 'opalelementor'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'navigation-top',
                'options' => [
                    'navigation-top'  => __('Navigation Top', 'opalelementor'),
                    'navigation-left'  => __('Navigation Left', 'opalelementor'),
                ]
            ]
        );
         $this->add_control(
            'product_layout',
            [
                'label'   => __('Product Layout', 'opalelementor'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'content',
                'options' => osf_elementor_product_loop_layouts()
            ]
        );
        $this->add_control(
            'enable_carousel',
            [
                'label' => __('Enable', 'opalelementor'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();
     
        $this->add_slick_controls(  array('enable_carousel' => 'yes') , ' .product-slick-carousel ' );
    }


    protected function get_product_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
            )
        );
        $results    = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }
        return $results;
    }

    protected function get_product_type($atts, $product_type) {
        switch ($product_type) {
            case 'featured':
                $atts['visibility'] = "featured";
                break;

            default:
                break;
        }
        return $atts;
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();


        $type     = 'products';
        $atts     = [
            'limit'          => $settings['limit'],
            'columns'        => $settings['column'],
            'orderby'        => $settings['orderby'],
            'order'          => $settings['order'],
            'product_layout' => $settings['product_layout'],
        ];

        $atts = $this->get_product_type($atts, $settings['product_type']);
        if (isset($atts['on_sale']) && wc_string_to_bool($atts['on_sale'])) {
            $type = 'sale_products';
        } elseif (isset($atts['best_selling']) && wc_string_to_bool($atts['best_selling'])) {
            $type = 'best_selling_products';
        } elseif (isset($atts['top_rated']) && wc_string_to_bool($atts['top_rated'])) {
            $type = 'top_rated_products';
        }

        if (!empty($settings['categories'])) {
            $atts['category']     = implode(',', $settings['categories']);
            $atts['cat_operator'] = $settings['cat_operator'];
        }
        

        if ($settings['paginate'] === 'pagination') {
            $atts['paginate'] = 'true';
        }

        $shortcode = new WC_Shortcode_Products($atts, $type);
        $cls = $settings['style_layout']; 
        if( $settings['ajaxfilter'] ){
            $cls .= " has-ajax-filter"; 
        }
     //   echo '<pre>' . print_r( $settings, 1 ); die;
    ?>    
    <?php if( !empty( $atts['category'] ) ): 
        $categories = explode(",", $atts['category'] );
    ?>    
    <div class="opal-woo-mega-products <?php echo esc_attr( $cls ); ?>">
        <?php if( $cls == 'navigation-top' ) : ?>
        <div class="mega-products-content">
            <div class="content-categories clear clearfix">
                <?php if( !empty($settings['heading']) ): ?>
                <h3 class="pull-left"><?php echo $settings['heading'] ;?></h3>
                <?php endif; ?>
                 <ul class="category-links oe-list-inline pull-right">
                <?php foreach( $categories as $category ):
                    
                    $term = get_term_by( 'slug', trim($category), 'product_cat' ); 
                    $category_link = get_category_link($term->cat_ID);
                ?>
               <li><a href="<?php echo esc_url( $category_link ); ?>" data-term-id="<?php echo esc_attr($category->cat_ID );?>"><?php echo $term->name; ?></a></li>
                <?php endforeach; ?>
                </ul>
            </div>
            <div class="content-products"> 
                <?php 
                     $shortcode = new Opal_WC_Shortcode_products( $atts, $type );
                    $this->render_carousel_or_grid( $settings, $shortcode->get_content() );
                ?>
             </div>
        </div>    
        <?php else : ?>
            <div class="mega-products-content clear clearfix">
                <div class="content-categories">
                    <?php if( !empty($settings['heading']) ): ?>
                    <h3><?php echo $settings['heading'] ;?></h3>
                    <?php endif; ?>
                     <ul class="category-links oe-list-block">
                    <?php foreach( $categories as $category ): 
                       
                        $term = get_term_by( 'slug', trim($category), 'product_cat' ); 
                        $category_link = get_category_link( $term->cat_ID );
                    ?>
                   <li><a href="<?php echo esc_url( $category_link ); ?>" data-term-id="<?php echo esc_attr($term->cat_ID );?>"><?php echo $term->name; ?></a></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <div class="content-products"> 
                    <?php 
                     $shortcode = new Opal_WC_Shortcode_products( $atts, $type );
                    $this->render_carousel_or_grid( $settings, $shortcode->get_content() );
                    ?>
                </div>
            </div> 

        <?php endif; ?>   
    </div>
    <?php  else : ?>
   <div class="alert alert-info"><?php _e( 'Please select categories to show product in mega style', 'opalelementor' ); ?></div>
    <?php endif; ?>
    <?php }

	protected function get_query_results($query_args) {
		$query_args['paged'] = 2;
        $query = new WP_Query( $query_args );
        $paginated = !empty( $query->posts ) ? true : false;
		return $paginated;
	}
}
