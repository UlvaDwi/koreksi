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
	<h3>LAPORAN NILAI MAPEL <?= $mapel ?>
		<!-- <br>Tahun Ajaran<?php echo "\n" .  $tahun_awal ?>
		<br>Kelas<?php echo "\n" . $kelas ?> -->
	</h3>
</center>

<table border="1">
	<thead>
		<tr>
			<th>No</th>
			<th>NIS</th>
			<th>Nama Siswa</th>
			<?php foreach ($jenisUjian as $valueJenisUjian) : ?>
				<th><?= $valueJenisUjian->kode_jenis ?></th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($siswa as $key => $row) { ?>
			<tr>
				<td><?= $key + 1 ?></td>
				<td><?= $row->id_siswa ?></td>
				<td><?= $row->nama_siswa ?></td>
				<?php foreach ($jenisUjian as $valueJenisUjian) : ?>
					<td><?php
						$id_ujian = $valueJenisUjian->id_ujian;
						$id_siswa = $row->id_siswa;
						$ujianSiswa = array_filter($nilaiUjianSiswa, function ($value) use ($id_ujian, $id_siswa) {
							return ($value->id_ujian == $id_ujian && $value->id_siswa == $id_siswa);
						});
						echo array_column($ujianSiswa, 'nilai')[0];
						?></td>
				<?php endforeach; ?>
			</tr>
		<?php
		}
		?>
	</tbody>
	<tfoot>
	</tfoot>
</table>