</div><!--container-->

<footer>
<div class="fotter-center">
<?php
if(!empty($Ad3)){?> 
<div class="ad">
<?php echo $Ad3;?>
</div><!--ad-->
<?php } ?>
</div>

<div id="footer-bootm">
<div class="fotter-center">
<div class="footer-info"><a class="footer-links"  href="about_us.php">About Us</a> | <a class="footer-links"  href="privacy_policy.php">Privacy Policy</a> | <a class="footer-links"  href="tos.php">Terms of Use</a> | <a class="footer-links" href="contact_us.php">Contact Us</a></div>

<div class="footer-info"><div class="button-box"><div class="footer-button"><a href="<?php echo $settings['fbpage'];?>" target="_blank" class="facebook-follow"></a></div><div class="footer-button"><a href="<?php echo $settings['twitter'];?>" target="_blank" class="twitter-follow"></a></div></div></div>

<div class="footer-info">Copyright &#169; <?php echo date("Y");?> <?php echo $settings['name'];?>. All Rights Reserved.</div>
</div>
</div>
</footer>

<a class="scrollTop" id="top" href="#"></a>

</body>
</html>