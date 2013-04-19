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

		//SAVE NEW ADVISER]
		function save_new_adv($arrImplode1,$arrImplode2,$teacherId,$teacherType,$profilePic){
			$this->openCon();
			$exist = true;
			$sqlCheck = "SELECT teacher_id FROM t_teachers WHERE teacher_id = ?";
			$stmt1 = $this->dbCon->prepare($sqlCheck);
			$stmt1->bindParam(1,$teacherId);
			$stmt1->execute();
			$row = $stmt1->fetch();
				if($row[0] == "" || $row[0] = null){
					$exist = 0;
				}
			
			if(!$exist){
				echo "INSERT INTO t_teachers (teacher_id,firstname,middlename,lastname,address,email,mobile,age,gender,bdate,rank,teacher_type,profile_pic)
				 VALUES ('$arrImplode1','$teacherType','$profilePic')";
				$sql1 = "INSERT INTO t_teachers (teacher_id,firstname,middlename,lastname,address,email,mobile,age,gender,bdate,rank,teacher_type,profile_pic)
				 VALUES (?,?,?)";
				 $stmt2 = $this->dbCon->prepare($sql1);
				 $stmt2->bindParam(1,$arrImplode1);
				 $stmt2->bindParam(2,$teacherType);
				 $stmt2->bindParam(3,$profilePic);
				 //echo  $sql1;
				 $stmt2->execute();
				

			}
			
			//close connection
			$this->closeCon();
		}
	}
?>