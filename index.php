<?php
/**
 * The Index for our theme.
 *
 * @package ID
 * @subpackage Portal
 * @since Portal 1.3
 */
if(!defined('_iEXEC')) exit;
?>
<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
<title><?php the_title( true );?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="<?php get_info( 'charset', true ); ?>">
<meta name="Description" content="<?php get_info( 'description', true ); ?>">
<meta name="Keywords" content="<?php get_info( 'keywords', true ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<!-- Bootstrap -->
<link href="<?php echo get_template_directory_uri(true); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(true); ?>/style.css" rel="stylesheet" type="text/css" />
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php get_template_directory_uri(true); ?>/bootstrap/js/html5shiv.js"></script>
      <script src="<?php get_template_directory_uri(true); ?>/bootstrap/js/respond.min.js"></script>
	<![endif]-->
    <script type="text/javascript">

     var _gaq = _gaq || [];
      _gaq.push(['_setAccount', '<?php echo portal_theme_option('ga-id');?>']);
      _gaq.push(['_trackPageview']);

     (function() {
       var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
       ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
     })();

    </script>
<?php the_head();?>
</head>	
  <body>

    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <div class="navbar navbar-tigefa navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url(); ?>"><?php get_info( 'sitename', true ); ?></a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="<?php echo site_url(); ?>">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="http://builtwithbootstrap.com/" target="_blank">Built With Bootstrap</a></li>
            <li><a href="https://wrapbootstrap.com/?ref=tgfa" target="_blank">WrapBootstrap</a></li>
          </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a class="btn btn-primary btn-lg">Learn more &raquo;</a></p>
      </div>
    </div>	  

      <!-- Begin page content -->
      <div class="container">
	  <div class="row">
	  <div class="col-md-9">
      <?php the_content();?>
      </div>
	  <div class="col-md-3">
	<?php if( portal_theme_option('ads160x600') ):?>
    <a href="#" target="_blank"><img src="<?php echo portal_theme_option('ads160x600');?>"></a>
    <?php endif;?>      
      </div>
    </div><!-- row end -->
   </div><!-- container end -->
 </div><!-- index wrap end -->

    <div class="container">
	<hr>
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
        </div>
        <div class="col-lg-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
       </div>
        <div class="col-lg-4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
        </div>
      </div>
    </div> <!-- /container -->

    <div id="footer">
      <div class="container">
        <p class="credit"><div class="pull-left"><img alt="<?php the_title( true );?>" src="<?php get_template_directory_uri(true); ?>/images/logo-transparent.png"></div>&copy; <?php echo date('Y');?> <a href="<?php echo site_url(); ?>"><?php get_info( 'sitename', true ); ?></a><br />
		Powered by <a class="badge" href="http://cmsid.org" target="_blank">CMSID</a><br />
		Theme framework by <a href="http://getbootstrap.com" target="_blank">Bootstrap</a></p>
      </div>
    </div>

<script type="text/javascript" src="<?php get_template_directory_uri(true); ?>/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php get_template_directory_uri(true); ?>/bootstrap/js/jquery.js"></script>
<script type="text/javascript" src="<?php get_template_directory_uri(true); ?>/bootstrap/js/application.js"></script>
</body>
</html>