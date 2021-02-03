<button class="float-right btn btn-sm btn-primary m-1" onclick="exportTableToExcel('links', 'Urls')">
                    <i class="fa fa-download"></i></button>
<table class="table border" id="links">
	<?php foreach (explode(PHP_EOL, $input->links) as $link) { ?>
		<?php if($link != '') { ?>
		<tr><td class="text text-sm"><a href="<?=$link?>" target="_blank"><?=custom_text($link, 80)?></a></td></tr>
		<?php } ?>	
	<?php } ?>
</table>