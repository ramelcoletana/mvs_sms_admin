<?php
include "db_connect.php";
	class teacher extends db_connect{
		
		//GENERATE ID NUMBER AUTOMATICALLY
		function genIdNum(){
				$this->openCon();
				$sql = "SELECT max(teach_auto_id) FROM t_teachers";
				$stmt = $this->dbCon->prepare($sql);
				$stmt -> execute();
				$row = $stmt->fetch();
				$max = $row[0] + 1;
				echo $max;
				$this->closeCon();
		}
		
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
		function save_new_adv($decoded1,$decoded2,$teacherType,$profilePic){
			$this->openCon();
			foreach($decoded1 as $info1){
				$$info1['name'] = $info1['value'];
			}
			$exist = true;
			$sqlCheck = "SELECT teacher_id FROM t_teachers WHERE teacher_id = ?";
			$stmt1 = $this->dbCon->prepare($sqlCheck);
			$stmt1->bindParam(1,$idNum);
			$stmt1->execute();
			$row = $stmt1->fetch();
				if($row[0] == "" || $row[0] = null){
					$exist = 0;
				}
			if(!$exist){
				$sql = "INSERT INTO t_teachers (teacher_id,fullname,address,email,mobile,age,gender,bdate,rank,teacher_type,profile_pic)
				 VALUES (?,?,?,?,?,?,?,?,?,?,?)";
				foreach($decoded1 as $info1){
					$$info1['name'] = $info1['value'];
				}
				foreach($decoded2 as $info2){
					$$info2['name'] = $info2['value'];
				}
				$fullname = $fName." ".$mName." ".$lName;
				 $stmt2 = $this->dbCon->prepare($sql);
				 $stmt2->bindParam(1,$idNum);
				 $stmt2->bindParam(2,$fullname);
				 $stmt2->bindParam(3,$address);
				 $stmt2->bindParam(4,$email);
				 $stmt2->bindParam(5,$mobile);
				 $stmt2->bindParam(6,$age);
				 $stmt2->bindParam(7,$gender);
				 $stmt2->bindParam(8,$bDate);
				 $stmt2->bindParam(9,$rank);
				 $stmt2->bindParam(10,$teacherType);
				 $stmt2->bindParam(11,$profilePic);
				 $stmt2->execute();
				 
				 $sql = "UPDATE t_year_sections SET avi_status = 0 WHERE year_sec_id = ?";
				 $stmt = $this->dbCon->prepare($sql);
				 $stmt->bindParam(1,$ySecId);
				 $stmt->execute();
				 
				 $sql = "INSERT INTO t_year_sections_assigned (year_sec_id, teacher_id, teacher_fullname, year_level, section_name, year_sec_code)
						VALUES (?,?,?,?,?,?)";
				 $stmt = $this->dbCon->prepare($sql);
				 $stmt->bindParam(1,$ySecId);
				 $stmt->bindParam(2,$idNum);
				 $stmt->bindParam(3,$fullname);
				 $stmt->bindParam(4,$ySecYLevel);
				 $stmt->bindParam(5,$ySecSName);
				 $stmt->bindParam(6,$ySecCode);
				 $stmt->execute();
				 //Note: unfinished inserting data to table t_year_sections_assigned

			}else{
				echo "exist";
			}
			
			//close connection
			$this->closeCon();
		}
		
		/*-----------NEW SUBJECT TEACHER------*/
		function checkNSidNum($idNum){
			 $this->opencon();
			 $sql = "SELECT teacher_id FROM t_teachers WHERE teacher_id = ?";
			 $stmt = $this->dbCon->prepare($sql);
			 $stmt->bindParam(1,$idNum);
			 $stmt->execute();
			 $row = $stmt->fetch();
			 if($row[0] == "" || $row[0] == null){
				    echo ""; 
			 }else{
				    echo "1";
			 }
			 $this->closeCon();
		}
		
		function save_new_st($decoded){
				$this->openCon();
				$arrData = array();
				foreach($decoded as $info){
						array_push($arrData, $info['value']);
				}
				$fullname = $arrData[1]." ".$arrData[2]." ".$arrData[3];
				$sql = "INSERT INTO t_teachers (teacher_id,fullname,address,email,mobile,age,gender,bdate,rank,teacher_type,profile_pic)
				 VALUES (?,?,?,?,?,?,?,?,?,?,?)";
				$stmt = $this->dbCon->prepare($sql);
				$stmt->bindParam(1,$arrData[0]);
				$stmt->bindParam(2,$fullname);
				$stmt->bindParam(3,$arrData[4]);
				$stmt->bindParam(4,$arrData[5]);
				$stmt->bindParam(5,$arrData[6]);
				$stmt->bindParam(6,$arrData[7]);
				$stmt->bindParam(7,$arrData[8]);
				$stmt->bindParam(8,$arrData[9]);
				$stmt->bindParam(9,$arrData[10]);
				$stmt->bindParam(10,$arrData[11]);
				$stmt->bindParam(11,$arrData[12]);
				$stmt->execute();
				
				$this->closeCon();
		}
	}
?>