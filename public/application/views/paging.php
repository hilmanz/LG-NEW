<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
p{margin: 10px;
	padding: 5px;}
#finalResult{
	list-style-type: none;
	margin: 10px;
	padding: 5px;
	width:300px;
}
</style>
<script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/jquery.js"></script>
<script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/json2.js"></script>
<script>
$(document).ready(function () {
    $(window).scroll(function () {        	
        if ($(window).scrollTop() == ( $(document).height() - $(window).height())) {
            loadData();
        }
    });

    function loadData() {
    	$.ajax({
			type: "post",
			url: "localhost:8080/paging2/page.php",
			cache: false,				
			data:'',
			success: function(response){
				
    			var obj = JSON.parse(response);
				try{
					var str = '';
					var items=[]; 	
					$.each(obj[0], function(i,val){														
						    items.push($('<li/>').text(val.EMPLOYEE_NAME));
					});	
					
					$('#finalResult').fadeOut('slow', function() {
						$(this).append(str).fadeIn('slow').fadeIn(3000);
						$('#finalResult').css({backgroundColor: ''});
						$('#finalResult').append.apply($('#finalResult'), items);
					}).css({backgroundColor: '#D4ED91'});
											
				}catch(e) {		
					alert('Exception while request..');
				}		
			},
			error: function(){						
				alert('Error while request..');
			}
		 });
        

    }

});
</script>
</head>
<body>		
	<h1>Load data on page scroll using jQuery Php Codeigniter and Mysql  </h1>
	<p>Ajax Load data Demo, Ajax Demo, Jquery Ajax Example</p>
	<p>Ajax Load data Demo, Ajax Demo, Jquery Ajax Example</p>
	<p>Ajax Load data Demo, Ajax Demo, Jquery Ajax Example</p>
	<p>Php Jquery Example Php Jquery Example Php Jquery Example</p>
	<p>Jquery ajax script demo, Jquery tutorial example</p>
	<p>Jquery ajax script demo, Jquery tutorial example</p>
	<p>Jquery ajax script demo, Jquery tutorial example</p>
	<p>Ajax Load data Demo, Ajax Demo, Jquery Ajax Example</p>
	<p>Ajax Load data Demo, Ajax Demo, Jquery Ajax Example</p>
	<p>Ajax Load data Demo, Ajax Demo, Jquery Ajax Example</p>
	<p>Php Jquery Example Php Jquery Example Php Jquery Example</p>
	<p>Jquery ajax script demo, Jquery tutorial example</p>
	<p>Jquery ajax script demo, Jquery tutorial example</p>
	<p>Jquery ajax script demo, Jquery tutorial example</p>
	<p>Ajax Load data Demo, Ajax Demo, Jquery Ajax Example</p>
	<p>Ajax Load data Demo, Ajax Demo, Jquery Ajax Example</p>
	<p>Ajax Load data Demo, Ajax Demo, Jquery Ajax Example</p>
	<p>Php Jquery Example Php Jquery Example Php Jquery Example</p>
	<p>Jquery ajax script demo, Jquery tutorial example</p>
	<p>Jquery ajax script demo, Jquery tutorial example</p>
	<p>Jquery ajax script demo, Jquery tutorial example</p>
	<p>Ajax Load data Demo, Ajax Demo, Jquery Ajax Example</p>
	<p>Ajax Load data Demo, Ajax Demo, Jquery Ajax Example</p>
	<p>Ajax Load data Demo, Ajax Demo, Jquery Ajax Example</p>
	<p>Php Jquery Example Php Jquery Example Php Jquery Example</p>
	<p>Jquery ajax script demo, Jquery tutorial example</p>
	<p>Jquery ajax script demo, Jquery tutorial example</p>
	<p>Jquery ajax script demo, Jquery tutorial example</p>	
	<ul id="finalResult">
	</ul>
	
	
</body>
</html>