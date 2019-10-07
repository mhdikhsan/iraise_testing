<table>
												
		<tr>
		<th>No</th>
		<th>Kode MK</th>
		<th>Nama Mata Kuliah-Kelas</th>
		<th>SKS</th>
		<th>Nama Dosen</th>
		<th>Hari</th>
		<th>Ruang</th>
		<th>Jam</th>
		<th>Kurikulum</th>
		</tr>
											
		<?php
			$no=1;
			foreach($jadwal as $db)
			{
				echo '
				<tr ">
					<td>'.$no.'</td>
					<td>'.$db['kode_mk'].'</td>
					<td>'.$db['nm_mk'].' - '.$db['nm_kls'].'</td>
					<td>'.$db['sks_mk'].'</td>
					<td>'.$db['nm_ptk'].'</td>
					<td>'.$db['hari'].'</td>
					<td>'.$db['kode_ruangan'].'</td>
					<td>'.$db['jam_mulai'].' - '.$db['jam_selesai'].'</td>
					<td>'.$db['kurikulum'].'</td>';
					$no++;
			}
		?>
</table>