/**
 * Created by jintian on 15/11/9.
 */


function createXMLHttpRequest() {
    var xmlHttp;
    if (window.ActiveXObject) {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    else if (window.XMLHttpRequest) {
        xmlHttp = new XMLHttpRequest();
    }
    return xmlHttp;
}


function sendJSON(req_obj, handle_func ){

    //使用JSON脚本库把JavaScript对象转换成Json字符串
    var JSON_str = JSON.stringify(req_obj);
    console.log("object as JSON:\n " + JSON_str);

    var url = "do.php" ;

    var ajax_obj = createXMLHttpRequest();
    ajax_obj.open("POST", url, true);


    ajax_obj.onreadystatechange = function (){
                if(ajax_obj.readyState == 4){
                    if(ajax_obj.status == 200) {
                        handle_func(ajax_obj.responseText);
                    }
                }else{
                    alert("Error!");
                }
            };


    ajax_obj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax_obj.send(JSON_str);
}




//创建对象
function makePackage(req_data) {
    var package_obj = {};
    package_obj.target_name = "RWJson";
    package_obj.req_data = req_data;
    package_obj.encrypt_key = "abc";

    return package_obj;
}

