<?php
//documentation on the spreadsheet package is at:
//http://pear.php.net/manual/en/package.fileformats.spreadsheet-excel-writer.php
require_once('lib/dbfunctions.php');
$dbobject = new dbobject();
date_default_timezone_set('Africa/Lagos');
chdir('phpxls');
require_once 'Writer.php';
chdir('..');

function get_msg($code)
{
	$msg= '';
	if ($code=='99')
	{
		$msg = "Initialised transaction";
	}
	else if ($code=='00')
	{
	  $msg = "Successful";  
	}
	else
	{
		$msg = "Failed";
	}
	return $msg;
}

function settlement($code)
{
	$msg='';
	if ($code=='1')
	{
		$msg='Settled';
	}
	else if($code=='0')
	{
		$msg='Not Settled';
	}
	else
	{
		$msg='Unknown settlement status';
	}
	return $msg;
}

$sql = json_decode($_REQUEST['sql'], true);


$result = mysql_query($sql);
$count = mysql_num_rows($result);
$data = array();
$header = array("Merchant ID","Merchant Name","Settlement Value(NGN)","Settlement Status");
$data[] = $header;
while($row = mysql_fetch_array($result,MYSQL_ASSOC))
{
	$amt=number_format($row['amount'],2);
	$merchant_name=$dbobject->getitemlabel('merchant_reg','merchant_id',$row['destination_acct'],'merchant_name');
   $data[]= array($row['destination_acct'],$merchant_name,$amt,settlement($row['settlement_status']));
}


//$data = $_REQUEST['data'];
//var_dump($excel_data);

$workbook = new Spreadsheet_Excel_Writer();

$format_und =& $workbook->addFormat();
$format_und->setBottom(2);//thick
$format_und->setBold();
$format_und->setColor('black');
$format_und->setFontFamily('Arial');
$format_und->setSize(12);

$format_reg =& $workbook->addFormat();
$format_reg->setColor('black');
$format_reg->setFontFamily('Arial');
$format_reg->setSize(12);


$general_arr = array();
$general_arr2 = array();
if($count > 640)
{
    $n          = ceil(count($data) / 640);
    $excel_data = array_chunk($data,640);
    $arr = array();
    $c = 0;
    foreach($excel_data as $key => $value)
    {
        $arr["sheet".$c] = $value;
        $c++;
    }
    
   
    foreach($arr as $wbname=>$rows) // for each worksheet
            {
                $rowcount = count($rows);
                $colcount = count($rows[0]);

                $worksheet =& $workbook->addWorksheet($wbname);

                $worksheet->setColumn(0,0, 6.14);//setColumn(startcol,endcol,float)
                $worksheet->setColumn(1,3,15.00);
                $worksheet->setColumn(4,4, 8.00);

                for( $j=0; $j<$rowcount; $j++ ) 
                {
                    for($i=0; $i<$colcount;$i++) 
                    {
                        $fmt  =& $format_reg;
                        if ($j==0) // format the header row
                            $fmt =& $format_und;

                        if (isset($rows[$j][$i]))
                        {
                            $data=$rows[$j][$i];
                            $worksheet->write($j, $i, $data, $fmt);
                        }
                    }
                }
            }
    
}else
{
    $n = 1;
    
    $excel_data = $data;

            $arr = array(
                  'Calendar'=>$data
                  );
              foreach($arr as $wbname=>$rows) // for each worksheet
            {
                $rowcount = count($rows);
                $colcount = count($rows[0]);

                $worksheet =& $workbook->addWorksheet($wbname);

                $worksheet->setColumn(0,0, 6.14);//setColumn(startcol,endcol,float)
                $worksheet->setColumn(1,3,15.00);
                $worksheet->setColumn(4,4, 8.00);

                for( $j=0; $j<$rowcount; $j++ ) 
                {
                    for($i=0; $i<$colcount;$i++) 
                    {
                        $fmt  =& $format_reg;
                        if ($j==0) // format the header row
                            $fmt =& $format_und;

                        if (isset($rows[$j][$i]))
                        {
                            $data=$rows[$j][$i];
                            $worksheet->write($j, $i, $data, $fmt);
                        }
                    }
                }
            }
    }

$workbook->send('onepay_settlement_report'.date('YmdHis').'.xls');
$workbook->close();


//-----------------------------------------------------------------------------
?>

