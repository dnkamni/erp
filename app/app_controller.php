<?php
class AppController extends Controller {

function checkUserSession(){
		$front_dont_apply_on =   array("login", "logout","forgot_password","register","activate_account");
		$admin_dont_apply_on =   array("admin_login", "admin_logout","admin_forgot_password");
        $action        =   $this->params["action"];
		
		// If User, check User session
		if(!empty($this->params['prefix']) && $this->params['prefix'] == "admin"){
			$this->layout = "layout_admin";
			$this->pageTitle = "Admin Panel";
			$loggedInUser = $this->Session->read("SESSION_ADMIN");
			if(empty($loggedInUser) && !in_array($action,$admin_dont_apply_on)){ 
				$this->redirect("/admin/users/login");
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