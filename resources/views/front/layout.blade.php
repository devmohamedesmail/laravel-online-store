<!DOCTYPE html>
<html class="no-js" lang="en">

<!-- belle/index.html   11 Nov 2019 12:16:10 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>
{{ $setting->name_ar }}
</title>
<meta name="description" content="{{ $setting->description }}" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Favicon -->
<link rel="shortcut icon" href="/uploads/setting/{{ $setting->logo }}" />
<!-- Plugins CSS -->
<link rel="stylesheet" href="/templates/front/assets/css/plugins.css">
<!-- Bootstap CSS -->
<link rel="stylesheet" href="/templates/front/assets/css/bootstrap.min.css">
<!-- Main Style CSS -->
<link rel="stylesheet" href="/templates/front/assets/css/style.css">
<link rel="stylesheet" href="/templates/front/assets/css/responsive.css">
</head>
<body class="template-index belle template-index-belle">
<div id="pre-loader">
    <img src="/templates/front/assets/images/loader.gif" alt="Loading..." />
</div>
<div class="pageWrapper">
    @yield('content')





     <!-- Including Jquery -->
     <script src="/templates/front/assets/js/vendor/jquery-3.3.1.min.js"></script>
     <script src="/templates/front/assets/js/vendor/modernizr-3.6.0.min.js"></script>
     <script src="/templates/front/assets/js/vendor/jquery.cookie.js"></script>
     <script src="/templates/front/assets/js/vendor/wow.min.js"></script>
     <!-- Including Javascript -->
     <script src="/templates/front/assets/js/bootstrap.min.js"></script>
     <script src="/templates/front/assets/js/plugins.js"></script>
     <script src="/templates/front/assets/js/popper.min.js"></script>
     <script src="/templates/front/assets/js/lazysizes.js"></script>
     <script src="/templates/front/assets/js/main.js"></script>
     <!--For Newsletter Popup-->
     <script>
		jQuery(document).ready(function(){  
		  jQuery('.closepopup').on('click', function () {
			  jQuery('#popup-container').fadeOut();
			  jQuery('#modalOverly').fadeOut();
		  });
		  
		  var visits = jQuery.cookie('visits') || 0;
		  visits++;
		  jQuery.cookie('visits', visits, { expires: 1, path: '/' });
		  console.debug(jQuery.cookie('visits')); 
		  if ( jQuery.cookie('visits') > 1 ) {
			jQuery('#modalOverly').hide();
			jQuery('#popup-container').hide();
		  } else {
			  var pageHeight = jQuery(document).height();
			  jQuery('<div id="modalOverly"></div>').insertBefore('body');
			  jQuery('#modalOverly').css("height", pageHeight);
			  jQuery('#popup-container').show();
		  }
		  if (jQuery.cookie('noShowWelcome')) { jQuery('#popup-container').hide(); jQuery('#active-popup').hide(); }
		}); 
		
		jQuery(document).mouseup(function(e){
		  var container = jQuery('#popup-container');
		  if( !container.is(e.target)&& container.has(e.target).length === 0)
		  {
			container.fadeOut();
			jQuery('#modalOverly').fadeIn(200);
			jQuery('#modalOverly').hide();
		  }
		});
	</script>
    <!--End For Newsletter Popup-->
</div>
</body>

<!-- belle/index.html   11 Nov 2019 12:20:55 GMT -->
</html>