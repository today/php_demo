
<?


	$json_string = file_get_contents("php://input");  
    if(ini_get("magic_quotes_gpc")=="1")  
    {  
        $json_string=stripslashes($json_string);  
    }
    $input_obj = json_decode($json_string);

    $req_data = $input_obj->req_data;


    $action = $req_data->action;
    $target = $req_data->target;
    $field_data = $req_data->field_data;


    if (strcmp("write", $action ) == 0 ){

    	$json_str = json_encode($field_data, JSON_UNESCAPED_UNICODE);
	    // 写文件
	    $filename = "data/" . $target . ".json";
	    $myfile = fopen( $filename, "w") or die("Unable to open file!");
		
		fwrite($myfile, $json_str);
		
		fclose($myfile);
		echo var_dump("Write JSON Success."); 
    }
    elseif(strcmp("read", $action ) == 0 ){
    	$filename2 = "data/" . $target . ".json";
	    $myfile2 = fopen( $filename2, "r") or die("Unable to open file!");
		
		$json_str = fread($myfile2,filesize($filename2));
		
		fclose($myfile2);
		
    	echo $json_str; 
    }
    else{
    	echo var_dump("Parameter Invalid. " . $action );
    }
    



     

?>
