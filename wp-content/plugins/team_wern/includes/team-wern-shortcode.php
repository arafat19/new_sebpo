<?php
/**
 * Created by PhpStorm.
 * User: mohammed.mohasin
 * Date: 21-Sep-16
 * Time: 12:30 PM
 */
// ---------- Shortcode [team_wern] -------------

add_shortcode( 'team_wern', 'team_wern_shortcode' );

function team_wern_shortcode( $atts ) {
    $order = 'DESC';
    $posts = 5;
    extract(shortcode_atts(
        array(
            'posts' 	=> -1,
            'order'		=> 'DESC',
            'orderby'   => 'date',
            'title'		=> 'yes'
        ), $atts
    ));
    $sebpo_loop = new WP_Query(
        array(
            'post_type'	=> 'teamwern',
            'order'		=> $order,
            'posts_per_page'	=> $posts
        )
    );
    $output = '<div class="team-content-wrap">';
    $i = 0;
    $j= 0;
    if ( $sebpo_loop->have_posts() ) {
        while($sebpo_loop->have_posts() ) {
            $sebpo_loop->the_post();
            $se_thumb_id = get_post_thumbnail_id();
            $se_portfolio_url = wp_get_attachment_url($se_thumb_id, 'full' );
            $se_portfolio = aq_resize_gs_portfolio( $se_portfolio_url, 400, 482, true, true, true );
            $se_portfolio_alt = get_post_meta($se_thumb_id,'_wp_attachment_image_alt',true);

            $se_p_meta = get_post_meta( get_the_id() );
            $se_p_title = get_the_title();
            $se_p_content = get_the_content();
            // for start mother div for every child
            if($i==0 && $j==0){
                $output .=  '<div class="row margin-top50">';
                $i = 1; // flag
                $j=0; // increment
            }
            if($j== 0) $class = 'margin-top70';
            elseif ($j==1) $class = 'margin-top250';
            elseif ($j==2) $class = 'margin-top100';
            elseif ($j==3) $class = '';

            $j++;
            $output .= '
                         <div class="col-md-3 '.$class.' text-left">
                                <hr>
                                <div class="team-content">
                                    <h4 class="header-topbar">'.get_post_meta(get_the_ID(),'member_designation',true).'</h4>
                                    <h2>'.get_the_title().'</h2>
                                    '.apply_filters('the_content',get_the_content() ).'
                                    <p> <a href="mailto:'.get_post_meta(get_the_ID(),'member_email',true).'" target="_top">'.get_post_meta(get_the_ID(),'member_email',true).'</a></p>
                                </div>
                            </div>
                    ';

            if($i==1 && $j==4){
                $output .=  '</div>';  // end row margin-top50 for every 4
                $i = 0;
                $j = 0;
            }

        } // end while loop
        if($i==1){
            $output .=  '</div>'; // if margin-top50 is not end by the loop
            $i = 0;

        } // end inner-content
        $output .= '</div>'; // end team-content
    } else {

    }
    //   $output = apply_filters('the_content',$output);

    wp_reset_postdata();
    wp_reset_query(); // end wrap

    return $output;
}


add_shortcode( 'team_wern_header', 'team_wern_shortcode_header' );

function team_wern_shortcode_header( $atts ) {
    $output = '';
    extract(shortcode_atts(
        array(
            'display' 	=> 'no',
        ), $atts
    ));

    $desktop_img = cs_get_option( 'team_page_header_img' );
    if($desktop_img) {
        $output = '
            <div class="row margin-top100">
                <div class="col-md-12 team-photo">
                    <img class="img-responsive" src="' . $desktop_img . '">
                    <hr>
					<h2 class="text-left hidden-lg hidden-md">Team</h2>

                </div>
            </div>
    ';

        return $output;
    }else
        return '';

}
