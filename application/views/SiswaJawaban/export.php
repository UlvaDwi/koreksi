<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Hasil Belajar $mapel.xls");
?>
<style type="text/css">
	body {
		font-family: sans-serif;
	}

	table {
		margin: 20px auto;
		border-collapse: collapse;
	}

	table th,
	table td {
		border: 1px solid #3c3c3c;
		padding: 3px 8px;

	}

	a {
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
</style>
<center>
	<h3>LAPORAN <?= $ujian->kode_jenis ?></h3>
	<h3><?= $mapel ?></h3>
	<h3>Tanggal Pelaksanaan: <?= $ujian->tgl_pelaksanaan ?></h3>
</center>

<table border="1">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Siswa</th>
			<th>Total Nilai</th>
			<?php
			$no = 1;
			foreach ($soal as $item) { ?>
				<th><?= "Q" . $no++ ?></th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		foreach ($siswa as $row) { ?>
			<tr>
				<td><?= $no ?></td>
				<td><?= $row->nama_siswa ?></td>
				<td><?= $row->nilai ?></td>
				<?php foreach ($row->jawabanSiswa as $dataJawaban) : ?>
					<td><?= $dataJawaban->skor_siswa ?></td>
				<?php endforeach; ?>
			</tr>
		<?php
			$no++;
		}
		?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
