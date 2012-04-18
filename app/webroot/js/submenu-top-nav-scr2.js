var ver='3.0.1D'

var m1=new Object

m1.name='m1'

m1.fnm='submenu-top-nav-m2'

if(!window.lastm||window.lastm<1)lastm=1

m1.v17=null

m1.v17Timeout=''

var maxZ=1000

m1.v18

m1.targetFrame

var docLoaded=false

m1.bIncBorder=true

m1.v29=null

m1.v29Str=''

m1.v55=50

m1.scrollStep=10

m1.fadingSteps=2

m1.itemOverDelay=0

m1.transTLO=0

m1.fixSB=0

m1.v21="."

m1.maxlev=2

m1.v22=0

m1.sepH=10

m1.bHlNL=1

m1.showA=1

m1.bVarWidth=0

m1.bShowDel=50

m1.scrDel=0

m1.v23=180

m1.levelOffset=-1

m1.levelOffsety=2

m1.bord=1

m1.vertSpace=3

m1.sep=1

m1.v19=false

m1.bkv=0

m1.rev=0

m1.shs=0

m1.xOff=0

m1.yOff=0

m1.v20=false

m1.cntFrame=""

m1.menuFrame=""

m1.v24=""

m1.mout=true

m1.iconSize=8

m1.closeDelay=1000

m1.tlmOrigBg="#ffffff" //first frame mouseout color//

m1.tlmOrigCol="#5091D5"

m1.v25=false

m1.v52=false

m1.v60=0

m1.v11=false

m1.v10=0

m1.ppLeftPad=5

m1.v54=0

m1.v01=2

m1.tlmHlBg="#AE0000" //first frame mouseover color//

m1.tlmHlCol="White"

m1.borderCol="#F9ECF1"

m1.menuHorizontal=true

m1.scrollHeight=6

m1.attr=new Array("11px",false,false,"#FFFFFF","#0EAA6A","#FFFFFF","verdana,Arial,Helvetica","#484848","#484848","#484848")



m1mn1=new Array

(

"Employees",base_url+"admin/users/list",0,"",""

,"Attendance",base_url+"admin/attendances/list",0,"",""

,"Salary",base_url+"admin/salaries/list",0,"",""

,"leave",base_url+"admin/leaves/list",0,"",""

,"Salaries ",base_url+"admin/salaries/list",0,"",""

,"Appraisals",base_url+"admin/appraisals/list",0,"",""



)



m1mn2=new Array

(

"Transactions",base_url+"admin/transactions/list",0,"",""


)



m1mn3=new Array

(

"Clients",base_url+"admin/clients/list",0,"",""

,"Billing",base_url+"admin/billings/list",0,"",""

,"Leads",base_url+"admin/leads/list",0,"",""

,"Payments",base_url+"admin/payments/list",0,"",""

,"Credentials",base_url+"admin/credentials/list",0,"",""


)



m1mn4=new Array

(



"Contact",base_url+"admin/contacts/list",0,"",""

,"Dispatchs",base_url+"admin/dispatchs/list",0,"",""

,"Inwards",base_url+"admin/inwards/list",0,"",""




)



m1mn5=new Array

(

"Projects ",base_url+"admin/projects/list",0,"",""

,"ProjectUpdate",base_url+"admin/project_updates/list",0,"",""

,"Reviews",base_url+"admin/reviews/list",0,"",""

,"Messages",base_url+"admin/messages/list",0,"",""

,"Documents",base_url+"admin/documents/list",0,"",""







)



m1mn6=new Array

(

"CMS",base_url+"admin/static_pages/list",0,"",""

,"Roles",base_url+"admin/roles/list",0,"",""

,"Portfolio",base_url+"admin/portfolios/list",0,"",""

,"Testimonials",base_url+"admin/testimonials/list",0,"",""

,"News",base_url+"admin/news/list",0,"",""

,"Galleries",base_url+"admin/galleries/list",0,"",""

,"Contact Us","#",0,"",""

)


m1mn7=new Array

(

"Release Notes",base_url+"static_pages/view/release-note",0,"",""

,"Join Us",base_url+"static_pages/view/join",0,"",""

,"Current Openings",base_url+"static_pages/view/currentopenings",0,"",""

,"Fun @ Netset",base_url+"users/gallery",0,"",""

)


absPath=""

if(m1.v19&&!m1.v20){

if(window.location.href.lastIndexOf("\\")>window.location.href.lastIndexOf("/")) {sepCh = "\\" ;} else {sepCh = "/" ;}

absPath=window.location.href.substring(0,window.location.href.lastIndexOf(sepCh)+1)}

m1.v61=0

m1.v02=m1.v23

document.write("<style type='text/css'>\n.m1CL0,.m1CL0:link{text-decoration:none;width:100%;color:white; }\n.m1CL0:visited{color:Black}\n.m1CL0:hover{text-decoration:underline}\n.m1mit{padding-left:15px;padding-right:15px;color:Black; font-family:verdana,Arial,Helvetica; font-size:10px; }\n"+"</"+"style>")

document.write("<script language='JavaScript1.2' src='menu-dom-topnav.js'></"+"script>")

