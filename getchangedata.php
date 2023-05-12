

<?php
require_once("includes/configure.php");
//include("session_check.php");
$SiteDbConnection=mysql_connect(DATABASE_SERVER, DBUSER, DBPASS,1);
mysql_select_db(MASTER_DATABASE,$SiteDbConnection);
if(isset($_POST["category"])){
    // Capture selected country
    $category = $_POST["category"];
    if($category !== 'select'){
    // Define country and city array
    $sqlmodel="select sku_code, sku_name as skuname from tbl_sku_master_07_21 where category_code='".$category."'";
    $sqlmodel=mysql_query($sqlmodel);
    //$fetchmod=mysql_fetch_array($sqlmodel);
    echo $fetchmod['skuname'];
    echo "<select name='modelno' id='modelno'  style='width:100%;height:100%;font-size:11px;height:35px;'>
    
    <option value='select'>Select</option>";
    if(mysql_num_rows($sqlmodel)>0)
    {
        while($fetchmod=mysql_fetch_array($sqlmodel))
        {
            
            echo "<option value=".$fetchmod['sku_code'].">".$fetchmod['skuname']."</option>";
            
        
        }    
    }
    echo "</select>";


    // Display city dropdown based on country name
    
       
        
    } 
}
if(isset($_POST["store_code"])){
    // Capture selected country
    $outlet = $_POST["store_code"];
    $user=$_POST["user_id"];
    if($outlet !== 'select'){
    // Define country and city array
   $sqloutlet="select count(tbl_promotion_data.user_id) as count,tbl_target_master_07_21.target as target from tbl_target_master_07_21,tbl_promotion_data where tbl_target_master_07_21.store_code='".$outlet."' and tbl_target_master_07_21.user_id='".$user."' and tbl_promotion_data.store_code=tbl_target_master_07_21.store_code and tbl_promotion_data.user_id=tbl_target_master_07_21.user_id";
    $sqloutlet=mysql_query($sqloutlet);
    //$fetchmod=mysql_fetch_array($sqlmodel);
    //$fetchoutlet['count'];
    
    if(mysql_num_rows($sqloutlet)>0)
    {
        while($fetchoutlet=mysql_fetch_array($sqloutlet))
        {
            
            $val=($fetchoutlet['count']+1).'/'.$fetchoutlet['target'];
            
            echo '<input type="text" name="analysis" id="analysis" rows="" cols="" style="width:100%;font-size:11px;height:35px;" value="'.$val.'" readonly></input>';
           // echo "<option value=".$fetchmod['sku_code'].">".$fetchmod['skuname']."</option>";
        }
        
        
    }
    //echo "</select>";


    // Display city dropdown based on country name
    
       
        
    } 
    else{
        echo '<input type="text" name="analysis" id="analysis" rows="" cols="" style="width:100%;font-size:11px;height:35px;" value="0" readonly></input>';
    }
}
?>