<?php
/**
 * connect form database
 */

 function connect(){
    return new mysqli( HOST, USER, PASS, DB );
 }

/**
 *alert function
 */
function alert($msg , $type = 'danger'){
   return "<p class=\"alert alert-{$type}\"> {$msg} <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times</button> </p>";
}
/**
 * Email Validate function
 */
function emailcheck($email){
   if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
      return true;
   }else{
      return false;
}
}
/**
 * old function
 */

 function old($key){
   return $_POST[$key] ?? '';
 }

 function clear(){
    return $_POST = '';
 }

 /**
  * photo Upload function?
  */

  function fileupload( $file , $path ='/' ){
     //file info?
      $file_name = $file['name'] ?? '';
      $file_tmp_name = $file['tmp_name'];
      move_uploaded_file($file_tmp_name, $path . $file_name);
      return $file_name ?? '';
  }

?>