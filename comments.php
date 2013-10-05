<?php
/**
 * @file comments.php
 *
 */
//dilarang mengakses
if(!defined('_iEXEC')) exit;
global $db, $the_title;

do_action('the_comments');

$id = get_posted_id('item', get_query_var('id') );
$id_reply = get_query_var('go');
?>

<?php
if( get_option('post_comment') == 1 ):
/*
 *show comment where id post and status = 1 order by id desc limit where data limit table id_comment_set
 */

$color = '';
$comment_no = 0;
$qry_comment = $db->select("post_comment",array('post_id'=>$id,'approved'=>1,'comment_parent'=>0)); 
?>
<br style="clear:both" />
<div class="page-header">
<h2 class=border><span class="label label-info"><?php echo count_comment($id)?></span> Respon dari <small>"<?php echo $the_title;?>"</small></h2>
</div>
<ul class="media-list">
<?php
while ($data = $db->fetch_obj($qry_comment)) {	
$no_comment = filter_int( $data->comment_id );
$no_respon = filter_int( $comment_no++ );

$reply_link = do_links('post',array('view'=>'item','id'=>$id,'title'=>$the_title,'go'=>$no_comment));
?>
<li class="media" id="respon-<?php echo $no_respon;?>">

<a class="pull-left"><img class="media-object" alt="<?php echo $data->author;?>" src="<?php echo get_gravatar($data->email);?>" /></a>
<div class="media-body">
<h4 class="media-heading"><?php echo $data->author;?> <span class="badge"><?php echo time_stamp($data->time); ?></span></h4> 
<?php echo $data->comment;?>

<div style="clear:both"></div> 
<?php if($id_reply != $no_comment):?>
<div class='btn btn-sm btn-info'><a rel="nofollow" class="comment-reply-link" href='<?php echo $reply_link?>#respon-comment'>Balas </a></div>
<?php endif;?>
<hr>
		<?php
        $comment_no_reply	= 0;
        $q2					= $db->select("post_comment",array('post_id'=>$id,'approved'=>1,'comment_parent'=>$no_comment)); 
        while ($data2		= $db->fetch_array($q2)) {
        $no_respon_reply	= filter_int( $comment_no_reply++ );
        ?>
		<div class="meddia" id="respon-<?php echo $no_respon;?>-<?php echo $no_respon_reply;?>">
            <a class="pull-left"><img class="media-object" alt="<?php echo $data->author;?>" src="<?php echo get_gravatar($data->email);?>" /></a>
            <div class="media-body">
            <h4 class="media-heading"><?php echo $data2['author'];?> <span class="badge"><?php echo time_stamp($data2['time']);?></span></h4>
			<?php echo $data2['comment'];?>
            </div>
        </div>
		<hr>
        <?php
        }
        ?>
</div>
</li>
<?php
}
?>
</ul>

<div class="page-header">
<h2><span class="glyphicon glyphicon-comment"></span> Tinggalkan Komentar <small><?php if(isset($id_reply)) echo 'Balasan'?></small></h2>
</div>
<?php

if( $id_reply ): 
$id_link = do_links('post',array('view'=>'item','id'=>$id,'title'=>$the_title));
?>
<div align="right"><a href="<?php echo $id_link?>#respon-comment" class="post_reply">New Comment</a></div>
<?php
endif;

if(isset($_POST['submit_comment'])){

if(!get_comment_login())
{
	$author		= filter_txt($_POST['author']);
	$email 		= filter_txt($_POST['email']);
}
else
{
	$field 		= get_current_comment();
		
	$user 		= $field->user_login;
	$email 		= $field->user_email;
	$author		= $field->user_author;
}

	$comment 	= filter_txt($_POST['comment']);
	$comment 	= nl2br($comment);
	
	$approved	= get_option('post_comment_filter');
	
	$reply	    = $id_reply;
	$post_id    = filter_int($id);
	
	$security_code_check = filter_txt($_POST['security_code_check']);
	$security_code = filter_txt($_SESSION['security_code']);
	
	$data 		= compact('user','author','email','comment','date','approved','security_code_check','security_code','reply','post_id');
	comment_post($data);

}
?>

<div id="respon-comment">
<form class="form-horizontal" role="form" method="post" action="#commentform">
  <?php
  if(!get_comment_login())
  {
  ?>
  <div class="form-group">
    <label for="nama" class="col-lg-2 control-label">Nama*</label>
    <div class="col-lg-10">
      <input type="text" name="author" class="form-control" id="nama" placeholder="Nama*">
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-lg-2 control-label">eMail*</label>
    <div class="col-lg-10">
      <input type="text" name="email" class="form-control" id="email" placeholder="eMail*">
    </div>
  </div>
    <?php
  	$gfx_code = true;
  }
  else
  {
	$field 	= get_current_comment();
	
	if( $user->user_level == 'admin' )
//	if( $user->user_level == 'user' )
  		$gfx_code = false;
	?>   
      <div class="alert alert-info">Logged in as <a href="<?php echo do_links('login',array('go'=>'profile'))?>"><?php echo $field->user_login?></a>. <a href="?login&go=logout"  onclick="return confirm('Are You sure logout?')">Log out?</a></div>
   <?php
  }
  ?>
  <div class="form-group">
    <label for="commmenbox1" class="col-lg-2 control-label">Komentar*</label>
    <div class="col-lg-10">
      <textarea id="commmenbox1" name="comment" class="form-control" rows="5" placeholder="Komentar*"></textarea>
    </div>
  </div>
   <?php if( $gfx_code ){?>
  <div class="form-group">
  <label for="kode1" class="col-lg-2 control-label">Kode Keamanan*</label>
    <div class="row">
	<div class="col-lg-3"><img src="<?php echo site_url('?request&load=libs/captcha/random.php')?>"></div> 
	<div class="col-lg-3"><input id="kode1" name="security_code_check" class="form-control" type="text" placeholder="Kode Keamanan*"></div>
	</div>
  </div>
    <?php }?>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" name="submit_comment" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-send"></span> Kirim Komentar!</button>
    </div>
  </div>
</form>
</div>
<?php
endif;
?>