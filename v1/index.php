<?php 
	// ============== Parho Likho Computer Science ///
///www.youtube.com/ParholikhoCS
///www.Facebook.com/ParholikhoCS
///www.twitter.com/ParholikhoCS
//----------------------------------------------------


	require_once '../includes/DbOperation.php';
	
	$response = array(); 

	//// http://----Ur IP Address ---/heroapi/HeroApi/v1/?op=addheroes
	
	if(isset($_GET['op'])){
		
		switch($_GET['op']){
			

				/// Check URL and testing API
				/// http://=======Enter your IP Address------ /heroapi/HeroApi/v1/?op=addheroes
				/// Require POST
			case 'addheroes':
				if(isset($_POST['username']) && isset($_POST['email'])){
					$db = new DbOperation(); 
					if($db->createHeroes($_POST['username'], $_POST['email'])){
						$response['error'] = false;
						$response['message'] = 'Artist added successfully';
					}else{
						$response['error'] = true;
						$response['message'] = 'Could not add artist';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}
			break; 
			
			////http://----Enter your IP Address -----/heroapi/HeroApi/v1/?op=getheroes
			////Require GET
			case 'getheroes':
				$db = new DbOperation();
				$hero = $db->getHeroes();
				if(count($hero)<=0){
					$response['error'] = true; 
					$response['message'] = 'Nothing found in the database';
				}else{
					$response['error'] = false; 
					$response['hero'] = $hero;
				}
			break; 

		


			case 'ambiluser':
				if(isset($_POST['email'])){
				$db = new DbOperation();
				$hero = $db->lihatuser($_POST['email']);
				if(count($hero)<=0){
					$response['error'] = true; 
					$response['message'] = 'Nothing found in the database';
				}else{
					$response['error'] = false; 
					$response['hero'] = $hero;
				}
			}else{
				$response['error'] = true; 
				$response['message'] = 'Required Parameters are missing';
			}


			break;

			case 'hitung_saw':
				if(isset($_POST['jk']) && isset($_POST['umur'])){
					$db = new DbOperation(); 
					$hero = $db->ambil_saw($_POST['jk'], $_POST['umur']);
					if(count($hero)<=0){
						$response['error'] = true; 
						$response['message'] = 'Nothing found in the database';
					}else{
						$response['error'] = false; 
						$response['hero'] = $hero;
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}
			break;

			case 'anak':
				if(isset($_POST['id_ortu']) && isset($_POST['nama']) && isset($_POST['tLahir']) && isset($_POST['tgllahir']) && isset($_POST['jk']) ){
					$db = new DbOperation(); 
					if($db->buat_anak($_POST['id_ortu'], $_POST['nama'],$_POST['tLahir'], $_POST['tgllahir'],$_POST['jk'])){
						$response['error'] = false;
						$response['message'] = 'Artist added successfully';
					}else{
						$response['error'] = true;
						$response['message'] = 'Could not add artist';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}
			break;

			case 'getanak':
				if(isset($_POST['id_ortu'])){
					$db = new DbOperation();
					$hero = $db->semua_anak($_POST['id_ortu']);
					if(count($hero)<=0){
						$response['error'] = true; 
						$response['message'] = 'Nothing found in the database';
					}else{
						$response['error'] = false; 
						$response['hero'] = $hero;
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}
			break; 

			case 'hapusanak':
				if(isset($_POST['id_anak'])){
					$db = new DbOperation(); 
					if($db->hapus_anak($_POST['id_anak'])){
						$response['error'] = false;
						$response['message'] = 'data berhasil dihapus';
					}else{
						$response['error'] = true;
						$response['message'] = 'Could not add artist';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}
			break; 

			case 'editanak':
				if(isset($_POST['id_anak']) && isset($_POST['nama']) && isset($_POST['tLahir']) && isset($_POST['tgllahir']) && isset($_POST['jk'])){
					$db = new DbOperation(); 
					if($db->edit_anak($_POST['id_anak'], $_POST['nama'],$_POST['tLahir'], $_POST['tgllahir'],$_POST['jk'])){
						$response['error'] = false;
						$response['message'] = 'data berhasil diubah';
					}else{
						$response['error'] = true;
						$response['message'] = 'Could not add artist';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}
			break; 

			case 'hasilhitung':
				if(isset($_POST['id_anak']) && isset($_POST['tgl_ukur']) && isset($_POST['bulan']) && isset($_POST['hasil_bb']) && isset($_POST['hasil_pb']) && isset($_POST['hasil_final'])){
					$db = new DbOperation(); 
					if($db->input_hasil($_POST['id_anak'], $_POST['tgl_ukur'],$_POST['bulan'], $_POST['hasil_bb'],$_POST['hasil_pb'],$_POST['hasil_final'])){
						$response['error'] = false;
						$response['message'] = 'pengukuran added successfully';
					}else{
						$response['error'] = true;
						$response['message'] = 'Could not add artist';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}
			break;

			case 'edithasil':
				// $id_anak, $tgl_ukur,$bulan, $hasil_bb, $hasil_pb, $hasil_final, $id
				if(isset($_POST['id_anak']) && isset($_POST['tgl_ukur']) && isset($_POST['bulan']) && isset($_POST['hasil_bb']) && isset($_POST['hasil_pb']) && isset($_POST['hasil_final']) && isset($_POST['id'])){
					$db = new DbOperation(); 					
					if($db->edit_hasil($_POST['id_anak'], $_POST['tgl_ukur'],$_POST['bulan'], $_POST['hasil_bb'],$_POST['hasil_pb'],$_POST['hasil_final'],$_POST['id'])){
						$response['error'] = false;
						$response['message'] = 'fwwefwfwefwef added successfully';
					}else{
						$response['error'] = true;
						$response['message'] = 'Could not add artist';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}
			break;

			case 'riwayat':
				if(isset($_POST['id_anak'])){
				$db = new DbOperation();
				$hero = $db->lihat_riwayat($_POST['id_anak']);
				if(count($hero)<=0){
					$response['error'] = true; 
					$response['message'] = 'Nothing found in the database';
				}else{
					$response['error'] = false; 
					$response['hero'] = $hero;
				}
			}else{
				$response['error'] = true; 
				$response['message'] = 'Required Parameters are missing';
			}
			break;

			case 'cekhasil':
			
					if(isset($_POST['id_anak']) && isset($_POST['bulan'])){
					$db = new DbOperation();
					$hero = $db->cek_hasil($_POST['id_anak'],$_POST['bulan']);
					if(count($hero)<=0){
						$response['error'] = true; 
						$response['message'] = 'Nothing found in the database';
					}else{
						$response['error'] = false; 
						$response['hero'] = $hero;
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}

			break;


			
			default:
				$response['error'] = true;
				$response['message'] = 'No operation to perform';
			
		}

		
	}else{
		$response['error'] = false; 
		$response['message'] = 'Invalid Request';
	}
	
	echo json_encode($response);


	