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
    'users'         =>   array(1,2,3,4,5)
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
}
?>