<?php
include "db_connect.php";
	class teacher extends db_connect{
		function save_new_sch_head($idNum,$fullName,$address,$email,$mobile,$age,$gender,$bDate,$rank,$profilePic){
			$this->openCon();
			$teacherType = "School Head";
			$status = "active";
			//
			$sqlUpdate = "UPDATE t_teachers SET status = 'inactive' WHERE teacher_type = '$teacherType'";
			$stmt1 = $this->dbCon->prepare($sqlUpdate);
			$stmt1->execute();
			//
			//

			$sql = "INSERT INTO t_teachers (teacher_id,fullname,address,email,mobile,age,gender,bdate,rank,teacher_type,profile_pic,status) 
			VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $this->dbCon->prepare($sql);
			$stmt->bindParam(1,$idNum);
			$stmt->bindParam(2,$fullName);
			$stmt->bindParam(3,$address);
			$stmt->bindParam(4,$email);
			$stmt->bindParam(5,$mobile);
			$stmt->bindParam(6,$age);
			$stmt->bindParam(7,$gender);
			$stmt->bindParam(8,$bDate);
			$stmt->bindParam(9,$rank);
			$stmt->bindParam(10,$teacherType);
			$stmt->bindParam(11,$profilePic);
			$stmt->bindParam(12,$status);
			$stmt->execute();
			//echo $idNum."-".$fullName."-".$address."-".$email."-".$mobile."-".$age."-".$gender."-".$bDate."-".$rank."-".$teacherType."-".$profilePic."-".$status;

			//close connection
			//echo $sql;
			$this->closeCon();
		}

		//GET YEAR AND SECTIONS TO ASSIGN FOR THE NEW ADVISER TEACHER
		function getYSAdv($status){
			$this->openCon();
			$sql = "SELECT year_sec_id, year_level, section_name, year_sec_code FROM t_year_sections WHERE avi_status = ?";
			$stmt = $this->dbCon->prepare($sql);
			$stmt -> bindParam(1, $status);
			$stmt -> execute();
			//$row = $stmt->fetch(PDO::fetch_assoc)
			$noData = true;
			while($row = $stmt->fetch()){
				echo "<tr id=tr_ys".$row[0].">";//do not change the id
				echo "<td><input type=radio name=radio_year_sec_adv id=radio_year_sec_adv".$row[0]." /></td>";
				echo "<td>".$row[1]."</td>";
				echo "<td>".$row[2]."</td>";
				echo "<td>".$row[3]."</td>";
				echo "</tr>";

				$noData = false;
			}
			if($noData){
				echo "noData";
			}

			//close connection
			$this->closeCon();
		}
	}
?>