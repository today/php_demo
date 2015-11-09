
<?


	$json_string = file_get_contents("php://input");  
    if(ini_get("magic_quotes_gpc")=="1")  
    {  
        $json_string=stripslashes($json_string);  
    }
    $input_obj = json_decode($json_string);  

    $package_data = $input_obj->package_data;

    $action = $package_data->action;
    $target = $package_data->target;
    $req_data = $package_data->req_data;


    if (strcmp("write", $action ) == 0 ){

    	$json_req = json_encode($req_data, JSON_UNESCAPED_UNICODE);
	    // 写文件
	    $filename = "data/" . $target . ".json";
	    $myfile = fopen( $filename, "w") or die("Unable to open file!");
		
		fwrite($myfile, $json_req);
		
		fclose($myfile);
		echo var_dump("Write Success."); 
    }
    elseif(strcmp("read", $action ) == 0 ){
    	$filename2 = "data/" . $target . ".json";
	    $myfile2 = fopen( $filename2, "r") or die("Unable to open file!");
		
		$json_str = fread($myfile2,filesize($filename2));
		
		fclose($myfile2);
		
    	echo $json_str; 
    }
    else{
    	echo var_dump("Parameter Invalid."); 
    }
    



     

?>