 </section><!-- end #main-content-->
    <footer id="footer">
    	<div class="container">
        	<div class="row">
            	<div  class="col-md-6">
                    <p class="copy">Copyright &copy; 2015 LG Electronics Indonesia. All Rights Reserved.</p>
                </div>
                <div  class="col-md-6">
                    <div class="footernav">
                            <a href="<?= base_url()?>">Home</a>
                            <a href="<?= base_url()."about" ?>">About</a>
                            <a href="<?= base_url()."prize" ?>">Prizes</a>
                            <a href="<?= base_url()."gallery" ?>">Gallery</a>
                            <a href="<?= base_url()."terms" ?>">Terms &amp; Conditions</a>
                            <div class="socialicon">
                                <a href="http://facebook.com/lgeindonesia" target="_blank"><i class="icon-facebook">&nbsp;</i></a>
                                <a href="http://twitter.com/lgeindonesia" target="_blank"><i class="icon-twitter">&nbsp;</i></a>
                                <a href="http://instagram.com/lgeindonesia" target="_blank"><i class="icon-instagram">&nbsp;</i></a>
                            </div>
                    </div>
                </div>
            </div><!-- end .row -->
        </div><!-- end .container -->
    </footer>
</section><!-- end #container-->


<script src="<?= base_url()?>assets/vendor/custom.js"></script>
<script>
    
	 window.fbAsyncInit = function() {
    FB.init({
      appId      : '411868812332034', 
      xfbml      : true,
	   
      version    : 'v2.3'
    });
  };
	  (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) return;
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
	
  
  function shareFB(fb_name,fb_link,fb_img,fb_user,fb_post){
	  
                    
                       // FB.init();
                        FB.ui({
                                method: 'feed',
								
                                name: fb_name,
                                link: fb_link,
                                picture: fb_img,
                                caption: 'ooo',
                                description: fb_post


                        });

                }

  </script>
<!--script for this page-->
</body>
</html>