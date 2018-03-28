<?php
	include("lib/dbfunctions.php");
	$dbobject = new dbobject();
	$username = $_SESSION['username_sess'];	
	$user_id = $_SESSION['user_id_sess'];
	$dbobject = new dbobject();
	  //echo $user_id ; 
	if($_REQUEST['op']=='edit')
	{
		$id = $_REQUEST['id'];
		$result = $dbobject->getrecordset('daily_progress','id',$id);
		
		$numrows = mysql_num_rows($result);
		if($numrows > 0)
		{
			$row = mysql_fetch_array($result);
			$project_id = $row['project_id'];
			$username = $row['username'];
			$created = $row['created'];
			$target = $row['target'];
		}
		
	}else{
		$created =date('Y-m-d H : i :s');
		
		$query = "SELECT project_id , project_name, project_status FROM `project` WHERE project_id IN (select project_id FROM projectgroup WHERE user_id ='".$user_id."') and project_status not IN ('2','3')";	 
		
	$result = mysql_query($query);
		$numrows = mysql_num_rows($result);
		if($numrows > 0)
		{
			$row = mysql_fetch_array($result);
			
			$project_id = $row['project_id'];
			$project_name = $row['project_name'];

		}
	}
	
?>

<div class="row-fluid">

                        <?php   if ($numrows > 0){ ?>  
 <form class="mws-form" action="" method="get" id="form1">
 <input type="hidden" name="operation" id="operation" value="new" />
                    <div class="span8">
                        <div class="head clearfix">
                            <!--<div class="isw-documents"></div>-->
                           
                            <h1>Daily Target</h1>
                        </div>
                        <div class="block-fluid">                       
						<div class="row-form clearfix">
                                <div class="span2">Select Project : </div>
                                <div class="span5">
                               
                                <label>
                    <select name="project_id-fd" id="project_id-fd" class="required-text form-control" title="Project">
                    <option value=" ">:::Please Select Option:::</option>
                   <?php do { ?> 
                           
                            
                            <?php echo '<option value ='.$row["project_id"].'>'.$row["project_name"].'</option>'?> 
                             <?php  } while ($row = mysql_fetch_array($result)) ?>
                            
                           </select></label>
                                </div>
                            </div>
                              <div class="span5"><input type="hidden" name="username-whr" id="username-fd" class="required-text form-control" title="username" value="<?php echo $_SESSION['username_sess']?>" /></div>
                              <div class="span5"><input type="hidden" name="created-fd" id="created-fd" class="required-text form-control" title="created" value="<?php echo $created; ?>" /></div>
                            <div class="row-form clearfix">
                            
                                <div class="span2">Target :</div>
                                <div class="span5"><textarea cols="25" rows="5"  name="target-fd" id="target-fd" class="required-text form-control" title="target" value="<?php echo $target; ?>" /></div>
                            </div>
                               
                    <div id="alertmsg" class="alert alert-success" style="display:none;">
                          <strong id="hhdd">Successful ! </strong>
                          <div id ="display_message" style="padding-left:10px;padding-right:10px;display:none;" ></div>
                    </div>
                                                
         
                            
                            
                            
                               
                                
                    <div class="footer tar" style="padding-right:60px !important; text-align:center !important;">
                        <input type="button" name="subbtn" id="subbtn" value="Save Target" onclick="javascript: calldage()" class="btn btn-info">
                        <input type="button" name="subbtn" id="subbtn" value="Cancel" onclick="javascript:getpage('project_log_staff.php','page')" class="btn btn-danger">
                    </div>
                    
                 </div>
             </div>
             
             </div>
             </div>
             </div>
             </div>
             </form>
              <?php   }else { ?>
                           <p>No Project Allocated to You is currently active please contact the Project Manager or your Departmental Supervisor </p>
                           <?php } ?>
  <script>
  function calldage()
  {           
             callPageEdit('daily_progress','target.php','page');
  }
	
</script>
              