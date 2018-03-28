<?php
	include("lib/dbfunctions.php");
	$dbobject = new dbobject();
	$username = $_SESSION['username_sess'];	
	$dbobject = new dbobject();
	$op=$_REQUEST['op'];
	if($op =='edit')
	{
		$dept_id = $_REQUEST['dept_id'];
		$result = $dbobject->getrecordset('dept','dept_id',$dept_id);
		
		$numrows = mysql_num_rows($result);
		if($numrows > 0)
		{
			$row = mysql_fetch_array($result);
			$dept_name = $row['dept_name'];
			$dept_hod = $row['dept_hod'];
			$posted_user = $row['posted_user'];
			$created = $row['created'];
		}
		
	}else
	{
		 $dept_id=$dbobject->paddZeros($dbobject->getnextid('dept'),3);
		 $created = date("Y-m-d H:i:s");
	}
	$user_sel= $dbobject->getTableSelectArr('userdata',array('username','username'),array('1','username!'),array('1','501'),'username','ASC',$dept_hod,'H.O.D');
?>
<input type="hidden" name="operation" id="operation" value="<?php echo ($op=='edit')?'edit':"new"; ?>"/>
<div class="row-fluid">
 <form class="mws-form" action="" method="get" id="form1">
                    <div class="span8">
                        <div class="head clearfix">
                            <!--<div class="isw-documents"></div>-->
                            <h1>Department Setup</h1>
                        </div>
                        <div class="block-fluid">                        
						<div class="row-form clearfix">
                                <div class="span2">Department ID : </div>
                                <div class="span5">
                                <input type="text" name="dept_id-whr" id="dept_id-whr" value="<?php echo $dept_id; ?>" class="required-text form-control" readonly="true"/>
                                </div>
                            </div> 

                            <div class="row-form clearfix">
                                <div class="span2">Departmnt Name :</div>
                                <div class="span5"><input type="text" name="dept_name-fd" id="dept_name-fd" class="required-text form-control" title="Department Name" value="<?php echo $dept_name; ?>" /></div>
                            </div>
                           
                           <div class="row-form clearfix">
                                <div class="span2">H.O.D :</div>
                                <div class="span5"><label><select name="dept_hod-fd" id="dept_hod-fd" class="required-text form-control" title="Department H.O.D"><?php echo $user_sel; ?></select></label></div>
                            </div>
                       
                        <div id="alertmsg">
                          <strong id="hhdd"></strong> 
           <div id ="display_message" style="padding-left:10px;padding-right:10px;" ></div>
                    </div>            
                                                                    
         <div class="span5"><input type="hidden" name="created-fd" id="created-fd" class="required-text form-control" title="created" value="<?php echo $created; ?>"/></div>
                            
                            
                            
                                <div class="span5"><input type="hidden" name="posted_user-fd" id="posted_user-fd" class="required-text form-control" title="posted_user" value="<?php echo $_SESSION['username_sess']?>" /></div>
                                
                    <div class="footer tar" style="padding-right:60px !important; text-align:center !important;">
                        <input type="button" name="subbtn" id="subbtn" value="Save Department" onclick="javascript: calldage()" class="btn btn-info">
                        <input type="button" name="subbtn" id="subbtn" value="Cancel" onclick="javascript:getpage('dept_list.php','page')" class="btn btn-danger">
                    </div>
                    
                 </div>
             </div>
             
             </div>
             </div>
             </div>
             </div>
             </form>
             
  <script>
  function calldage()
  {           
             callPageEdit('dept','dept.php','page');
  }
	
</script>
              