<?php
	include("lib/dbfunctions.php");
	$dbobject = new dbobject();
	$username = $_SESSION['username_sess'];	
	$dbobject = new dbobject();
	if($_REQUEST['op']=='edit')
	{
		$asset_id = $_REQUEST['asset_id'];
		$result = $dbobject->getrecordset('assets_setup','asset_id',$asset_id);
		
		$numrows = mysql_num_rows($result);
		if($numrows > 0)
		{
			$row = mysql_fetch_array($result);
			$asset_name = $row['asset_name'];
			$asset_class = $row['asset_class'];
			$created = $row['created'];
			$officer = $row['officer'];
			/*$enable_asset = $row['asset_enabled'];*/
		}
		
	}else
	{
		 $asset_id="ASS".date('YmdHis').$dbobject->paddZeros($dbobject->getnextid('assets_setup'),4);
		 $created = date("Y-m-d H:i:s");
	}
?>
<input type="hidden" name="operation" id="operation" value="new" />
<div class="row-fluid">
 <form class="mws-form" action="" method="get" id="form1">
                    <div class="span8">
                        <div class="head clearfix">
                            <!--<div class="isw-documents"></div>-->
                            <h1>Asset Setup</h1>
                        </div>
                        <div class="block-fluid">                        
						<div class="row-form clearfix">
                                <div class="span2">Asset ID : </div>
                                <div class="span5">
                                <input type="text" name="asset_id-whr" id="asset_id-whr" value="<?php echo $asset_id; ?>" class="required-text form-control" readonly="true"/>
                                </div>
                            </div> 

                            <div class="row-form clearfix">
                                <div class="span2">Asset Name :</div>
                                <div class="span5"><input type="text" name="asset_name-fd" id="asset_name-fd" class="required-text form-control" title="asset Name" value="<?php echo $asset_name; ?>" /></div>
                            </div>
                           
                           <div class="row-form clearfix">
                                <div class="span2">Asset Class :</div>
                                <div class="span5"><input type="text" name="asset_class-fd" id="asset_class-fd" class="required-text form-control" title="asset class" value="<?php echo $asset_class; ?>" /></div>
                            </div>
                        
                                    
                    <div id="alertmsg" class="alert alert-success" style="display:none;">
                          <strong id="hhdd">Successful ! </strong>
                          <div id ="display_message" style="padding-left:10px;padding-right:10px;display:none;" ></div>
                    </div>
                                                
         <div class="span5"><input type="hidden" name="created-fd" id="created-fd" class="required-text form-control" title="created" value="<?php echo $created; ?>" /></div>
                            
                            
                            
                                <div class="span5"><input type="hidden" name="officer-fd" id="officer-fd" class="required-text form-control" title="officer" value="<?php echo $_SESSION['username_sess']?>" /></div>
                                
                    <div class="footer tar" style="padding-right:60px !important; text-align:center !important;">
                        <input type="button" name="subbtn" id="subbtn" value="Save Asset" onclick="javascript: calldage()" class="btn btn-info">
                        <input type="button" name="subbtn" id="subbtn" value="Cancel" onclick="javascript:getpage('asset_list.php','page')" class="btn btn-danger">
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
             callPageEdit('assets_setup','asset.php','page');
  }
	
</script>
              