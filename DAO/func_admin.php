<?php
include "db_connect.php";
    class func_admin extends db_connect{
        function validate_admin_user($admin_username,$admin_password){
            $this->openCon();

            $sql = "SELECT username, password FROM t_admin_account WHERE username=? AND password=?";
            $stmt = $this->dbCon->prepare($sql);
            $stmt-> bindParam(1,$admin_username);
            $stmt-> bindParam(2,$admin_password);
            $stmt->execute();
            $row = $stmt->fetch();
                if($row['username']=="" || $row[0]==null){
                   return false;
                }else{
                   return true;
                }

            //close connection
            $this->closeCon();
        }

        //SET STATUS INTO ACTIVE
        function setStatus($status){
            $this->openCon();
            $sql = "UPDATE t_admin_account SET status = ?";
            $stmt = $this->dbCon->prepare($sql);
            $stmt->bindParam(1,$status);
            $stmt->execute();

            //close connection
            $this->closeCon();
        }

        //LOGOUT ADMINISTRATOR
        //SET DATE LAST LOGIN
        function setLastLogin($dateLL){
            echo $dateLL;
            $this->openCon();
            $sql = "UPDATE t_admin_account SET status = 0, last_login = ?";
            $stmt = $this->dbCon->prepare($sql);
            $stmt->bindParam(1,$dateLL);
            $stmt->execute();

            //close connection
            $this->openCon();
        }

        //GET ADMINISTRATOR'S NAME
        function get_admin_name($admin_username,$admin_password){
            $this->openCon();
            $sql = "SELECT fullname,last_login FROM t_admin_account WHERE username = ? AND password = ?";
            $stmt = $this->dbCon->prepare($sql);
            $stmt->bindParam(1,$admin_username);
            $stmt->bindParam(2,$admin_password);
            $stmt->execute();
            $name = $stmt->fetch();
            return $name['fullname'];

            //close connection
            $this->closeCon();
        }

        //GET ADMINISTRATOR'S PROFILE PIC
        function get_admin_pic($admin_username,$admin_password){
            $this->openCon();
            $sql = "SELECT admin_id FROM t_admin_account WHERE username = ? AND password = ?";
            $stmt = $this->dbCon->prepare($sql);
            $stmt->bindParam(1,$admin_username);
            $stmt->bindParam(2,$admin_password);
            $stmt->execute();
            $row =$stmt->fetch();

            $sql = "SELECT profile_pic FROM t_admin_infos WHERE admin_id = ?";
            $stmt = $this->dbCon->prepare($sql);
            $stmt->bindParam(1,$row[0]);
            $stmt->execute();
            $row1 = $stmt->fetch();
            return $row1[0];

            $this->closeCon();
        }

        //GET DATE TIME LAST LOGIN
        function get_date_last_login($a_username,$a_password){
            $this->openCon();
            $sql = "SELECT last_login FROM t_admin_account WHERE username = ? AND password = ?";
            $stmt = $this->dbCon->prepare($sql);
            $stmt->bindParam(1,$a_username);
            $stmt->bindParam(2,$a_password);
            $stmt->execute();
            $date = $stmt->fetch();
            return $date[0];

            //close connection
            $this->closeCon();
        }

        //VIEWING LATEST ANNOUNCEMENTS
        function viewLatestAnn($status){
            $this->openCon();
            $sql = "SELECT posted_by, announcement_cont, date_posted FROM t_announcements WHERE status = ? ";
            $stmt = $this->dbCon->prepare($sql);
            $stmt->bindParam(1,$status);
            $stmt->execute();
            $ann = $stmt->fetch();
            $announcements =  "<div class=announcements_box>
                                <span id=ann_msg class=ann_msg>".$ann[1]."</span>
                                <p class=post_info>Posted by <span id=ann_posted_by class=posted_by>".$ann[0]."</span>
                                on <span id=ann_date class=ann_date>".$ann[2]."</span>
                                </p>
                                </div>";
            echo $announcements;
            //close connection
            $this->closeCon();
        }

        //VIEWING ALL ANNOUNCEMENTS
        function viewAllAnnouncements(){
            $this->openCon();
            $sql = "SELECT ann_id, posted_by, announcement_cont, date_posted, status FROM t_announcements ORDER BY date_posted ASC";
            $stmt = $this->dbCon->prepare($sql);
            $stmt->execute();
            while($all = $stmt->fetch()){
                $status = $all[4];
                if($status == "active"){
                     $all_ann = "<div class=announcement_box>
                                    (<span class=head_new>new</span>)<br/>
                                    <span id=admin_all_ann class=ann_msg>".$all[2]."</span>
                                    <p class=post_info>Posted by <span id=ann_posted_by class=posted_by>".$all[1]."</span>
                                    on <span id=ann_date class=ann_date>".$all[3]."</span><br/>
                                    ---------------------------------------------------------
                                </div>";
                }else{
                    $all_ann = "<div class=announcement_box>
                                    <span id=admin_all_ann class=ann_msg>".$all[2]."</span>
                                    <p class=post_info>Posted by <span id=ann_posted_by class=posted_by>".$all[1]."</span>
                                    on <span id=ann_date class=ann_date>".$all[3]."</span><br/>
                                    ---------------------------------------------------------
                                </div>";
                }
                echo $all_ann;
            }
            //close connection
            $this->closeCon();
        }

        //msg = nl2br($msg);
        //VIEWING LATEST EVENT
        function viewLatesEvent($status){
            $this->openCon();
            $sql = "SELECT event_cont, date_created, created_by FROM t_events WHERE status = ?";
            $stmt = $this->dbCon->prepare($sql);
            $stmt->bindParam(1,$status);
            $stmt->execute();
            $event = $stmt->fetch();
            $events = "<div class=events_box>
                            <span id=event_msg class=event_msg>".$event[0]."</span>
                            <p class=event_post_info>
                                Created by <span id=event_created_by class=created_by>".$event[2]."</span>
                                on <span id=event_date_created class='event_date_created'>".$event[1]."</span>
                            </p>
                        </div>";
            echo $events;

            //close connection
            $this->closeCon();
        }

        //VIEWING ALL EVENTS
        function viewlAllEvents(){
            $this->openCon();
            $sql = "SELECT event_cont, date_created, created_by, status FROM t_events ORDER BY date_created ASC";
            $stmt = $this->dbCon->prepare($sql);
            $stmt->execute();
            while($all_e = $stmt->fetch()){
                $status = $all_e[3];
                //echo $status;
                if($status == "active"){
                    $all_events = "<div class=events_box>
                                      (<span class=head_new>new</span>)<br/>
                                      <span id=event_msg class=event_msg>".$all_e[0]."</span>
                                      <p class=event_post_info>
                                        Created by <span id=event_created_by class=created_by>".$all_e[2]."</span>
                                         on <span id=event_date_created class='event_date_created'>".$all_e[1]."</span>
                                      </p>
                                      ---------------------------------------------------------
                                   </div>";
                }else{
                    $all_events = "<div class=events_box>
                                      (<span class=head_new>new</span>)<br/>
                                      <span id=event_msg class=event_msg>".$all_e[0]."</span>
                                      <p class=event_post_info>
                                        Created by <span id=event_created_by class=created_by>".$all_e[2]."</span>
                                        on <span id=event_date_created class='event_date_created'>".$all_e[1]."</span>
                                      </p>
                                      ---------------------------------------------------------
                                  </div>";
                }
                echo $all_events;
            } 

            //close connection
            $this->closeCon();
        }

    }
?>