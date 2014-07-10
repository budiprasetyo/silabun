	<table id="body-head">
	<tbody>
		<tr>
			<td width="13%" align="left">Nomor</td>
			<td width="2%" align="left">:</td>
			<td width="15%" align="left"><?php echo $data_surat['no_surat_teguran']; ?></td>
			<td align="right">Tanggal <?php echo $now; ?></td>
		</tr>
		<tr>
			<td width="13%" align="left">Sifat</td>
			<td width="2%" align="left">:</td>
			<td colspan="2" align="left">Penting</td>
		</tr>
		<tr>
			<td width="13%" align="left">Lampiran</td>
			<td width="2%" align="left">:</td>
			<td colspan="2" align="left"><?php echo $data_surat['jml_lampiran']; ?> lembar</td>
		</tr>
		<tr>
			<td width="13%" align="left">Hal</td>
			<td width="2%" align="left">:</td>
			<td colspan="2" align="left">Teguran Kepatuhan Penyetoran</td>
		</tr>
	</tbody>
	</table>
	<address class="return-address">
		Yth. Bendahara Penerimaan/Pengeluaran<br />
		Kantor/Satker <?php echo ucwords(strtolower($satker->nm_satker)); ?><br />
		di
	</address>
	<div class="content">
		<p>
			Berdasarkan Laporan Pertanggungjawaban Saudara Nomor <?php echo $data_surat['no_lpj']; ?> tanggal <?php echo date_convert($data_surat['tgl_lpj']); ?> yang telah kami verifikasi tanggal <?php echo date_convert($data_surat['tgl_verifikasi']); ?> dengan nomor <?php echo $data_surat['no_verifikasi']; ?> diketahui bahwa saldo akhir penerimaan negara/pajak bulan yang lalu belum Saudara setorkan ke kas negara seluruhnya.
		</p>
		<p>
			Sehubungan dengan hal tersebut di atas kami mengingatkan Saudara untuk segera menyetorkan seluruh penerimaan/pajak sesuai peraturan yang berlaku.
		</p>
		<p>
			Demikian kami sampaikan.
		</p>
	</div>
	<div id="footer">
		<div id="signature">
			Kepala Kantor,
		</div>
		<div id="name">
			<?php echo $data_surat['nm_pejabat']; ?><br />
			NIP <?php echo $data_surat['nip_pejabat']; ?>
		</div> 
		<div id="copy-letter">
			Tembusan Yth.<br />
			Kuasa Pengguna Anggaran/Pejabat Pemungut Penerimaan Negara Kantor/Satker <?php echo ucwords(strtolower($satker->nm_satker)); ?>
		</div>
	</div>
</body>
</html>
