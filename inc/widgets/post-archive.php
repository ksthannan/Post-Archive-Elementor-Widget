<?php 
class Elementor_Post_Archive_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'paew_post_archive';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Post Archive Template', 'paew-elementor-post-archive-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-masonry';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'custom' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'post', 'archive', 'post template', 'archive template'];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		// Content Controls 
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'elementor-rrcc-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'step_one_title',
			[
				'label' => esc_html__( 'Post Categories', 'paew' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '', 'rrcc' ),
				'placeholder' => esc_html__( '3, 5, 122', 'paew' ),
			]
		);

		$this->end_controls_section();


		// Style controls 
		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// $this->add_control(
		// 	'font_family',
		// 	[
		// 		'label' => esc_html__( 'Font Family', 'paew' ),
		// 		'type' => \Elementor\Controls_Manager::FONT,
		// 		'default' => "'Open Sans', sans-serif",
		// 		'selectors' => [
		// 			'{{WRAPPER}} ' => 'font-family: {{VALUE}}',
		// 		],
		// 	],
		// );

		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		// $args = array(
		// 	'post_type' => 'post',
		// 	'posts_per_page' => 10,
		// );
		// $the_query = new WP_Query( $args );
		$description = get_the_archive_description();

		if ( have_posts() ) : ?>
		<header class="paew_page_header">
			<?php 
			$q = get_queried_object();
			$title = is_category() ? $q->name : $q->labels->name;
			echo '<h1 class="page-title">' . $title . '</h1>';
			// the_archive_title( '<h1 class="page-title">', '</h1>' );
			 ?>
			<?php if ( $description ) : ?>
				<div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
			<?php endif; ?>
		</header><!-- .page-header -->
			<div class="paew_post_archive">
				<?php
				$i = 1;
				while ( have_posts() ) : the_post(); 
					if($i == 1):
					?>

					<div class="paew_single_featured" style="background:url(<?php the_post_thumbnail_url('medium');?>)">
						<div class="paew_content_featured">
							<?php paew_post_entry_header();?>
							<h3 class="entry-title"> 
								<a href="<?php the_permalink();?>"><?php the_title(); ?></a>
							</h3>
							<div class="entry-meta">
								<?php paew_post_entry_footer();?>
							</div>
							<p><?php paew_custom_excerpt_length(140); ?></p>
						</div>
					</div>

					<?php else: ?>

					<div class="paew_single">
						<a href="<?php the_permalink();?>"><div class="thumb_img" style="background:url(<?php the_post_thumbnail_url('medium');?>);"></div></a>
						<div class="paew_content">
							<?php paew_post_entry_header();?>
							<h3 class="entry-title"> 
								<a href="<?php the_permalink();?>"><?php the_title(); ?></a>
							</h3>
							<div class="entry-meta">
								<?php paew_post_entry_footer();?>
							</div>
							<p><?php paew_custom_excerpt_length(140); ?></p>
						</div>
					</div>
					<?php endif;

					$i++;
				endwhile; ?>
				<?php the_posts_pagination( array(
									'next_text' => '<span>'.esc_html__( 'Next', 'paew' ) .'</span><span class="screen-reader-text">' . esc_html__( 'Next page', 'paew' ) . '</span>',
									'prev_text' => '<span>'.esc_html__( 'Prev', 'paew' ) .'</span><span class="screen-reader-text">' . esc_html__( 'Previous page', 'paew' ) . '</span>',
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'paew' ) . ' </span>',
								));

								 ?>
								 
			</div>
		<?php else : ?>
			<?php echo 'No posts available'; ?>
		<?php endif; ?>

        <?php 

	}

}