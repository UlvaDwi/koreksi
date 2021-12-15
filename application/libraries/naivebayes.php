<?php
class Naivebayes
{
	public $hasilAkhir = [];

	function hitung($ujian)
	{
		foreach ($ujian as $dataUjian) {
			// echo "<pre>";
			// print_r($dataUjian);
			$skorPerKata = round($dataUjian->skor_soal / $dataUjian->jumlah_kata, 2);
			// echo $skorPerKata;
			// echo '<br>';
			// echo "</pre>";
			foreach ($dataUjian->jawabansiswa as $jawabanSiswa) {
				$this->step1($dataUjian->preprocessing, $jawabanSiswa, $skorPerKata);
			}
		}
		return $this->hasilAkhir;
	}

	function step1($jawabanGuru, $jawabanSiswa, $skorPerKata)
	{
		// echo "===================================================================<br>";
		// echo "<pre>";
		// echo "Pre Processing";
		// echo "<br>";
		// print_r($jawabanGuru);
		// echo "<br>";
		// echo "</pre>";
		// echo "<pre>";
		// echo "Jawaban Siswa";
		// echo "<br>";
		// print_r($jawabanSiswa);
		// echo "<br>";
		// echo "</pre>";
		// echo "<pre>";
		// echo "skor per kata";
		// echo "<br>";
		// print_r($skorPerKata);
		// echo "<br>";
		// echo "</pre>";
		// echo "===================================================================<br>";
		$total = [];
		$databobot = [];
		$totalKataGuru = 0;
		$totalKataSiswa = 0;
		$total = 0;
		// echo "<table class='table table-bordered table-striped'>";
		// echo "<tr>";
		// echo "<th>kata</th>";
		// echo "<th>jumlah kata guru</th>";
		// echo "<th>jumlah kata siswa</th>";
		// echo "<th>total</th>";
		// echo "</tr>";
		foreach ($jawabanGuru as $dataJawabanGuru) {
			// cari data
			$key = array_search($dataJawabanGuru->kata, array_column($jawabanSiswa->preprocessing, 'kata'));
			// is false
			$jumlahKata = (is_bool($key)) ? 0 :   $jawabanSiswa->preprocessing[$key]->jumlah;
			// jika jumlah kata lebih dari milik guru 
			if ($dataJawabanGuru->jumlah < $jumlahKata) {
				// maka jumlah kata siswa disamakan dengan guru
				$jumlahKata = $dataJawabanGuru->jumlah;
			}
			$jumlah = $dataJawabanGuru->jumlah + $jumlahKata;

			$totalKataGuru += $dataJawabanGuru->jumlah;
			$totalKataSiswa += $jumlahKata;
			$total += $jumlah;

			$databobot[$dataJawabanGuru->kata] = [
				'guru' => $dataJawabanGuru->jumlah,
				'siswa' => $jumlahKata,
				'jumlah' => $jumlah
			];
			// echo "<tr>";
			// echo "<td>{$dataJawabanGuru->kata}</td>";
			// echo "<td>{$dataJawabanGuru->jumlah}</td>";
			// echo "<td>{$jumlahKata}</td>";
			// echo "<td>" . ($jumlahKata + $dataJawabanGuru->jumlah) . "</td>";
			// echo "</tr>";
		}
		$total = [
			'totalKataSiswa' => $totalKataSiswa,
			'totalKataGuru' => $totalKataGuru,
			'total' => $total
		];
		// echo "<tr>";
		// echo "<td>total </td>";
		// echo "<td>{$total['totalKataGuru']}</td>";
		// echo "<td>{$total['totalKataSiswa']}</td>";
		// echo "<td>" . ($total['totalKataGuru'] + $total['totalKataSiswa']) . "</td>";
		// echo "</tr>";
		// echo "<table>";

		$hasilDesimal = [];
		foreach ($databobot as $key => $item) {
			$hasilDesimal[$key] = [
				'guru' => round($item['guru'] / $total['totalKataGuru'], 2),
				'siswa' => round($item['siswa'] / $total['totalKataSiswa'], 2),
				'jumlah' => round($item['jumlah'] / $total['total'], 2)
			];
		}

		$totalHasilDesimal = [
			'totalSiswa' => round($total['totalKataSiswa'] / $total['total'], 2),
			'totalGuru' => round($total['totalKataGuru'] / $total['total'], 2),
		];

		$probabilitas = [];

		foreach ($hasilDesimal as $key => $value) {
			$hasilProbabilitasSiswa = round($value['siswa'] * $totalHasilDesimal['totalSiswa'] / $value['jumlah'], 2);
			$hasilProbabilitasGuru = round($value['guru'] * $totalHasilDesimal['totalGuru'] / $value['jumlah'], 2);
			$probabilitas[$key] = [
				'probabilitasGuru' => $hasilProbabilitasGuru,
				'probabilitasSiswa' => $hasilProbabilitasSiswa,
				'hasil_akhir' => round(($skorPerKata / $hasilProbabilitasGuru) * $hasilProbabilitasSiswa, 2)
			];
		}


		// echo "<table class='table table-bordered table-striped'>";
		// echo "<tr>";
		// echo "<th>kata</th>";
		// echo "<th>P(X|CI) kata guru</th>";
		// echo "<th>P(X|CI) kata siswa</th>";
		// echo "<th>P(X)</th>";
		// echo "</tr>";

		// foreach ($hasilDesimal as $key => $value) {
		// 	echo "<tr>";
		// 	echo "<td>$key</td>";
		// 	echo "<td>" . $value['guru'] . "</td>";
		// 	echo "<td>" . $value['siswa'] . "</td>";
		// 	echo "<td>" . $value['jumlah'] . "</td>";
		// 	echo "</tr>";
		// }
		// echo "<tr>";
		// echo "<td>P(C)</td>";
		// echo "<td>" . $totalHasilDesimal['totalGuru'] . "</td>";
		// echo "<td>" . $totalHasilDesimal['totalSiswa'] . "</td>";
		// echo "<td></td>";
		// echo "</tr>";
		// echo "</table>";

		$hasil = array_sum(array_column($probabilitas, 'hasil_akhir'));
		$this->hasilAkhir[] = [
			'id_jawaban_siswa' => $jawabanSiswa->id_jawaban_siswa,
			'hasil_akhir' => $hasil
		];


		// echo "<table class='table table-bordered table-striped'>";
		// echo "<tr>";
		// echo "<th>kata</th>";
		// echo "<th>Probabilitas guru</th>";
		// echo "<th>Probabilitas siswa</th>";
		// echo "<th>Nilai Kata</th>";
		// echo "</tr>";

		// foreach ($probabilitas as $key => $value) {
		// 	echo "<tr>";
		// 	echo "<td>$key</td>";
		// 	echo "<td>" . $value['probabilitasGuru'] . "</td>";
		// 	echo "<td>" . $value['probabilitasSiswa'] . "</td>";
		// 	echo "<td>" . $value['hasil_akhir'] . "</td>";
		// 	echo "</tr>";
		// }
		// echo "<tr>";
		// echo "<td>Nilai Siswa </td>";
		// echo "<td colspan='4' class='text-right'>" . $hasil . "</td>";
		// echo "</tr>";
		// echo "</table>";
		// return $this->hasilAkhir;
	}

	function tampilPerhitungan($jawabanGuru, $jawabanSiswa, $skorPerKata)
	{
		// echo "===================================================================<br>";
		// echo "<pre>";
		// echo "Pre Processing";
		// echo "<br>";
		// print_r($jawabanGuru);
		// echo "<br>";
		// echo "</pre>";
		// echo "<pre>";
		// echo "Jawaban Siswa";
		// echo "<br>";
		// print_r($jawabanSiswa);
		// echo "<br>";
		// echo "</pre>";
		// echo "<pre>";
		// echo "skor per kata";
		// echo "<br>";
		// print_r($skorPerKata);
		// echo "<br>";
		// echo "</pre>";
		// echo "===================================================================<br>";
		$total = [];
		$databobot = [];
		$totalKataGuru = 0;
		$totalKataSiswa = 0;
		$total = 0;
		echo "<table class='table table-bordered table-striped'>";
		echo "<tr>";
		echo "<th>kata</th>";
		echo "<th>jumlah kata guru</th>";
		echo "<th>jumlah kata siswa</th>";
		echo "<th>total</th>";
		echo "</tr>";
		foreach ($jawabanGuru as $dataJawabanGuru) {
			// cari data
			$key = array_search($dataJawabanGuru->kata, array_column($jawabanSiswa->preprocessing, 'kata'));
			// is false
			$jumlahKata = (is_bool($key)) ? 0 :   $jawabanSiswa->preprocessing[$key]->jumlah;
			// jika jumlah kata lebih dari milik guru 
			if ($dataJawabanGuru->jumlah < $jumlahKata) {
				// maka jumlah kata siswa disamakan dengan guru
				$jumlahKata = $dataJawabanGuru->jumlah;
			}
			$jumlah = $dataJawabanGuru->jumlah + $jumlahKata;

			$totalKataGuru += $dataJawabanGuru->jumlah;
			$totalKataSiswa += $jumlahKata;
			$total += $jumlah;

			$databobot[$dataJawabanGuru->kata] = [
				'guru' => $dataJawabanGuru->jumlah,
				'siswa' => $jumlahKata,
				'jumlah' => $jumlah
			];
			echo "<tr>";
			echo "<td>{$dataJawabanGuru->kata}</td>";
			echo "<td>{$dataJawabanGuru->jumlah}</td>";
			echo "<td>{$jumlahKata}</td>";
			echo "<td>" . ($jumlahKata + $dataJawabanGuru->jumlah) . "</td>";
			echo "</tr>";
		}
		$total = [
			'totalKataSiswa' => $totalKataSiswa,
			'totalKataGuru' => $totalKataGuru,
			'total' => $total
		];
		echo "<tr>";
		echo "<td>total </td>";
		echo "<td>{$total['totalKataGuru']}</td>";
		echo "<td>{$total['totalKataSiswa']}</td>";
		echo "<td>" . ($total['totalKataGuru'] + $total['totalKataSiswa']) . "</td>";
		echo "</tr>";
		// echo "<tr>";
		// echo "<td>total keseluruhan </td>";
		// echo "<td colspan='2' class='text-right'>" . ($total['totalKataGuru'] + $total['totalKataSiswa']) . "</td>";
		// echo "</tr>";
		echo "<table>";

		// echo "<pre>";
		// echo "total";
		// echo "<br>";
		// print_r($databobot);
		// echo "<br>";
		// echo "jawaban siswa";
		// echo "<br>";
		// print_r($total);
		// echo "</pre>";

		// 
		$hasilDesimal = [];
		foreach ($databobot as $key => $item) {
			$hasilDesimal[$key] = [
				'guru' => round($item['guru'] / $total['totalKataGuru'], 2),
				'siswa' => round($item['siswa'] / $total['totalKataSiswa'], 2),
				'jumlah' => round($item['jumlah'] / $total['total'], 2)
			];
		}

		$totalHasilDesimal = [
			'totalSiswa' => round($total['totalKataSiswa'] / $total['total'], 2),
			'totalGuru' => round($total['totalKataGuru'] / $total['total'], 2),
		];

		$probabilitas = [];

		foreach ($hasilDesimal as $key => $value) {
			$hasilProbabilitasSiswa = round($value['siswa'] * $totalHasilDesimal['totalSiswa'] / $value['jumlah'], 2);
			$hasilProbabilitasGuru = round($value['guru'] * $totalHasilDesimal['totalGuru'] / $value['jumlah'], 2);
			$probabilitas[$key] = [
				'probabilitasGuru' => $hasilProbabilitasGuru,
				'probabilitasSiswa' => $hasilProbabilitasSiswa,
				'hasil_akhir' => round(($skorPerKata / $hasilProbabilitasGuru) * $hasilProbabilitasSiswa, 2)
			];
		}


		echo "<table class='table table-bordered table-striped'>";
		echo "<tr>";
		echo "<th>kata</th>";
		echo "<th>P(X|CI) kata guru</th>";
		echo "<th>P(X|CI) kata siswa</th>";
		echo "<th>P(X)</th>";
		echo "</tr>";

		foreach ($hasilDesimal as $key => $value) {
			echo "<tr>";
			echo "<td>$key</td>";
			echo "<td>" . $value['guru'] . "</td>";
			echo "<td>" . $value['siswa'] . "</td>";
			echo "<td>" . $value['jumlah'] . "</td>";
			echo "</tr>";
		}
		echo "<tr>";
		echo "<td>P(C)</td>";
		echo "<td>" . $totalHasilDesimal['totalGuru'] . "</td>";
		echo "<td>" . $totalHasilDesimal['totalSiswa'] . "</td>";
		echo "<td></td>";
		echo "</tr>";
		echo "</table>";

		$hasil = array_sum(array_column($probabilitas, 'hasil_akhir'));
		$this->hasilAkhir[] = [
			'id_jawaban_siswa' => $jawabanSiswa->id_jawaban_siswa,
			'hasil_akhir' => $hasil
		];


		echo "<table class='table table-bordered table-striped'>";
		echo "<tr>";
		echo "<th>kata</th>";
		echo "<th>Probabilitas guru</th>";
		echo "<th>Probabilitas siswa</th>";
		echo "<th>Nilai Kata</th>";
		echo "</tr>";

		foreach ($probabilitas as $key => $value) {
			echo "<tr>";
			echo "<td>$key</td>";
			echo "<td>" . $value['probabilitasGuru'] . "</td>";
			echo "<td>" . $value['probabilitasSiswa'] . "</td>";
			echo "<td>" . $value['hasil_akhir'] . "</td>";
			echo "</tr>";
		}
		echo "<tr>";
		echo "<td>Nilai Siswa </td>";
		echo "<td colspan='4' class='text-right'>" . $hasil . "</td>";
		echo "</tr>";
		echo "</table>";
	}
}
