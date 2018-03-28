<?php
	include("lib/dbfunctions.php");
	$dbobject = new dbobject();
	$username = $_SESSION['username_sess'];	
	$dbobject = new dbobject();
	$op=$_REQUEST['op'];
	if($op =='edit')
	{
		$client_id = $_REQUEST['client_id'];
		$result = $dbobject->getrecordset('client','client_id',$client_id);
		
		$numrows = mysql_num_rows($result);
		if($numrows > 0)
		{
			$row = mysql_fetch_array($result);
			$client_name = $row['client_name'];
			$org_name = $row['org_name'];
			$phone_number = $row['phone_number'];
            $email = $row['email'];
            $address=$row['address'];
            $posted_user = $row['posted_user'];
			$created = $row['created'];
		}
		
	}else
	{
		 $client_id="Client/".$dbobject->paddZeros($dbobject->getnextid('Client'),3);
		 $created = date("Y-m-d H:i:s");
	}
?>
<input type="hidden" name="operation" id="operation" value="<?php echo ($op=='edit')?'edit':"new"; ?>"/>
<div class="row-fluid">
 <form class="mws-form" action="" method="get" id="form1">
                    <div class="span8">
                        <div class="head clearfix">
                            <!--<div class="isw-documents"></div>-->
                            <h1>Client Setup</h1>
                        </div>
                        <div class="block-fluid">                        
						<div class="row-form clearfix">
                                <div class="span4">Client ID : </div>
                                <div class="span5">
                                <input type="text" name="client_id-whr" id="client_id-whr" value="<?php echo $client_id; ?>" class="required-text form-control" readonly="true"/>
                                </div>
                            </div> 
								<div class="row-form clearfix">
                                <div class="span4">Client Name :</div>
                                <div class="span5"><input type="text" name="client_name-fd" id="client_name-fd" class="required-text form-control" title="Client Name" value="<?php echo $client_name; ?>" /></div>
                            </div>
                            <div class="row-form clearfix">
                                <div class="span4">Organisation Name :</div>
                                <div class="span5"><input type="text" name="org_name-fd" id="org_name-fd" class="required-text form-control" title="Organisation Name" value="<?php echo $org_name; ?>" /></div>
                            </div>
                           
                           <div class="row-form clearfix">
                                <div class="span4">Contact Person Number :</div>
                                <div class="span5"><input type="text" name="phone_number-fd" id="phone_number-fd" class="required-number form-control" title="Client Phone" value="<?php echo $phone_number; ?>" /></div>
                            </div>

                            <div class="row-form clearfix">
                                <div class="span4">Contact Person Email :</div>
                                <div class="span5"><input type="text" name="email-fd" id="email-fd" class="required-email  form-control" title="Client Email" value="<?php echo $email; ?>" /></div>
                            </div>

                            <div class="row-form clearfix">
                                <div class="span4">Organisation Address :</div>
                                <div class="span5"><textarea type="text" name="address-fd" id="address-fd" class="required-text form-control" title="Organisation Address" value=""> <?php echo $address; ?> </textarea>
                                </div>
                            </div>
                       
                        <div id="alertmsg">
                          <strong id="hhdd"></strong> 
           <div id ="display_message" style="padding-left:10px;padding-right:10px;" ></div>
                    </div>            
                                                                    
         <div class="span5"><input type="hidden" name="created-fd" id="created-fd" class="required-text form-control" title="created" value="<?php echo $created; ?>"/></div>
                            
                            
                            
                                <div class="span5"><input type="hidden" name="posted_user-fd" id="posted_user-fd" class="required-text form-control" title="posted_user" value="<?php echo $_SESSION['username_sess']?>" /></div>
                                
                    <div class="footer tar" style="padding-right:60px !important; text-align:center !important;">
                        <input type="button" name="subbtn" id="subbtn" value="Save Client" onclick="javascript: calldage()" class="btn btn-info">
                        <input type="button" name="subbtn" id="subbtn" value="Cancel" onclick="javascript:getpage('client_list.php','page')" class="btn btn-danger">
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
             callPageEdit('client','client.php','page');
  }
	
</script>
              