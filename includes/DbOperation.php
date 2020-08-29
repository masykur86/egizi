<?php

// ============== Parho Likho Computer Science ///
///www.youtube.com/ParholikhoCS
///www.Facebook.com/ParholikhoCS
///www.twitter.com/ParholikhoCS
//----------------------------------------------------

 
class DbOperation
{
    private $con;
 
    function __construct()
    {
        require_once dirname(__FILE__) . '/DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
    }

	public function createHeroes($username, $email){
		$stmt = $this->con->prepare("INSERT INTO `user` (`id`, `username`, `email`)  VALUES (NULL, ?, ?);");
		$stmt->bind_param("ss", $username, $email);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
	public function getHeroes(){
		$stmt = $this->con->prepare("SELECT * FROM user");
		$stmt->execute();
		$stmt->bind_result($id, $username, $email,$pass);
		$artists = array();
		
		while($stmt->fetch()){
			$temp = array(); 
			$temp['id'] = $id; 
			$temp['username'] = $username; 
			$temp['email'] = $email; 
			$temp['password'] = $pass; 
			array_push($artists, $temp);
		}
		return $artists; 
	}

	public function lihatuser($email){
		$email = $_POST['email'];
		$stmt = $this->con->prepare("SELECT * FROM user WHERE email LIKE '$email'");
	
		$stmt->execute();
		$stmt->bind_result($id, $username, $email);
		$artists = array();
		
		while($stmt->fetch()){
			$temp = array(); 
			$temp['id'] = $id; 
			$temp['username'] = $username; 
			$temp['email'] = $email; 
			array_push($artists, $temp);
		}
		return $artists; 

	}

	public function ambil_saw($jk, $umur){
		$jk = $_POST['jk'];
		$umur = $_POST['umur'];
		$stmt = $this->con->prepare("SELECT *  FROM data_saw WHERE jk LIKE '$jk' AND umur = '$umur'");	
		$stmt->execute();
		$stmt->bind_result($id, $jk, $umur,$median_bb,$median_pb);
		$artists = array();
		
		while($stmt->fetch()){
			$temp = array(); 
			$temp['id'] = $id; 
			$temp['jk'] = $jk;
			$temp['umur'] = $umur; 
			$temp['median_bb'] = $median_bb; 
			$temp['median_pb'] = $median_pb; 
		
		
			array_push($artists, $temp);
		}
		return $artists; 

	}

	public function buat_anak($id_ortu, $nama,$tLahir, $tgllahir, $jk){
		$stmt = $this->con->prepare("INSERT INTO `anak` (`id_anak`, `id_ortu`, `nama`, `tLahir`, `tgllahir`, `jk`) VALUES (NULL, ?, ?, ?, ?, ?);");
	var_dump($id_ortu, $nama,$tLahir, $tgllahir, $jk);

		$stmt->bind_param("sssss", $id_ortu, $nama,$tLahir, $tgllahir, $jk);
	
		if($stmt->execute())
			return true; 
		return false; 

	}


	public function semua_anak($id_ortu){
		$stmt = $this->con->prepare("SELECT * FROM anak WHERE id_ortu LIKE '$id_ortu'");
		$stmt->execute();
		$stmt->bind_result($id_anak,$id_ortu, $nama,$tLahir, $tgllahir, $jk);
		$artists = array();
		
		while($stmt->fetch()){
			$temp = array(); 
			$temp['id_anak'] = $id_anak; 
			$temp['id_ortu'] = $id_ortu; 
			$temp['nama'] = $nama; 
			$temp['tLahir'] = $tLahir; 
			$temp['tgllahir'] = $tgllahir; 
			$temp['jk'] = $jk; 
			array_push($artists, $temp);
		}
		return $artists; 
	}

	public function hapus_anak($id_anak){
		$stmt = $this->con->prepare("DELETE FROM `anak` WHERE `anak`.`id_anak` = ?");
		$stmt->bind_param("s", $id_anak);
		if($stmt->execute())
			return true; 
		return false; 
	}

	public function edit_anak($id_anak, $nama,$tLahir, $tgllahir, $jk){
		$stmt = $this->con->prepare("UPDATE anak SET nama = ?, tLahir = ?, tgllahir = ?, jk = ? WHERE anak.id_anak = ?");
		$stmt->bind_param("sssss", $nama, $tLahir,$tgllahir, $jk, $id_anak);
		if($stmt->execute())
			return true; 
		return false; 
	}

	public function input_hasil($id_anak, $tgl_ukur,$bulan, $hasil_bb, $hasil_pb,$hasil_final){
		$stmt = $this->con->prepare("INSERT INTO `hasil_perhitungan` (`id`, `id_anak`, `tgl_ukur`, `bulan`, `hasil_bb`, `hasil_pb`, `hasil_final`) VALUES (NULL, ?, ?, ?, ?, ?, ?);");
		$stmt->bind_param("ssssss", $id_anak, $tgl_ukur,$bulan, $hasil_bb, $hasil_pb,$hasil_final);
		if($stmt->execute())
			return true; 
		return false; 
	}


	public function edit_hasil($id_anak, $tgl_ukur,$bulan, $hasil_bb, $hasil_pb, $hasil_final, $id){
		$stmt = $this->con->prepare("UPDATE hasil_perhitungan SET id_anak = ?, tgl_ukur = ?, bulan = ?, hasil_bb = ?, hasil_pb = ?, hasil_final = ? WHERE hasil_perhitungan.id =? ");
		$stmt->bind_param("sssssss",$id_anak, $tgl_ukur,$bulan, $hasil_bb, $hasil_pb, $hasil_final, $id);
		if($stmt->execute())
			return true; 
		return false; 
	}


	public function lihat_riwayat($id_anak){
		// $email = $_POST['id_anak'];
		$stmt = $this->con->prepare("SELECT * FROM hasil_perhitungan WHERE id_anak LIKE '$id_anak' ORDER BY bulan ASC ");
		$stmt->execute();
		$stmt->bind_result( $id,$id_anak, $tgl_ukur,$bulan, $hasil_bb, $hasil_pb, $hasil_final);
		$artists = array();
		
		while($stmt->fetch()){
			$temp = array(); 
			$temp['id'] = $id;
			$temp['id_anak'] = $id_anak; 	
			$temp['tgl_ukur'] = $tgl_ukur; 
			$temp['bulan'] = $bulan; 
			$temp['hasil_bb'] = $hasil_bb; 
			$temp['hasil_pb'] = $hasil_pb; 			
			$temp['hasil_final'] = $hasil_final; 
			array_push($artists, $temp);
		}
		return $artists; 

		
	}

	public function cek_hasil($id_anak,$bulan){
		// $email = $_POST['id_anak'];
		$stmt = $this->con->prepare("SELECT * FROM hasil_perhitungan WHERE id_anak LIKE '$id_anak' and bulan LIKE '$bulan' ORDER BY bulan ASC ");
		$stmt->execute();
		$stmt->bind_result( $id,$id_anak, $tgl_ukur,$bulan, $hasil_bb, $hasil_pb, $hasil_final);
		$artists = array();
		
		while($stmt->fetch()){
			$temp = array(); 
			$temp['id'] = $id;
			$temp['id_anak'] = $id_anak; 	
			$temp['tgl_ukur'] = $tgl_ukur; 
			$temp['bulan'] = $bulan; 
			$temp['hasil_bb'] = $hasil_bb; 
			$temp['hasil_pb'] = $hasil_pb; 			
			$temp['hasil_final'] = $hasil_final; 
			array_push($artists, $temp);
		}
		return $artists; 

	}

}


// public function ubah_anak($id_anak,$nama,$tLahir, $tgllahir, $jk){
// 	$id_anak = $_POST['id_anak'];
// 	$nama = $_POST['nama'];
// 	$tLahir = $_POST['tLahir'];
// 	$jk = $_POST['jk'];
// 	$tgllahir = $_POST['tgllahir'];
// 	var_dump($id_anak,$nama,$tLahir, $tgllahir, $jk);
// 	$stmt = $this->con->prepare("UPDATE anak SET nama = '$nama', tLahir = '$tLahir', tgllahir = '$tgllahir', jk = '$jk' WHERE anak.id_anak = '$id_anak'");	
// 	var_dump($stmt);
// 	$stmt->execute();
// 	$stmt->bind_result($id_anak, $id_ortu, $nama,$tLahir, $tgllahir, $jk);
// 	$artists = array();
	
// 	while($stmt->fetch()){
// 		$temp = array(); 
// 		$temp['id_anak'] = $id_anak; 
// 		$temp['id_ortu'] = $id_ortu; 
// 		$temp['nama'] = $nama;
// 		$temp['tLahir'] = $tLahir; 
// 		$temp['tgllahir'] = $tgllahir; 
// 		$temp['jk'] = $jk; 
	
	
// 		array_push($artists, $temp);
// 	}
// 	return $artists; 

// }
