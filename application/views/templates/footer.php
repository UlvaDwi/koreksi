<!-- Main Footer -->
<footer class="main-footer">
	<strong>Copyright &copy; 2021 <a href="http://adminlte.io">SMK Muhammadiyah 2 Pagak</a>.</strong>
	All rights reserved.
	<div class="float-right d-none d-sm-inline-block">
		<b>Version</b> 1.0.0
	</div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?= base_url() ?>assets/dist/js/demo.js"></script>

<!-- ChartJS -->
<script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="<?= base_url() ?>assets/dist/js/pages/dashboard2.js"></script>
<!-- page script Table -->
<!-- Select2 -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
	$(function() {
		$('#example1').DataTable();
		$('.select2').select2()
		$('.select2bs4').select2({
			theme: 'bootstrap4'
		})
	});

	<?php if ($this->uri->segment(1) == "DataKelas") : ?>
		$('#listSiswa').on('show.bs.modal', function(event) {
			$.ajax({
				url: "<?= base_url('DataSiswa/listSiswaNaikKelas') ?>",
				type: "post",
				data: {
					kelas: "<?= $kelas['kelas'] ?>",
					jurusan: "<?= $kelas['kode_jurusan'] ?>"
				},
				dataType: 'json',
				success: function(result) {
					if (result.status == 'failed') {
						$('#listSiswa').modal('hide')
						alert(result.status + " data siswa kosong");
					} else {
						$('#FormlistSiswa').html(result.data).show();
						$('#btnSaveSiswa').removeAttr('disabled');
					}
				}
			});
		})

		function selectRow(row) {
			var firstInput = row.getElementsByTagName('input')[0];
			firstInput.checked = !firstInput.checked;
		}

	<?php endif; ?>

	<?php if ($this->uri->segment(1) == "DataPenugasanGuru") : ?>
		var numberForm = 2;
		$("#mapelSelectForm").on('change', function() {
			var selectedVal = $(this).val();
			var dataSelect = $(this).data("mapelselect");
			$.ajax({
				type: "POST",
				url: "<?= base_url('DataPenugasanGuru/getDataKelasByKodeMapel') ?>",
				data: {
					'kode_mapel': selectedVal
				},
				success: function(data) {
					dataKelas = JSON.parse(data);
					console.log(dataKelas);
				}
			})
			console.log('inidata' + dataSelect);
		});
		// Modal 
		$('#TugasGuru').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget);
			var mapel = button.data('mapel');
			var kode_mapel = button.data('kodemapel');
			var modal = $(this);
			$.ajax({
				type: 'POST',
				url: "<?= base_url('DataPenugasanGuru/getDataKelas') ?>",
				data: {
					'kode_mapel': kode_mapel
				},
				success: function(data) {
					modal.find('.modal-title').text('Mata Pelajaran ' + mapel);
					modal.find('.modal-body input').val(mapel);
					modal.find('#form').html(data);
					// html = JSON.parse(data);
					// console.log(html);
				}
			})
		})

		// add form
		var maxField = 10; //Input fields increment limitation
		var wrapper = $('.field_wrapper'); //Input field wrapper
		var fieldHTML = $('.input_penugasan'); //New input field html 
		var link = '<a href="#" class="remove_field">Remove</a>';
		var x = 1; //Initial field counter is 1
		$('.add_button').click(function() { //Once add button is clicked
			if (x < maxField) { //Check maximum number of input fields
				x++; //Increment field counter
				$(wrapper).append(fieldHTML.clone(), link); // Add field html
			}
		});
		$(wrapper).on('click', '.remove_field', function(e) { //Once remove button is clicked
			e.preventDefault();
			$(this).prev().remove();
			x--;
			$(this).remove(".remove_field");

			// $(this).parent('div').remove(); //Remove field html
			// x--; //Decrement field counter
		});


		$('div.hapus-data').on('click', function() {
			const form = $(this);
			let id_tugas = form.data('idtugas');
			let form_group = form.parent().parent().parent();
			$.ajax({
				url: "<?= base_url('DataPenugasanGuru/hapus') ?>",
				type: "POST",
				data: {
					'id_tugas': id_tugas
				},
				success: function(data) {
					form_group.find(".form-mapel").removeAttr("disabled");
					form_group.find(".form-kelas").removeAttr("disabled");
					form_group.find(".form-beban-jam").removeAttr("disabled");
					form_group.find(".select-guru").removeAttr("disabled");
					form.remove();
				}
			})
		});
	<?php endif; ?>


	//notif hapus data relasi
	$('.hapus').click(function() {
		let id = $(this).data('id');
		let ref = $(this).data('ref');

		function hapus_data(id, ref) {
			$.ajax({
				data: {
					'id': id,
				},
				method: "POST",
				url: ref,
				dataType: 'JSON',
				success: function(res) {}
			});
		}


		Swal.fire({
			title: 'Apakah anda yakin menghapus data ini?',
			// text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Delete!'
		}).then((result) => {
			if (result.isConfirmed) {
				// ajax
				$.ajax({
					data: {
						'id': id
					},
					method: "POST",
					url: "<?= base_url($this->uri->segment(1) . '/checkForeign') ?>",
					dataType: 'JSON',
					success: function(res) {
						if (JSON.parse(res)) {
							Swal.fire('Hapus Gagal, Terdapat Data Terkait')
						} else {
							hapus_data(id, ref);
							Swal.fire(
								'Deleted!',
								'Your file has been deleted.',
								'success'
							).then(function() {

								location.reload();
							});
						}
					}
				});
			}
		})


	});
</script>


</body>

</html>
