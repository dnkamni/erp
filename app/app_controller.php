<?php
class AppController extends Controller {

function checkUserSession(){
		$front_dont_apply_on  =   array("login", "logout","forgot_password","register","activate_account");
		$admin_dont_apply_on  =   array("admin_login", "admin_logout","admin_forgot_password");
    $action               =   $this->params["action"];
    $controller           =   $this->params["controller"];

    //Defining Permissions (Conroller Level Settings)
    $permission_arr =    array(
    'credentials'   =>   array(1,2),
    'users'         =>   array(1,2,3,4,5),
    'news'          =>   array(1),
	  'employees'     =>   array(1,2)
    );
		
		// If User, check User session
		if(!empty($this->params['prefix']) && $this->params['prefix'] == "admin"){ 
			$this->layout    = "layout_admin";
			$this->pageTitle = "Admin Panel";
			$loggedInUser    = $this->Session->read("SESSION_ADMIN");
			
      //finding role array
      $role            = explode(',',$loggedInUser[2]);
      
      //finding if user has access on controller level
      $permit = array_intersect($permission_arr[$controller],$role);
      
			if(empty($loggedInUser) && !in_array($action,$admin_dont_apply_on)){ //if not logged in. 
				$this->redirect("/admin/users/login");
			} else if(count($permit) == 0  && !in_array($action,$admin_dont_apply_on) && $action !='admin_dashboard'){ //Redirecting if user is unauthorized at module level 
        //setting Error Message
        $this->Session->setFlash('<table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr>
        <td class="red-left"> Sorry, You are not authorized to access Credentials section of NSPL ERP. </td>
        <td class="red-right"><a class="close-blue"><img src="../../images/table/icon_close_red.gif"   alt="" /></a></td>
        </tr>
        </table>');
				$this->redirect("/admin/users/dashboard");
			}
		}else{ // Check User session
			$this->layout = "layout_front";
			$loggedInUser = $this->Session->read("SESSION_USER");
			if(empty($loggedInUser) && !in_array($action,$front_dont_apply_on)){ 
				$this->redirect("/users/login");
			}
		}
}

#_________________________________________________________________________#


    /**
    * @Date: 30-Apr-2012
    * @Method : uploadDocs
    * @Purpose: This function is used to upload docs
    * @Param: $id
    * @Return: none
    **/
	
	function uploadDocs($id = null){
		if (!empty($_FILES)) {
			$destination = realpath('../../app/webroot/img/all_docs/'.$this->params['controller']). DS;					
			$file = $_FILES['uploadfile'];
			$filename = $id.'_'.$file['name'];
			//$filename = $file['name'];
			$size=$_FILES['uploadfile']['size'];
			if($size>0){
				
				//if(preg_match("/pdf|xls|xlsx|doc|docx|ppt|txt|gif|jpg|jpeg|png/i",$this->Common->file_extension($file['name'])) > 0){
					$result = $this->Upload->upload($file, $destination, $filename);
					echo "success";
					die;
				//}
			}
		}
	}
	
	function delete_doc($val = null){
		if (!empty($val)) {
			$value = base64_decode($val);
			$id = preg_replace("/^([0-9]+)_(.*)/i",'$1',$value);
			$destination = realpath('../../app/webroot/img/all_docs/'.$this->params['controller']). DS;					
			@unlink($destination.$value);
			//$this->redirect(array('controller'=>$this->params['controller'],'action'=>'add', $id), array('admin'=>true));
			$this->redirect('/admin/'.$this->params['controller'].'/add/'.$id);
		}
	}
}
?>