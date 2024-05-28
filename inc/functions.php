<?php 

function paew_custom_excerpt_length( $length = 15 ) {
	$excerpt = get_the_excerpt();
    $excerpt = substr($excerpt, 0, $length);
    $result = substr($excerpt, 0, strrpos($excerpt, ' '));
    echo $result;
}

function paew_post_entry_header() {
    if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( ' ' );
            if ( !is_single() && $categories_list ) {
                /* translators: 1: list of categories. */
                printf( '<span class="cat-links">' . '%1$s' . '</span>', $categories_list ); // WPCS: XSS OK.
            }
    }
}

function paew_post_entry_footer() {

    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date( 'M j, Y' ) ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date( 'M j, Y' ) )
    );
    $year = get_the_date( 'Y' );
    $month = get_the_date( 'm' );
    $link = ( is_single() ) ? get_month_link( $year, $month ) : get_permalink();

    $posted_on = '<a href="' . esc_url( $link ) . '" rel="bookmark">' . $time_string . '</a>';

    if ( !is_single() && !get_theme_mod( 'hide_date', false ) ){
        echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
    }else if ( is_single() && !get_theme_mod( 'hide_single_post_date', false ) ){
        echo '<span class="posted-on">' . $posted_on . '</span>';
    }

    $byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

    if ( !is_single() && !get_theme_mod( 'hide_author', false ) ){
        echo '<span class="byline"> ' . $byline . '</span>';
    }

    if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        if( !is_single() && !get_theme_mod( 'hide_comment', false ) ){ 
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __( 'Comment<span class="screen-reader-text"> on %s</span>', 'bosa' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                )
            );
            echo '</span>';
        }else if ( is_single() && !get_theme_mod( 'hide_single_post_comment', false ) ){
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'bosa' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                )
            );
            echo '</span>';
        }
    }

    if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( esc_html__( ', ', 'bosa' ) );
            
            if( is_single() && $categories_list && !get_theme_mod( 'hide_single_post_category', false ) ){
                /* translators: 1: list of categories. */
                printf( '<span class="cat-links">' . '%1$s' . '</span>', $categories_list ); // WPCS: XSS OK.
            }
    }

    if ( is_single() && !get_theme_mod( 'hide_single_post_tag_links', false ) ){ 
        if( get_the_tag_list() ): ?>
            <div class="tag-links">
                <span class="screen-reader-text">
                    <?php echo esc_html__( 'Tags', 'bosa' ); ?>
                </span>
                <?php echo get_the_tag_list( '', esc_html__( ', ', 'bosa' ) ); ?>
            </div>
        <?php endif; 
    } 
}