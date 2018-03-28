 <?php 
 include("lib/dbfunctions.php");
$dbobject = new dbobject();      
 $user_id = $_SESSION['user_id_sess'];
 $query = "SELECT project_id , project_name, prioritization_id, project_status FROM `project` WHERE project_id IN (select project_id FROM projectgroup WHERE user_id ='".$user_id."') and project_status not IN ('2','3')";	 
		
	$result = mysql_query($query);
		$numrows = mysql_num_rows($result); 
		if($numrows > 0)
		{
			$row = mysql_fetch_array($result);
			
			$project_id = $row['project_id'];
			$project_name = $row['project_name'];
			$prioritization_id = $row['prioritization_id'];
		}
		
		
		$prioritization_id=$row["prioritization_id"];	
			$prioritization_name=$dbobject->getitemlabel('prioritization','prioritization_id',$prioritization_id,'prioritization_name');
			
		?>
  <div class="workplace" id="page">
            <!--<div class="clearfix">-->
    
                    <div style="display:inline; !important">
                     <div style=" float:left;
                     margin: 15px;
                    padding-left: 15px;
                    padding-right: 15px;
                    box-shadow:3px 3px 4px 2px #CCC;
                    height:160px;
                    width: 27%; 
                    background-color: white">
                       <!-- #913F7F framework purpple-->
                            <div style=" padding:3px; float:left;border-radius:2px; box-sizing:border-box;box-shadow:3px 3px 5px 2px #CCC ; background-color:pink; width: 100% ; height: 50px;">
                           
                        <p  style="margin-top:0px;">Total <?php echo $numrows ?></p>
                        <p style=" size:1px;color:rgba(0,0,0,0.4); margin-top:-15px;">Total active Project allocated to you</p>
                            
                            </div>
                             <div>
                             <table class="table responsive">
                             <tr>
                             <th>id</th>
                             <th>Project</th>
                             <th>Prioritation</th>
                             </tr>
                             </thead>
                             <tbody>
                             <?php do { ?>
                             <tr>
                                     <td><?php echo $row['project_id']; ?></td>
                                      <td><?php echo $row['project_name']; ?></td>
                                      <td><?php echo $prioritization_name; ?></td>
                             </tr>
                             <?php } while ($row = mysql_fetch_assoc($result)); ?>
                             </tbody>
                             
                             </table>
                             
                             
                             </div>
                           
                            
                            <div>  </div> </div> </div>
                    <div  style=" float:left;
                    margin: 15px;
                    padding-left: 15px;
                    padding-right: 15px;
                    box-shadow:2px 2px 3px 1px #CCC;
                    height:160px;
                    width: 28%;
                    background-color:lightblue; ">
                       
                             <p>&nbsp;</p>
                             <p>&nbsp;</p>
                          	 <p>&nbsp;</p>
                             <hr style="border:0.3px solid rgba(0,0,0,0.1)"/>
                            <div> 
                            
                      </div> 
                             
                    </div>
                    
                   
                    <div  style=" float:left;
                     margin: 15px;
                    padding-left: 15px;
                    padding-right: 15px;
                    box-shadow:2px 2px 3px 1px #CCC;
                    height:160px;
                    width: 28%;
                    background-color:pink ">
                        
                        
                            <div class="text">Target</div>
                            <hr style="border:0.3px solid rgba(0,0,0,0.1)"/>
                            <div>  </div> 
                    </div>
                    
            </div>
            </div>