<?php
	class Mvalidasi extends CI_Model
	{
		function validasiakun()
		{
			$role=$this->session->userdata('role');
			if($role=="")
			{
				echo "<script>alert('Maaf anda tidak dapat akses halaman ini');</script>";	
				redirect('auth','refresh');
			}	
		}	
	}
?> 