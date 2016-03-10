<style type="text/css">
	html, body, div, span, object, iframe,
	h1, h2, h3, h4, h5, h6, p, blockquote, pre,
	a, abbr, acronym, address, code,
	del, dfn, em, img, q, dl, dt, dd, ol, ul, li,
	fieldset, form, label, legend,
	input, button, select, textarea,
	table, caption, tbody, tfoot, thead, tr, th, td,
	article, aside, details, figcaption, figure, footer, header,
	hgroup, nav, section {
		color: #111; 
		font-size: 13px; 
		line-height: 18px;
		font-weight: 400;
	}
	html {width: 297; height: 210mm;}	
	a {color: blue;}
	table.event td {
		vertical-align: top;
		padding-top: 0;
		padding-bottom: 5px;
		padding-right: 10px;
	}
	div.copyright,
	div.copyright * {
		font-size: 12px;
		line-height: 15px;
		color: #bbb;
	}
	div.copyright {
		padding-top: 3px;
		border-top: 1px dotted #bbb;
		text-align: right;
	}
	div.copyright a {
		color: #aaa;
	}
</style>

<page backtop="10mm" backbottom="10mm" backleft="12mm" backright="12mm" style="font-size: 12pt">
<div class="member-card">
<?php if($model != null) {
	$i = 0;
	$documentCount = count($model);
	foreach($model as $key => $val) {
	$i++;
	if($i == 1) {?>
		<table style="width: 100%; border: 1px solid red;">
	<?php }?>	
		<tr>
			<td colspan="4" style="width: 50%;">
			logo
			</td>
			<td colspan="4" style="width: 50%;">
			logo
			</td>
		</tr>
		<tr>
			<td rowspan="2"><?php echo $val->session_seat; ?></td>
			<td rowspan="2"><span>FOTO<br/>3 x 4</span></td>
			<td colspan="6">
				<?php echo $val->user->displayname; ?><br/>
				<?php echo strtoupper($val->eventUser->test_number); ?><br/>
				<?php echo $val->eventUser->major; ?>
			</td>
		</tr>
		<tr>
			<td>1</td>
			<td>2</td>
			<td>3</td>
			<td>4</td>
			<td>5</td>
			<td>6</td>
		</tr>
	<?php if($i%2 == 0) {?>
		</table>
		<br/>
		<table style="width: 100%; border: 1px solid red;">
	<?php }
	if($i == $documentCount) {?>
		</table>
	<?php }
	}
}?>
</div>
</page>


