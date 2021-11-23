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
			echo $skorPerKata;
			echo '<br>';
			// echo "</pre>";
			foreach ($dataUjian->jawabansiswa as $jawabanSiswa) {
				$this->step1($dataUjian->preprocessing, $jawabanSiswa, $skorPerKata);
			}
		}
		return $this->hasilAkhir;
	}

	function step1($jawabanGuru, $jawabanSiswa, $skorPerKata)
	{
		// echo "<pre>";
		// echo "jawaban guru";
		// echo "<br>";
		// print_r($jawabanGuru);
		// echo "<br>";
		// echo "jawaban siswa";
		// echo "<br>";
		// echo $jawabanSiswa->id_jawaban_siswa;
		// echo "</pre>";
		$total = [];
		$databobot = [];
		$totalKataGuru = 0;
		$totalKataSiswa = 0;
		$total = 0;
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
			// echo $dataJawabanGuru->kata . " : " . $dataJawabanGuru->jumlah . " | " . $jumlahKata;
			// echo "<br>";
		}
		$total = [
			'totalKataSiswa' => $totalKataSiswa,
			'totalKataGuru' => $totalKataGuru,
			'total' => $total
		];
		echo "<pre>";
		echo "total";
		echo "<br>";
		print_r($databobot);
		echo "<br>";
		echo "jawaban siswa";
		echo "<br>";
		print_r($total);
		echo "</pre>";

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
			$hasilProbabilitas = round($value['siswa'] * $totalHasilDesimal['totalSiswa'] / $value['jumlah'], 2);
			$probabilitas[$key] = [
				'probabilitas' => $hasilProbabilitas,
				'hasil_akhir' => round(($skorPerKata / 0.5) * $hasilProbabilitas, 2)
			];
		}

		echo "<pre>";
		echo "Hasil Desimal";
		echo "<br>";
		print_r($hasilDesimal);
		echo "<br>";
		echo "Total Hasil Desimal";
		echo "<br>";
		print_r($totalHasilDesimal);
		echo "<br>";
		echo "probabilitas : ";
		echo "<br>";
		print_r($probabilitas);
		echo "</pre>";

		$hasil = array_sum(array_column($probabilitas, 'hasil_akhir'));
		$this->hasilAkhir[] = [
			'id_jawaban_siswa' => $jawabanSiswa->id_jawaban_siswa,
			'hasil_akhir' => $hasil
		];
		echo "<pre>";
		print_r($this->hasilAkhir);
		echo "</pre>";
	}
}
