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
		font-size: 12px; 
		line-height: 16px;
		font-weight: 400;
	}
	html {width: 210mm; height: 297mm;}	
	table {width: 100%; border-collapse: collapse; border-spacing: 0;}
	table.absensi th,
	table.absensi td {
		padding: 10px 10px;
	}
	table.absensi th {
		background: #bbb;
		border: 1px solid #aaa;
		color: #fff;
		font-weight: bold;
	}
	table.absensi td {
		border: 1px solid #ccc;
	}
	table.absensi td.center {
		text-align: center;
	}
	table.absensi tr.even td {
		background: #f9f9f9;
		border: 1px solid #ccc;
	}
	div.copyright,
	div.copyright * {
		font-size: 12px;
		line-height: 15px;
		color: #bbb;
	}
	div.copyright {
		margin-top: 20px;
		padding-top: 3px;
		border-top: 1px dotted #bbb;
		text-align: right;
	}
	div.copyright a {
		color: #aaa;
	}
</style>

<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm" style="font-size: 12pt">
<div class="member-card">
	<table style="width: 100%;">
		<tr>
			<td colspan="3" style="width: 100%; vertical-align: top; padding-bottom: 20px; text-align: center; font-size: 20px; line-height: 20px; font-weight: bold;">
				<?php echo strtoupper($model[0]->session->recruitment->event_name); ?>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; width: 30%;">Jenis Tes</td>
			<td style="vertical-align: top; padding: 0 10px 0 0;">:</td>
			<td style="vertical-align: top; width: 70%;"><?php echo $model[0]->session->viewBatch->session_name;?></td>
		</tr>
		<tr>
			<td style="vertical-align: top; width: 30%;">Batch</td>
			<td style="vertical-align: top; padding: 0 10px 0 0;">:</td>
			<td style="vertical-align: top; width: 70%;"><?php echo $model[0]->session->session_name;?></td>
		</tr>
		<tr>
			<td style="vertical-align: top; width: 30%;">Waktu</td>
			<td style="vertical-align: top; padding: 0 10px 0 0;">:</td>
			<td style="vertical-align: top; width: 70%;"><?php echo Utility::dateFormat($model[0]->session->session_date).', '.date("H:i", strtotime($model[0]->session->session_time_start))." - ".date("H:i", strtotime($model[0]->session->session_time_finish)).' WIB';?></td>
		</tr>
		<tr>
			<td style="vertical-align: top; width: 30%;">Jumlah Peserta Hadir</td>
			<td style="vertical-align: top; padding: 0 10px 0 0;">:</td>
			<td style="vertical-align: top; width: 70%;"><?php echo $model[0]->session->viewBatch->user_scan;?></td>
		</tr>
		<tr>
			<td style="vertical-align: top; width: 30%;">Jumlah Peserta Tidak Hadir</td>
			<td style="vertical-align: top; padding: 0 10px 0 0;">:</td>
			<td style="vertical-align: top; width: 70%;"><?php echo $model[0]->session->viewBatch->user_notscan;?></td>
		</tr>
	</table>

	<?php if($model != null) {?>
	<table class="absensi" style="width: 100%; margin-top: 20px;">
		<tr>
			<th><strong><?php echo strtoupper('No. Meja'); ?></strong></th>
			<th><strong><?php echo strtoupper('No. Peserta'); ?></strong></th>
			<th><strong><?php echo strtoupper('Nama'); ?></strong></th>
			<th><strong><?php echo strtoupper('Bidang'); ?></strong></th>
			<th><strong><?php echo strtoupper('Keterangan'); ?></strong></th>
		</tr>
		<?php 
		$i=0;
		foreach($model as $key => $val) {
		$i++; ?>
		<tr <?php echo $i%2 == 0 ? 'class="even"' : '';?>>
			<td class="center"><?php echo strtoupper($val->session_seat); ?></td>
			<td><?php echo strtoupper($val->eventUser->test_number); ?></td>
			<td style="width: 230px;"><?php echo strtoupper($val->user->displayname); ?></td>
			<td><?php echo strtoupper($val->user->major); ?></td>
			<td><?php echo !in_array($val->scanner_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? 'Hadir' : 'Tidak Hadir'; ?></td>
		</tr>
		<?php }?>
	</table>
	<?php }?>	
		
	<div class="copyright">
		Generate by <a href="http://company.ommu.co" title="Ommu Platform">Ommu Platform</a>
	</div>	
</div>
</page>


