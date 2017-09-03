<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Lingerie Store Css Template</title>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<script type="text/javascript" src="js/unitpngfix.js"></script>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
<script   src="https://code.jquery.com/jquery-3.1.1.js"   integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="   crossorigin="anonymous"></script>

</head>
<body>

    <div id="header">
    <div class="logo">
    <a href="index.html"><img src="{{asset('img/logo.png')}}"" width="221" height="91" alt="" title="" border="0" /></a>
    </div>
    
            <div id="menu_tab">                                     
                    <ul class="menu">
                    <li class="divider"></li>                                                                               
                         <li><a href="index.html" class="nav_selected"> home </a></li>                         
                         <li><a href="about.html" class="nav"> about us</a></li>
                         <li><a href="" class="nav"> most wanted</a></li>
                         <li><a href="" class="nav"> how to order</a></li>
                         <li><a href="{{URL::to('login')}}" class="nav"> Iniciar Sesion </a></li>
                    </ul>
            </div>
            
            <div class="search_tab">
            <input type="text" class="search" value="search" />
            <input type="image" src="{{asset('img/search.gif')}}" class="search_bt" />
            </div>
    
    
    </div>

<div id="main_container">


    
 
            
            
    <div id="main_content">
    
      <div class="left_sidebar">
         
        <div id="left_menu">
                 <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            @yield('barraizquierda')
          </ul>
        </section>
        <!-- /.sidebar --></aside>  
        </div>

      <div>
           
      </div>        
        <div class="submenu_pic">
        <img src="{{asset('img/submenu_pic.gif')}}" alt="" title="" />
        </div>
        
        
     </div>
        
        
        <div id="center_content">
        
@yield('contenido')       
        </div> 


 

        
        
        </div>
    

   <div class="clear"></div> 
           
    <div id="footer">
    <div class="left_foter"><img src="{{asset('img/footer_logo.gif')}}" alt="" title="" /></div>

    </div>
    </div>
    
    </div>

</div>
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
</body>
</html>