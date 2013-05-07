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
			$sqlCheck = "SELECT teach_auto_id,teacher_id FROM t_teachers WHERE teacher_id = ?";
			$stmt1 = $this->dbCon->prepare($sqlCheck);
			$stmt1->bindParam(1,$idNum);
			$stmt1->execute();
			$row = $stmt1->fetch();
				if($row[1] == "" || $row[1] = null){
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

                 $sql = "SELECT teach_auto_id FROM t_teachers WHERE teacher_id = ?";
                 $stmt = $this->dbCon->prepare($sql);
                 $stmt -> bindParam(1,$idNum);
                 $stmt->execute();
                 $row = $stmt->fetch();
                 $teach_auto_id = $row[0];

				 $sql = "INSERT INTO t_year_sections_assigned (year_sec_id, teach_auto_id, teacher_fullname, year_level, section_name, year_sec_code)
						VALUES (?,?,?,?,?,?)";
				 $stmt = $this->dbCon->prepare($sql);
				 $stmt->bindParam(1,$ySecId);
				 $stmt->bindParam(2,$teach_auto_id);
				 $stmt->bindParam(3,$fullname);
				 $stmt->bindParam(4,$ySecYLevel);
				 $stmt->bindParam(5,$ySecSName);
				 $stmt->bindParam(6,$ySecCode);
				 $stmt->execute();

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

        //MANAGE TEACHERS

        function view_teacher_first_page($search_input_val, $teacher_type, $page_limit){
            $this->openCon();
            $current_page = 1;
            $start_page = ($current_page - 1) * $page_limit;

            $sql = "SELECT teach_auto_id, profile_pic, teacher_id, fullname, teacher_type FROM t_teachers
                   WHERE teacher_type = '$teacher_type' AND (teacher_id LIKE '$search_input_val'
                  OR fullname LIKE '$search_input_val')  LIMIT $start_page , $page_limit";
            //echo $sql;
            $stmt = $this->dbCon->prepare($sql);
            $stmt->execute();
            $profile_pic = "";
            while($row = $stmt->fetch()){
                $profile_pic = $row[1];
                if($profile_pic == "" || $profile_pic == null){
                    $profile_pic = "profile_pic_teachers/avatar.gif";
                }
                echo "<tr>";
                echo "<td><input type=checkbox id='checkbox'.$row[0] /></td>";
                echo "<td><span class='table-icon edit' title='Edit' id='edit'.$row[0]></span></td>";
                echo "<td><span class='table-icon delete' title='Delete' id='delete'.$row[0]></span></td>";
                echo "<td><img src='$profile_pic' style='width: 20px ;height: 20px;'/></td>";
                echo "<td>".$row[2]."</td>";
                echo "<td>".$row[3]."</td>";
                echo "<td>".$row[4]."</td>";
                echo "</tr>";
            }
            

            $this->closeCon();
        }

        function view_teachers_paginate($search_input_val, $teacher_type, $page_limit, $page){
            $this->openCon();
            $current_page = $page;
            echo $current_page;
            $start_page = ($current_page - 1 ) * $page_limit;

            $sql = "SELECT teach_auto_id, profile_pic, teacher_id, fullname, teacher_type FROM t_teachers
                    WHERE teacher_type = '$teacher_type' AND (teacher_id LIKE '$search_input_val'
                    OR fullname LIKE '$search_input_val')  LIMIT $start_page , $page_limit ";
            $stmt = $this->dbCon->prepare($sql);
            $stmt->execute();
            $profile_pic = "";
            while($row = $stmt->fetch()){
                $profile_pic = $row[1];
                if($profile_pic == "" || $profile_pic == null){
                    $profile_pic = "profile_pic_teachers/avatar.gif";
                }
                echo "<tr id=tr_teacher".$row[0].">";
                echo "<td><input type=checkbox id='checkbox'.$row[0].'/><input type='hidden' id='teacher_auto_id' value=".$row[0]." /></td>";
                echo "<td><span class='table-icon edit' title='Edit' id='edit'.$row[0]></span></td>";
                echo "<td><span class='table-icon delete' title='Delete' id='delete'.$row[0] onclick='delete_one_teacher(".$row[0].")'></span></td>";
                echo "<td><img src='$profile_pic' style='width: 20px ;height: 20px;'/></td>";
                echo "<td>".$row[2]."</td>";
                echo "<td>".$row[3]."</td>";
                echo "<td>".$row[4]."</td>";
                echo "</tr>";
            }

            $this->closeCon();
        }

        //PAGINATION TEACHERS
        function pagination_system($current_page, $input_search_val, $teacher_type, $page_limit){
            $this->openCon();

            $sql = "SELECT COUNT(*) FROM t_teachers WHERE (teacher_id LIKE '$input_search_val' OR fullname LIKE '$input_search_val') AND teacher_type = ? ";
            $stmt = $this->dbCon->prepare($sql);
            $stmt->bindParam(1,$teacher_type);
            $stmt->execute();
            $row = $stmt->fetch();

            $total_pages = $row[0];
            $pagination_stages = 2;
            if($current_page == 0){$current_page == 1;}
            $previous_page = $current_page -1;
            $next_page = $current_page + 1;
            $last_page = ceil($total_pages/$page_limit);
            $last_paged = $last_page -1;
            $pagination = '';

            if($last_page > 1){
                $pagination .= "<div>";

                //Previous page
                if($current_page > 1)
                {
                    $pagination .= "<a href='javascript:void(0)' onclick='pagination_system(\"$previous_page\");'>Prev</a> ";
                }
                else
                {
                    $pagination .= "<span class='disabled'>Prev</span>";
                }
                //Pages
                if($last_page < 7 + ($pagination_stages * 2))
                { //Not enough pages to breaking it up
                    for($page_counter = 1; $page_counter <= $last_page; $page_counter++)
                    {
                        if($page_counter == $current_page)
                        {
                            $pagination .= "<span class='current'>$page_counter</span>";
                        }
                        else
                        {
                            $pagination .= "<a href='javascript:void(0);' onclick='pagination_system(\"$page_counter\");'>$page_counter</a>";
                        }
                    }
                }
                elseif( $last_page > 5 + ($pagination_stages *2) )
                { // This hides few pages when the displayed pages are much
                    //Beginning only hide later pages
                    if( $current_page< 1 + ($pagination_stages * 2))
                    {
                        for($page_counter = 1; $page_counter < 4 + ($pagination_stages * 2); $page_counter++)
                        {
                            if( $page_counter == $current_page ){
                                $pagination .= "<span class='current'>$page_counter</span>";
                            }else{
                                $pagination.= "<a href='javascript:void(0);' onclick='pagination_system(\"$page_counter\");'>$page_counter</a>";
                            }
                        }
                        $pagination .= "...";
                        $pagination .= "<a href='javascript:void(0);' onclick='pagination_system(\"$last_paged\");'>$last_paged</a>";
                        $pagination .= "<a href='javascript:void(0);' onclick='pagination_system(\"$last_page\");'>$last_page</a>";
                    }
                    //Middle hide some front and some back
                    elseif( $last_page - ($pagination_stages * 2) > $current_page && $current_page > ($pagination_stages * 2) )
                    {
                        $pagination .= "<a href='javascript:void(0);' onclick='pagination_system(\"1\");'>1</a>";
                        $pagination .= "<a href='javascript:void(0);' onclick='pagination_system(\"2\");'>2</a>";
                        $pagination .= "...";

                        for( $page_counter = $current_page - ($pagination_stages * 2); $page_counter <= $current_page + $pagination_stages; $page_counter++ )
                        {
                            if($page_counter == $current_page)
                            {
                                $pagination .= "<span class='current'>$page_counter</span>";
                            }
                            else
                            {
                                $pagination .= "<a href='javascript:void(0);' onclick='pagination_system(\"$page_counter\");'>$page_counter</a>";
                            }
                        }
                        $pagination .= "...";
                        $pagination .= "<a href='javascript:void(0);' onclick='pagination_system(\"$last_paged\");'>$last_paged</a>";
                        $pagination .= "<a href='javascript:void(0);' onclick='pagination_system(\"$last_page\");'>$last_page</a>";
                    }
                    //End only hide early pages
                    else{
                        $pagination .= "<a href='javascript:void(0);' onclick='pagination_system(\"1\");'>1</a>";
                        $pagination .= "<a href='javascript:void(0);' onclick='pagination_system(\"2\");'>2</a>";
                        $pagination .= "...";
                        for( $page_counter = $last_page - (2 + ($pagination_stages * 2 ) ); $page_counter <= $last_page; $page_counter++ ){
                            if($page_counter == $current_page){
                                $pagination .= "<span class='current'>$page_counter</span>";
                            }else {
                                $pagination.= "<a href='javascript:void(0);' onclick='pagination_system(\"$page_counter\");'>$page_counter</a>";
                            }
                        }
                    }//end else only hide early pagess
                }
                //Next Page
                if( $current_page < $page_counter -1 )
                {
                    $pagination .= "<a href='javascript:void(0);' onclick='pagination_system(\"$next_page\");'>Next</a>";
                }else
                {
                    $pagination .= "<span class='disabled'>Next</span>";
                }
                $pagination .= "<span> &nbsp;&nbsp;&nbsp;&nbsp;Page ".$current_page." of ".$last_page."&nbsp;&nbsp;&nbsp;&nbsp;</span></span></div>";

                /*Note: there is a problem in paginating data
                 *
                 */
            }else{
                $pagination = "<div><span>Pagination is not available..</span></div>";
            }

            //show pagination
            echo $pagination;

            $this->closeCon();

        }

        //DELETE ON TEACHER
        function delete_one_teacher($teach_auto_id){
            $this->openCon();
            //select teacher type
            //if adviser unassign to their advisory class, unassign to subjects
            //if subject teacher unassign to their subject class
            //if sshool head teacher inactivate move to recent_head_teacher_table
            $sql = "DELETE FROM t_teachers WHERE teach_auto_id = ? ";
            $stmt = $this->dbCon->prepare($sql);
            $stmt -> bindParam(1,$teach_auto_id);
            //$stmt->execute();

            $this->closeCon();
        }

        //DELETE SEVERAL TEACHERS
        function delete_several_teachers($dataArr){
            $this->openCon();
            for($ctr = 0; $ctr < count($dataArr); $ctr++){
                $sql = "DELETE FROM t_teachers WHERE teach_auto_id = ? ";
                $stmt = $this->dbCon->prepare($sql);
                $stmt -> bindParam(1,$dataArr[$ctr]);
                $stmt->execute();
            }

            $this->closeCon();
        }
	}
?>