<?php
/************************************************************************/
/* ATutor																*/
/************************************************************************/
/* Copyright (c) 2002-2005 by Greg Gay, Joel Kronenberg, Heidi Hazelton	*/
/* http://atutor.ca														*/
/*																		*/
/* This program is free software. You can redistribute it and/or		*/
/* modify it under the terms of the GNU General Public License			*/
/* as published by the Free Software Foundation.						*/
/************************************************************************/
// $Id$

if (!defined('AT_INCLUDE_PATH')) { exit; }

print_progress($step);

?>
<p><strong>Congratulations on your installation of ATutor <?php echo $new_version; ?><i>!</i></strong></p>

<p>It is important that you login to the Administration section to review and set any new System Configuration options.</p>

<p>See the <a href="http://atutor.ca/forums/">Support Forums</a> on <a href="http://atutor.ca">atutor.ca</a> for additional help &amp; support.</p>

<br />

<form method="get" action="../login.php">
	<div align="center">
		<input type="submit" name="submit" value="&raquo; Log-in!" class="button" />
	</div>
</form>