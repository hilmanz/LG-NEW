
   <link rel="stylesheet" media="all" type="text/css" href="<?= base_url()?>assets/css/style-demo.css">

    <script src="<?= base_url()?>assets/js/jquery-1.11.1.js"></script>
    <script src="<?= base_url()?>assets/js/jquery.easing-1.3.js"></script>
    <script src="<?= base_url()?>assets/js/jquery.mousewheel-3.1.12.js"></script>
    <script src="<?= base_url()?>assets/js/jquery.jcarousellite.js"></script>
<hr>
<div id="jcl-demo">
<h3>Slider</h3>
 

    <div class="custom-container default">
        <a href="#" class="prev">&lsaquo;</a>
        <div class="carousel">
            <ul>
			<?php
			foreach ($images as $cont) {
                echo "<li>";				
				echo "<img src='".base_url()."upload/".$cont['image']."'border='0' width='160'>"	;			
				echo "</li>";
				}
               ?>
            </ul>
        </div>
        <a href="#" class="next">&rsaquo;</a>
        <div class="clear"></div>
    </div>


    <script type="text/javascript">
        $(function() {
            $(".default .carousel").jCarouselLite({
                btnNext: ".default .next",
                btnPrev: ".default .prev"
            });
        });
    </script>

</div>
