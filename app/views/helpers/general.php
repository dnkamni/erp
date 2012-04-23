<?php 
class GeneralHelper extends Helper
{

    
  
    
    // get Dogs fields as a dropdown in searching in admin
    function getEmailTemplateFields() {
	$fieldsArray = array();
	$fieldsArray[""]   		= "--- Select ---";
	$fieldsArray["EmailTemplate.name"] 	= "Name";
	$fieldsArray["EmailTemplate.subject"] 	= "Subject";
	return $fieldsArray;
    }
    
    
    
    // get Category List as a dropdown in Add Product in admin
    function addCategoryList($id=null) {
	
	    $catArray = array('0' => 'No Parent');
	    App::import("Model","Category");
	    $this->Category=& new Category();
	
	    $conditions = array('parent_id' => '0');
	    $category =  $this->Category->find('all', array('fields'=>array('Category.id','Category.title'),'conditions' => $conditions,"order" => 'Category.title asc'));
	    foreach($category as $cat){ 
		$catArray[$cat['Category']['id']] = $cat['Category']['title'];
	    }
	    return $catArray;
    }

    // get Category List as a dropdown in Add Product in admin
    function getCategoryList() {
	
	    $catArray = array();	    
	    App::import("Model","Category");
	    $this->Category=& new Category();
	    $category =  $this->Category->find('all', 
		array(
			'fields'   =>array('Category.id','Category.title'),
			'conditions'=> array('status' => '1','is_deleted'=>'0','parent_id' => '0'),
			'order'     => 'Category.title ASC'
		)
	    );
	    foreach($category as $cat){ 
		$catArray[$cat['Category']['id']] = ucwords($cat['Category']['title']);
	    }
	    return $catArray;
    }
    
    // get countries List as a dropdown in admin
    function getcountries() {
	
	    $cntArray = array();
	    $cntArray [""]  = "--- Select ---";
	    App::import("Model","Country");
	    $this->Country=& new Country();
	    $country=  $this->Country->find('all', array('fields'=>array('Country.id','Country.country_name')));
	    
	    foreach($country as $cat){ 
		$cntArray[$cat['Country']['id']] = $cat['Country']['country_name'];
	    }	    
	    return $cntArray;
    }
    
    // get static pages fields as a dropdown in searching in admin @neema
    function getPagesFields() {
	$fieldsArray = array();
	$fieldsArray[""]   		= "--- Select ---";
	$fieldsArray["StaticPage.title"] 	= "Title";
	$fieldsArray["StaticPage.content"] 	= "Content";
	$fieldsArray["StaticPage.slug"] 	= "Slug";
	$fieldsArray["StaticPage.created"] 	= "Created On";
	return $fieldsArray;
    }
    
    
    // get Customer List as a dropdown in Add/Edit Dog in admin
    function getUserList($uid=null) {
	    $supArray = array(''=>'---- Select Customer ----');
	    App::import("Model","User");
	    $this->User=& new User();
	    if($uid!='') {
		$conditions = array("User.type in ('C') and User.status='1' and User.id=".$uid);
	    }else{
		$conditions = array("User.type in ('C') and User.status='1'");		
	    }

	    $supplier =  $this->User->find('all', array('fields'=>array('User.id','User.first_name','User.last_name'),'conditions' => $conditions,'order'=>'User.first_name'));
	    foreach($supplier as $cat){
		$supArray[$cat['User']['id']] = ucwords($cat['User']['first_name']." ".$cat['User']['last_name']);
	    }
	    return $supArray;
    }
 
           
    //	This function is called to get links of header and footer
    function getfooterlink($pos=null) {
	    App::import("Model","StaticPage");
	    $this->StaticPage=& new StaticPage();
	    $link= $this->StaticPage->find('all', array(
	       'conditions' => array('StaticPage.status' => '1','StaticPage.id'=>array('1','3','4','5','6','2')),
	       'fields' => array('StaticPage.id', 'StaticPage.title'),
		'order'=>"field(id,'1','3','4','5','6','2')"
	       )
	    ); 
	return $link;
    }

    //	This function is called to other links of header and footer
    function getotherfooterlink($pos=null) {
	    App::import("Model","StaticPage");
	    $this->StaticPage=& new StaticPage();
	    $link= $this->StaticPage->find('all', array(
	       'conditions' => array('StaticPage.status' => '1','StaticPage.id NOT'=>array('1','3','4','5','6','2')),
	       'fields' => array('StaticPage.id', 'StaticPage.title'),
		'order'=>"title ASC"
	       )
	    ); 
	return $link;
    }

    //	This function is called to sort any associated field
    function getsortlink($name = null, $sort = null, $passesArgs = array(),$urlArray = array()) {
	App::import('Helper','Html');
	$html = new HtmlHelper();
	return $html->link($name, array_merge(array(
		'controller' => $this->params['controller'],
		'action' => $this->params['action'],
		'page' => (!empty($passesArgs['page'])?$passesArgs['page']:"1"),
		'sort' => $sort,
		'direction' => (empty($passesArgs['direction']) || $passesArgs['direction'] == 'asc')?'desc' : 'asc',
		'limit' => (!empty($passesArgs['limit'])?$passesArgs['limit']:RECORDS_PER_PAGE)
	),$urlArray));
    }

    //	This function is called to get links of logged in users.
    function getLinkPermission() {
	    
	    App::import("Model","User");
	    $this->User=& new User();
	    
	    $id=$_SESSION['SESSION_ADMIN']['id'];
	    $type=$_SESSION['SESSION_ADMIN']['type'];
	    
	    $this->User->expects( array('AdminPrevilege'));
	    $data = $this->User->find('first',
		array(
			'conditions'=>array('User.id'=>$id, 'type'=>$type),
			'fields' => array('User.id',
						'User.first_name',
						'User.last_name',
						'AdminPrevilege.*'
						)
		)
	   );
			
	return $data;
    }

  /**
    * @Date: 18-Dec-2010
    * @Method : paymentMethods
    * @Purpose: Function to show weights in dropdown menu.
    * @Param: none
    * @Return: none
    **/
	
    function paymentMethods(){
	$data = array(
		"" => " Select ",
		"check" => "Check",
		"credit card" => "Credit Card",
		"cash" => "Cash",
	);
	return $data;
    }
	
	
	
	 // Retrive all productcolors
   function getColors(){
	App::import('Model','ProductsColor');
	$this->ProductsColor = new ProductsColor;
	$result = $this->ProductsColor->find('list', array(
		'conditions'=> array('status'=>'1'),
		'fields'    => array('id','color_name'),
		'order'	    => 'color_name ASC'
	));
	$result = array(''=>'--- Please Select ---') + $result;
	return $result;
   }
   
    // Retrive all productsizes
   function getSizes(){
	App::import('Model','ProductsSize');
	$this->ProductsSize = new ProductsSize;
	$result = $this->ProductsSize->find('list', array(
		'conditions'=> array('status'=>'1'),
		'fields'    => array('id','size_name'),
		'order'	    => 'size_name ASC'
	));
	$result = array(''=>'--- Please Select ---') + $result;
	return $result;
   }
   
    // Retrive all productcolors
   function getBrands(){
	App::import('Model','ProductsBrand');
	$this->ProductsBrand = new ProductsBrand;
	$result = $this->ProductsBrand->find('list', array(
		'conditions'=> array('status'=>'1'),
		'fields'    => array('id','content_title'),
		'order'	    => 'content_title ASC'
	));
	$result = array(''=>'--- Please Select ---') + $result;
	return $result;
   }
   
    // Retrive all productcolors
   function getTypes(){
	App::import('Model','ProductsType');
	$this->ProductsType = new ProductsType;
	$result = $this->ProductsType->find('list', array(
		'conditions'=> array('status'=>'1'),
		'fields'    => array('id','name'),
		'order'	    => 'name ASC'
	));
	$result = array(''=>'--- Please Select ---') + $result;
	return $result;
   }
	
	//to display all products
   function getproducts() {
			App::import("Model","Product");
			$this->Product = new Product();
            $product_name = array(
				  'conditions' => array('Product.status' =>'1' ,'product.released' =>'1'
				   ),
				   'fields' => array('id','model')
				   );
			$product = $this->Product->find('list',$product_name);
			return $product;
			
	}
	
	//Retrive all productfeatures
	 function getfeatures() {
			App::import("Model","ProductsFeature");
			$this->ProductsFeature = new ProductsFeature();
           	$result = $this->ProductsFeature->find('list', array(
				'conditions'=> array('status'=>'1'),
				'fields'    => array('id','feature'),
				'order'	    => 'feature ASC'
	        ));
	 $result = array(''=>'--- Please Select ---') + $result;
	 return $result;
			
	}



	//to display all static pages
   function pages() {
			App::import("Model","StaticPage");
			$this->StaticPage = new StaticPage();
             $name = array(
				  'conditions' => array(
						'StaticPage.status' =>'1'
				   ),
				   'fields' => array('slug','title')
				   );
				   //print_r($city_name);
			$page = $this->StaticPage->find('list', $name);
			
			return $page;
	}

   // Retrive all productcolors
   function getSeries(){
	App::import('Model','Series');
  	$this->Series = new Series;
	$this->Series->expects(array('ProductsBrand'));
	$result = $this->Series->find('all', array(
		'conditions'=> array('Series.status'=>'1'),
		'fields'    => array('Series.id','Series.name','ProductsBrand.content_title'),
		'order'	    => 'Series.name ASC'
	));
    $series=array();
	$series="";
	foreach($result as $value){
    $series[$value['Series']['id']]="Series ".$value['Series']['name']." - ".$value['ProductsBrand']['content_title'];
     }
    $result = array(''=>' Select Series ') + $series;
	
	return $result;
   }
   
   
   //to display all product colors
   function getColorNames($color_id) {
			App::import("Model","ProductsColor");
			$this->ProductsColor = new ProductsColor();
		    $result = $this->ProductsColor->find('list', array(
	    	'conditions'=> array('ProductsColor.status'=>'1','ProductsColor.id'=>explode(",",$color_id)),
		    'fields'    => array('ProductsColor.id','ProductsColor.html_code')
	        ));
			return $result;
	}

   //Retrive all picture Quality of product
	function getPicture(){
	App::import('Model','ProductsPicture');
	$this->ProductsPicture= new ProductsPicture;
	$result = $this->ProductsPicture->find('all', array(
		'conditions'=> array('status'=>'1'),
		'fields'    => array('id','width','height')
	));
    $pic=array();
	$pic="";
	foreach($result as $value){
    $pic[$value['ProductsPicture']['id']]=$value['ProductsPicture']['width'].'*'.$value['ProductsPicture']['height'];
     }
    $result = array(''=>'--- Please Select ---') + $pic;
	return $result;
	
   }
   
   /**
    * @Date: 30-Nov-2011
    * @Method : Nature_of_enquiry
    * @Purpose: Function to show type of enquiry.
    * @Param: none
    * @Return: none
    **/
	
    function nature_of_enquiry(){
	$data = array(
		"general"      => " General ",
		"products"     => " Products",
		"services"     => " Services",
		"partnerships" => " Partnerships",
		"company"      => " Company",
	);
	return $data;
    }

	 //to display all models of particular series
   function getmodels($series_id) {
			App::import("Model","Product");
			$this->Product = new Product();
		    $result = $this->Product->find('list', array(
	    	'conditions'=> array('Product.status'=>'1','Product.series_id'=>$series_id),
		    'fields'    => array('Product.id','Product.model')
	        ));
			return $result;
	}
	
	 // Retrive all product model name
	function getModel(){
	App::import("model","Product");
	$this->Product= new Product();
	$result= $this->Product->find('list', array(
	'conditions'=> array('status'=>'1'),
	'fields'    => array('id','model'),
	'order'     => 'model ASC'
		 ));
	
	$result=array(''=>'--- Please select ---')+$result;
	return $result;
	}
	//to display all product sales features in product detail page
   function getProductFeatures($feature_id) {
			App::import("Model","ProductsFeature");
			$this->ProductsFeature = new ProductsFeature();
		    $result = $this->ProductsFeature->find('list', array(
	    	'conditions'=> array('ProductsFeature.status'=>'1','ProductsFeature.id'=>explode(",",$feature_id)),
		    'fields'    => array('ProductsFeature.id','ProductsFeature.image')
	        ));
			return $result;
	}
	  //Retrieve category for news
    function getCategory(){
	App::import('Model','NewsCategory');
	$this->NewsCategory= new NewsCategory;
	$result= $this->NewsCategory->find('list',array(
	'conditions'=>array('status'=>'1'),
	'fields'=>array('id','cat'),
	'order'=>'cat ASC'
	));
	$result= array(''=>'---Please Select---') + $result;
	return $result;
	}
	//display Question type in drop down
	function getQues(){
	$ques=array(
	''=>'--Select--',
	'Our Company'=>'Our Company',
	'Product Enquiry'=> 'Product Enquiry',
	'Our Services'=>'Our Services',
	'Brands'=>'Brands'
	);
	return $ques;
	}
}
?>