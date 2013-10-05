<?php 
/**
 * @fileName: functions.php
 * @dir: content/themes/
 */
if(!defined('_iEXEC')) exit;

function portal_theme_option( $param = null, $args = '' ){	
	$defaults = array(
		'logo' => get_template_directory_uri() .'/images/logo.png',
		'logo_w' => 200,
		'logo_h' => 60,
		'artist' => 1,
		'ads468x60' => get_template_directory_uri() .'/images/ads/ads468x60.jpg',
		'ads160x600' => get_template_directory_uri() .'/images/ads/ads160x600.jpg',	
		'ads300x250' => get_template_directory_uri() .'/images/ads/ads300x250.jpg',	
		'tabber' => 0,	
		'limit_post' => 10,
		'ga-id' => 'UA-146052-10',	
		'front' => 'default',
		'topnews' => 0
	);
	
	if( checked_option( 'portal_options' ) && empty($args) ){
		$args = get_option('portal_options');
		$args = (array) json_decode( $args );
	}
	
	$r = parse_args( $args, $defaults );
	
	if( $param )
		return $r[$param];
	else
		return $r;
}

function the_content_home(){	
	if( !the_contents() ):
		if(portal_theme_option('front') == 'slide' 
		|| portal_theme_option('front') == 'topic' )
			require_once( 'page-front.php' );
		
		if(portal_theme_option('front') == 'topic' )
			require_once( 'page-front.php' );
		else
			require_once( 'page-front.php' );		
		
	endif;
}

function classic_soft_widgets_init() {
if (function_exists('register_sidebar'))
{
	register_sidebar(array(
		'name'			=> 'Home/Page Left',
	    'before_widget'	=> '',
	    'after_widget'	=> '</div>',
	    'before_title'	=> '<h3>',
	    'after_title'	=> '</h3><div class="clear"></div><div class="box">',
	));		
	
    register_sidebar(array(
		'name'			=> 'Home Right #Full Width',
        'before_widget'	=> '',
        'after_widget'	=> '</div>',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3><div class="clear"></div><div class="box">',
    ));		
	
    register_sidebar(array(
		'name'			=> 'Home Right #Left',
        'before_widget'	=> '',
        'after_widget'	=> '</div>',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3><div class="clear"></div><div class="box">',
    ));	
	
    register_sidebar(array(
		'name'			=> 'Home Right #Right',
        'before_widget'	=> '',
        'after_widget'	=> '</div>',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3><div class="clear"></div><div class="box">',
    ));		
		
    register_sidebar(array(
		'name'			=> 'Page Right',
        'before_widget'	=> '',
        'after_widget'	=> '</div>',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3><div class="clear"></div><div class="box">',
    ));	
    
    register_sidebar(array(
    	'name'			=> 'Footer',
        'before_widget'	=> '',
        'after_widget'	=> '</div>',
        'before_title'	=> '<div class="footerwidget left"><h3>',
        'after_title'	=> '</h3>',
    ));	
}}


function add_the_content_view( $data ){
global $view;

$view = $data->view;
	
if( $data->the_title )
$GLOBALS['the_title'] = $data->the_title;
if( $data->the_desc )
$GLOBALS['the_desc'] = $data->the_desc;
if( $data->the_key )
$GLOBALS['the_key'] = $data->the_key;

if( $data->view == 'page-full' ){?>
	<div id="content">
    <?php if ( !empty($data->title) ) : ?>
		<p class="breadcrumb"><span class="glyphicon glyphicon-map-marker"></span> <?php echo $data->browse?></p>
	  	<div class="page-header">
	    	<h2 class="posttitle"><?php echo $data->title?></h2>
	    	<span class="by"><span class="glyphicon glyphicon-user"></span> <?php echo $data->posted?></span>
	    </div> <!--end: postmeta-->
	  	<div class="entry">
	    	<?php echo $data->content?>
	    	<div class="clear"></div>
	    	<div class="tags"><span class="glyphicon glyphicon-tag"></span>
	      		<?php the_tags(); ?>
	    	</div> <!--end: tags-->
	  	</div> <!--end: entry-->
	  	<?php comments_template(); ?>
    <?php else : ?>
        <h2 class="pagetitle">Page Not Found</h2>
    <?php endif; ?>
	</div> <!-- function end: content-->
<?php }elseif( $data->view == 'page' ){?>
    <div id="content">
    <?php if ( !empty($data->title) ) : ?>
        <h2 class="pagetitle"><?php echo $data->title; ?></h2>
        <div class="entry">
            <?php echo $data->content; ?>
        </div> <!--end: entry-->
      <div class="clear"></div>
    <?php else : ?>
        <h2 class="pagetitle">Page Not Found</h2>
    <?php endif; ?>
    </div> <!-- function end: content-->
<?php }elseif( $data->view == 'archive' ){?>
  <div id="content">
	<?php if ( is_array($data->content) && count($data->content) > 0 ) : ?>
	<p class="breadcrumb"><span class="glyphicon glyphicon-map-marker"></span> <?php echo $data->browse;?></p>
	<?php foreach ( $data->content as $content ) :?>
  	<div class="media">
    	<?php $thumb = get_template_directory_uri().'/images/no-preview.png'; if( !empty($content[thumb]) ): $thumb = content_url('/uploads/post/'.$content[thumb]); endif;?>
    	<a class="pull-left" href="<?php echo $content[title_url]; ?>" rel="bookmark"><img class="img-circle" title="<?php echo $content[title]; ?>" src="<?php echo site_url().'/?request&load=libs/timthumb.php&src=' . $thumb; ?>&amp;h=100&amp;w=100&amp;zc=1" alt="<?php echo $content[title]; ?>"></a>    	
		<div class="media-body">
      	<h4><a href="<?php echo $content[title_url]; ?>" rel="bookmark"><?php echo $content[title]; ?></a></h4>
      		<p><?php echo $content[content]; ?></p>
		</div>
	</div> <!--end: media thumb-->
  </div> <!-- function end: archive-->
  <?php endforeach; ?>
    <?php if( count($data->paging) > 0 ):?>
  	<div class="pagination">  
    <?php 
	$paging = new Pagination();
	$paging->set('urlscheme',$data->paging[urlscheme]);
	$paging->set('perpage',$data->paging[perpage]);
	$paging->set('page',$data->paging[page]);
	$paging->set('total',$data->paging[total]);
	$paging->set('nexttext','Next');
	$paging->set('prevtext','Previous');
	$paging->set('focusedclass','selected');
	$paging->display();
	?>        
    <div class="clear"></div>
	</div> <!--end: pagenavi-->
    <?php endif;?>
	<?php else : ?>
        <h2 class="pagetitle">Page Not Found</h2>
    <?php endif; ?>
<?php
}elseif( $data->view == '404' ){
set_query_var('com','404');
?>
	<div id="content">
        <h2 class="pagetitle">Page Not Found</h2>
	</div> <!--end: content-->
<?php
}elseif( $data->view == 'archives' ){?>
	<div id="content">
  		<h2 class="pagetitle">Archives</h2>
        <div class="entry">
            <h4>Monthly:</h4>
            <ul>
                a
            </ul>
            <h4>Subjects:</h4>
            <ul>
                a
            </ul>
            <h4>Posts:</h4>
            <ul>
                a
            </ul>
        </div> <!--end: entry-->
	</div> <!--end: content-->
<?php
}elseif( $data->view == 'apps' ){
?>
	<div id="content">
    <h2 class="pagetitle"><?php echo $data->title;?></h2>
	<div><?php echo $data->content;?></div>
    </div>
<?php
}
}

function get_comment_total( $id ){
	global $db;
	
	$id = filter_int( $id );
		
	$qry_comment			= $db->select("post_comment",array('post_id'=>$id,'approved'=>1,'comment_parent'=>0)); 
	$num1					= $db->num($qry_comment);
	$num2					= 0;
	while ($data			= $db->fetch_array($qry_comment)) {
		$no_comment 		= filter_int( $data['comment_id'] );
						
		$qry_comment2		= $db->select("post_comment",array('approved'=>1,'comment_parent'=>$no_comment)); 
		$num2				= $num2+$db->num($qry_comment2);
	}
	return $num1+$num2;	
		
}

function tp_popular_posts($no_posts = 5, $before = '<li>', $after = '</li>', $duration='') {
	global $db;
		
	$request = "SELECT id, title, COUNT($db->post_comment.post_id) AS comment_count FROM $db->post,$db->post_comment";
	$request.= " WHERE $db->post.id=$db->post_comment.post_id AND $db->post_comment.approved = '1'  AND $db->post.status = '1'";
	
	if( $duration !="" )
	$request.= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < $db->post.date_post ";
		
	$request.= " GROUP BY $db->post_comment.post_id ORDER BY comment_count DESC LIMIT $no_posts";	
		
	$query_request 	= $db->query($request);	
	$post_count 	= $db->num($query_request);	
		
	$output = '';
	if( $post_count > 0 ) {
		while ( $post = $db->fetch_obj($query_request) ) {
			$post_title = stripslashes($post->title);
			$comment_count = $post->comment_count;
			$permalink = do_links('post', array('view' => 'item', 'id' => $post->id, 'title' => $post->title));
			$output .= $before . '<a href="' . $permalink . '" title="' . $post_title.'">' . $post_title . '</a>' . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	echo $output;
}

function tp_recent_comments($no_comments = 5, $comment_lenth = 5, $before = '<li>', $after = '</li>', $comment_style = 1) {
	global $db;
	
	$request = "SELECT id, comment_id, comment, author, title FROM $db->post_comment LEFT JOIN $db->post ON iw_post.id=$db->post_comment.post_id WHERE $db->post.status IN ('1','0') ";		
	$request.= "AND $db->post_comment.approved = '1' ORDER BY $db->post_comment.comment_id DESC LIMIT $no_comments";

	$query_request 	= $db->query($request);
	$comments_count = $db->num($query_request);	
	
	$output = '';

	if ( $comments_count > 0 ) {
		$idx = 0;
		while ( $comment = $db->fetch_obj($query_request) ) {
			$comment_author = stripslashes($comment->author);
			if ($comment_author == "")
				$comment_author = "anonymous"; 
				
				$comment_content = strip_tags($comment->comment);
				$comment_content = stripslashes($comment_content);
				$words = split(" ", $comment_content); 
				$comment_excerpt = join(" ", array_slice($words, 0, $comment_lenth));
				
				$link = do_links('post', array('view' => 'item', 'id' => $comment->id, 'title' => $comment->title));
				$permalink = $link . "#respon-" . $idx;
				
				if ( 1 == $comment_style ) {
					$post_title = stripslashes($comment->title);
					$post_id= stripslashes($comment->id);
					$url = '#';
					$idx++;
					if ( 1 == $idx % 2 )
						$before = "<li>";
					else
						$before = "<li>";
					$output .= $before . "<a href='$permalink'>$comment_author</a>" . ' on <a href="'.$link.'">' . $post_title . '</a>' . $after;
				} else {
					$idx++;
					if ( 1 == $idx % 2 )
						$before = "<li class=''>";
					else
						$before = "<li class=''>";
		
					$output .= $before . '<strong>' . $comment_author . ':</strong> <a href="' . $permalink;
					$output .= '" title="View the entire comment by ' . $comment_author.'">' . $comment_excerpt.'</a>' . $after;
				}
			}

			$output = convert_smilies($output);
	} else {
		$output .= $before . "None found" . $after;
	}

	echo $output;
}