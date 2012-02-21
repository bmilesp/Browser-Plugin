<?php echo $this->Html->css('/browser/css/browser_error.css')?>
<div class='browser-error-explanation-wrapper'>
	<div class='browser-error-explanation-title'>
		Warning: You may experience A Security Warning!	
	</div>
	<div class='browser-error-explanation'>
		Your Browser has been Detected as Internet Explorer 7, 
		which is no longer compatable With modern SSL Secure Sites.
		You may continue to purchase products and checkout with full confidence that this is a secure site, 
		but since your Web Browser is obsolete to modern SSL Security Standards, you will see a security warning. 
		<br><br>
		If you would rather not experience a security warning when purchasing products from our site, please download
		and use a modern browser using one of the links below:
		<br><br>
		Please Use <?php echo $this->Html->link('Mozilla Firefox','http://www.mozilla.org/en-US/firefox/new/'); ?> 
		or <?php echo $this->Html->link('Google Chrome','http://support.google.com/chrome/bin/answer.py?hl=en&answer=95346'); ?>.
	</div>
</div>