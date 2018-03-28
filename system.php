<?php
	include("lib/dbfunctions.php");
	$dbobject = new dbobject();
	$username = $_SESSION['username_sess'];	
	$dbobject = new dbobject();
	$op=$_REQUEST['op'];
	if($op =='edit')
	{
		$system_id = $_REQUEST['system_id'];
		$result = $dbobject->getrecordset('system','system_id',$system_id);
		
		$numrows = mysql_num_rows($result);
		if($numrows > 0)
		{
			$row = mysql_fetch_array($result);
			$username = $row['username'];
			$system_name = $row['system_name'];
			$system_detail = $row['system_detail'];
			$mac_address = $row['mac_address'];
			$posted_user = $row['posted_user'];
			$created = $row['created'];
		}
		
		
	}else
	{
		 $system_id="System".$dbobject->paddZeros($dbobject->getnextid('system'),2);
		 $created = date("Y-m-d H:i:s");
	}
	$user_sel= $dbobject->getTableSelectArr('userdata',array('username','username'),array('1','username!'),array('1','501'),'username','ASC',$username,'Staff');
	
?>
<input type="hidden" name="operation" id="operation" value="<?php echo ($op=='edit')?'edit':"new"; ?>" />
<div class="row-fluid">
 <form class="mws-form" action="" method="post" id="form1">
                    <div class="span8">
                        <div class="head clearfix">
                            <!--<div class="isw-documents"></div>-->
                            <h1>System Setup</h1>
                        </div>
                        <div class="block-fluid">                        
						<div class="row-form clearfix">
                                <div class="span3">System ID : </div>
                                <div class="span5">
                                <input type="text" name="system_id-whr" id="system_id-whr" value="<?php echo $system_id; ?>" class="required-text form-control" readonly="true"/>
                                </div>
                            </div> 
<div class="row-form clearfix">
                                <div class="span3">Select Staff:</div>
                                <div class="span5"><label>
                    <select name="username-fd" id="username-fd" class="required-text form-control" title="Staff"><?php echo $user_sel; ?></select>
                  </label></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span3">System Name/Type :</div>
                                <div class="span5"><input type="text" name="system_name-fd" id="system_name-fd" class="required-text form-control" title="System Name" value="<?php echo $system_name; ?>" /></div>
                            </div>
                           
                           <div class="row-form clearfix">
                                <div class="span3">System Details :</div>
                                <div class="span5"><textarea cols="1" rows="1" name="system_details-fd" id="system_details-fd" class="required-text form-control" title="System Details" value="<?php echo $system_details; ?>"></textarea></div>
                            </div>
                            
                            <div class="row-form clearfix">
                                <div class="span3">MAC Address :</div>
                                <div class="span5"><input type="text" name="mac_address-fd" id="mac_address-fd" class="required-text form-control" title="MAC Address" value="<?php echo $mac_address; ?>" /></div>
                            </div>
                                 
                    <div id="alertmsg">
                          <strong id="hhdd"></strong> 
           <div id ="display_message" style="padding-left:10px;padding-right:10px;" ></div>
                    </div>
                    
                                                
         <div class="span5"><input type="hidden" name="created-fd" id="created-fd" class="required-text form-control" title="created" value="<?php echo $created; ?>" /></div>
                            
                            
                            
                                <div class="span5"><input type="hidden" name="posted_user-fd" id="posted_user-fd" class="required-text form-control" title="posted_user" value="<?php echo $_SESSION['username_sess']?>" /></div>
                                
                    <div class="footer tar" style="padding-right:60px !important; text-align:center !important;">
                        <input type="button" name="subbtn" id="subbtn" value="Save" onclick="javascript: calldage()" class="btn btn-info">
                        <input type="button" name="subbtn" id="subbtn" value="Cancel" onclick="javascript:getpage('system_list.php','page')" class="btn btn-danger">
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
  
	 	callPageEdit('system','system.php','page');
	
  }
	
</script>
              