<?php
require ("core/common.php");
include ("core/user_functions.php");
include ("core/upload.php");

if (empty($_SESSION['user']))
    {
    header("Location: login.php");
    die("Redirecting to login.php");
    }

    $utente = htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');
?> 
<!DOCTYPE html>
<html lang="en" class="app">
<head>  
  <meta charset="utf-8" />
  <title>NR STATION</title>
  <meta name="description" content="nr station, webradio, iisreggio" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="js/jPlayer/jplayer.flat.css" type="text/css" />
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />  
    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body class="">
<?php include ("core/upload.php"); ?>
 <!-- carica -->
  <div class="modal fade" id="carica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Carica</h4>
            </div>
            <div class="modal-body">
            <?php include ("core/upload.php"); ?>
              <form action="index.php" method="post" enctype="multipart/form-data" data-validate="parsley">
                  <div class="form-group">
                    <label>Titolo</label>
                    <input type="text" name ="titolo" id="titolo" class="form-control" data-required="true">                        
                  </div>
                  <div class="form-group">
                    <label>Artista</label>
                    <input type="text" name="artista" id="artista" class="form-control" data-required="true">                        
                  </div>
                  <br/>
                  Scegli il file da caricare: &nbsp; &nbsp;
                  <label class="btn btn-primary" for="fileToUpload">
                  <i class="fa fa-cloud-upload text"></i>
                  <input name="fileToUpload" id="fileToUpload" type="file" style="display:none;">
                  Carica
                  </label>
                  <div class="modal-footer">
                    <button type="submit" name="upload" class="btn btn-success btn-s-xs" onClick="return controllaNome()">Invia</button>
                  </div>
              </form>
            </div>
        </div>
      </div>
  </div>
 <!-- / carica -->  
  <section class="vbox">
    <header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
      <div class="navbar-header aside bg-primary nav-xs">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="icon-list"></i>
        </a>
        <a href="index.php" class="navbar-brand text-lt">
          <i class="icon-earphones"></i>
          <img src="images/logo.png" alt="." class="hide">
          <span class="hidden-nav-xs m-l-sm">Musik</span>
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
          <i class="icon-settings"></i>
        </a>
      </div>      
      <ul class="nav navbar-nav hidden-xs">
        <li>
          <a href="#nav,.navbar-header" data-toggle="class:nav-xs,nav-xs" class="text-muted">
            <i class="fa fa-indent text"></i>
            <i class="fa fa-dedent text-active"></i>
          </a>
        </li>
      </ul>
      <form class="navbar-form navbar-left input-s-lg m-t m-l-n-xs hidden-xs" role="search">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-sm bg-white btn-icon rounded"><i class="fa fa-search"></i></button>
            </span>
            <input type="text" class="form-control input-sm no-border rounded" placeholder="Search songs, albums...">
          </div>
        </div>
      </form>
      <div class="navbar-right ">
        <ul class="nav navbar-nav m-n hidden-xs nav-user user">
          <li class="hidden-xs">
            <a href="#" class="dropdown-toggle lt" data-toggle="dropdown">
              <i class="icon-bell"></i>
              <span class="badge badge-sm up bg-danger count">2</span>
            </a>
            <section class="dropdown-menu aside-xl animated fadeInUp">
              <section class="panel bg-white">
                <div class="panel-heading b-light bg-light">
                  <strong>You have <span class="count">2</span> notifications</strong>
                </div>
                <div class="list-group list-group-alt">
                  <a href="#" class="media list-group-item">
                    <span class="pull-left thumb-sm">
                      <img src="images/a0.png" alt="..." class="img-circle">
                    </span>
                    <span class="media-body block m-b-none">
                      Use awesome animate.css<br>
                      <small class="text-muted">10 minutes ago</small>
                    </span>
                  </a>
                  <a href="#" class="media list-group-item">
                    <span class="media-body block m-b-none">
                      1.0 initial released<br>
                      <small class="text-muted">1 hour ago</small>
                    </span>
                  </a>
                </div>
                <div class="panel-footer text-sm">
                  <a href="#" class="pull-right"><i class="fa fa-cog"></i></a>
                  <a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a>
                </div>
              </section>
            </section>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">
              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                <img src="images/a0.png" alt="...">
              </span>
              <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu animated fadeInRight">            
              <li>
                <a href="profile.php">Profilo</a>
              </li>
              <li>
                <a href="docs.html">Guida</a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="logout.php">Esci</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>      
    </header>
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-black dk nav-xs aside hidden-print" id="nav">          
          <section class="vbox">
            <section class="w-f-md scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">                
                <!-- nav -->                 
                <nav class="nav-primary hidden-xs">
                  <ul class="nav bg clearfix" data-ride="collapse">
                    <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
                      Menu
                    </li>
                    <li>
                      <a href="index.php">
                        <i class="icon-disc icon text-success"></i>
                        <span class="font-bold">Home</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="fa fa-angle-left text"></i>
                          <i class="fa fa-angle-down text-active"></i>
                        </span>
                        <i class="icon-music-tone-alt icon text-info">
                        </i>
                        <span class="font-bold">Playlist</span>
                      </a>
                      <ul class="nav dk text-sm">
                        <li >
                          <a href="listen.php" class="auto">                                                        
                            <i class="fa fa-angle-right text-xs"></i>
                            <span>Le mie playlist</span>
                          </a>
                        </li>
                        <li >
                          <a href="weekly.php" class="auto">                                                                                  
                            <i class="fa fa-angle-right text-xs"></i>
                            <span>Più votate</span>
                          </a>
                        </li>
                        <li >
                          <a href="new.php" class="auto">                                                        
                            <i class="fa fa-angle-right text-xs"></i>
                            <span>Nuove</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <a href="#" data-toggle="modal" data-target="#carica">
                        <i class=" icon-cloud-upload icon text-success"></i>
                        <span class="font-bold">Carica</span>
                      </a>
                    </li>
                    <li>
                      <a href="events.php">
                        <i class="icon-list icon  text-info-dker"></i>
                        <span class="font-bold">Eventi</span>
                      </a>
                    </li>
                    <li class="m-b hidden-nav-xs"></li>
                  </ul>
                </nav>
                <!-- / nav -->
              </div>
            </section>            
            <footer class="footer hidden-xs no-padder text-center-nav-xs">
              <div class="bg hidden-xs ">
                  <div class="dropdown dropup wrapper-sm clearfix">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="thumb-sm avatar pull-left m-l-xs">                        
                        <img src="images/a3.png" class="dker" alt="...">
                        <i class="on b-black"></i>
                      </span>
                      <span class="hidden-nav-xs clear">
                        <span class="block m-l">
                          <strong class="font-bold text-lt"><?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?></strong> 
                          <b class="caret"></b>
                        </span>
                      </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight aside text-left">                      
                      <li>
                        <a href="profile.php">Profilo</a>
                      </li>
                      <li>
                        <a href="docs.html">Guida</a>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <a href="logout.php" data-toggle="ajaxModal" >Esci</a>
                      </li>
                    </ul>
                  </div>
                </div>            
            </footer>
          </section>
        </aside>
        <!-- /.aside -->
        <section id="content">
         <section class="vbox">
          <section class="scrollable">
            <div id="masonry" class="pos-rlt animated fadeInUpBig">
              <div class="item">
                <div class="carousel slide auto" data-interval="3000">
                  <div class="carousel-inner">
                    <div class="item active">
                      <div class="item-overlay opacity animated fadeInDown wrapper bg-info">
                      </div>
                      <div class="bottom wrapper bg-info gd">
                        <div class="m-t m-b"><a href="#" class="b-b b-danger h2 text-u-c text-lt font-bold">Teideal</a></div>
                        <p class="hidden-xs">Morbi nec nunc condimentum, egestas dui nec, fermentum diam. Vivamus vel tincidunt libero, vitae elementum ligula</p>
                      </div>
                      <a href="#"><img src="images/m22.jpg" alt="" class="img-full"></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="carousel slide auto" data-interval="3000">
                  <div class="carousel-inner">
                    <div class="item active">
                      <div class="item-overlay opacity animated fadeInDown wrapper bg-info">
                      </div>
                      <div class="bottom wrapper bg-info gd">
                        <div class="m-t m-b"><a href="#" class="b-b b-danger h2 text-u-c text-lt font-bold">Teideal</a></div>
                        <p class="hidden-xs">Morbi nec nunc condimentum, egestas dui nec, fermentum diam. Vivamus vel tincidunt libero, vitae elementum ligula</p>
                      </div>
                      <a href="#"><img src="images/m22.jpg" alt="" class="img-full"></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="carousel slide auto" data-interval="3000">
                  <div class="carousel-inner">
                    <div class="item active">
                      <div class="item-overlay opacity animated fadeInDown wrapper bg-info">
                      </div>
                      <div class="bottom wrapper bg-info gd">
                        <div class="m-t m-b"><a href="#" class="b-b b-danger h2 text-u-c text-lt font-bold">Teideal</a></div>
                        <p class="hidden-xs">Morbi nec nunc condimentum, egestas dui nec, fermentum diam. Vivamus vel tincidunt libero, vitae elementum ligula</p>
                      </div>
                      <a href="#"><img src="images/m22.jpg" alt="" class="img-full"></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="carousel slide auto" data-interval="3000">
                  <div class="carousel-inner">
                    <div class="item active">
                      <div class="item-overlay opacity animated fadeInDown wrapper bg-info">
                      </div>
                      <div class="bottom wrapper bg-info gd">
                        <div class="m-t m-b"><a href="#" class="b-b b-danger h2 text-u-c text-lt font-bold">Teideal</a></div>
                        <p class="hidden-xs">Morbi nec nunc condimentum, egestas dui nec, fermentum diam. Vivamus vel tincidunt libero, vitae elementum ligula</p>
                      </div>
                      <a href="#"><img src="images/m22.jpg" alt="" class="img-full"></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="carousel slide auto" data-interval="3000">
                  <div class="carousel-inner">
                    <div class="item active">
                      <div class="item-overlay opacity animated fadeInDown wrapper bg-info">
                      </div>
                      <div class="bottom wrapper bg-info gd">
                        <div class="m-t m-b"><a href="#" class="b-b b-danger h2 text-u-c text-lt font-bold">Teideal</a></div>
                        <p class="hidden-xs">Morbi nec nunc condimentum, egestas dui nec, fermentum diam. Vivamus vel tincidunt libero, vitae elementum ligula</p>
                      </div>
                      <a href="#"><img src="images/m22.jpg" alt="" class="img-full"></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="carousel slide auto" data-interval="3000">
                  <div class="carousel-inner">
                    <div class="item active">
                      <div class="item-overlay opacity animated fadeInDown wrapper bg-info">
                      </div>
                      <div class="bottom wrapper bg-info gd">
                        <div class="m-t m-b"><a href="#" class="b-b b-danger h2 text-u-c text-lt font-bold">Teideal</a></div>
                        <p class="hidden-xs">Morbi nec nunc condimentum, egestas dui nec, fermentum diam. Vivamus vel tincidunt libero, vitae elementum ligula</p>
                      </div>
                      <a href="#"><img src="images/m22.jpg" alt="" class="img-full"></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="carousel slide auto" data-interval="3000">
                  <div class="carousel-inner">
                    <div class="item active">
                      <div class="item-overlay opacity animated fadeInDown wrapper bg-info">
                      </div>
                      <div class="bottom wrapper bg-info gd">
                        <div class="m-t m-b"><a href="#" class="b-b b-danger h2 text-u-c text-lt font-bold">Teideal</a></div>
                        <p class="hidden-xs">Morbi nec nunc condimentum, egestas dui nec, fermentum diam. Vivamus vel tincidunt libero, vitae elementum ligula</p>
                      </div>
                      <a href="#"><img src="images/m22.jpg" alt="" class="img-full"></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="carousel slide auto" data-interval="3000">
                  <div class="carousel-inner">
                    <div class="item active">
                      <div class="item-overlay opacity animated fadeInDown wrapper bg-info">
                      </div>
                      <div class="bottom wrapper bg-info gd">
                        <div class="m-t m-b"><a href="#" class="b-b b-danger h2 text-u-c text-lt font-bold">Teideal</a></div>
                        <p class="hidden-xs">Morbi nec nunc condimentum, egestas dui nec, fermentum diam. Vivamus vel tincidunt libero, vitae elementum ligula</p>
                      </div>
                      <a href="#"><img src="images/m22.jpg" alt="" class="img-full"></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="carousel slide auto" data-interval="3000">
                  <div class="carousel-inner">
                    <div class="item active">
                      <div class="item-overlay opacity animated fadeInDown wrapper bg-info">
                      </div>
                      <div class="bottom wrapper bg-info gd">
                        <div class="m-t m-b"><a href="#" class="b-b b-danger h2 text-u-c text-lt font-bold">Teideal</a></div>
                        <p class="hidden-xs">Morbi nec nunc condimentum, egestas dui nec, fermentum diam. Vivamus vel tincidunt libero, vitae elementum ligula</p>
                      </div>
                      <a href="#"><img src="images/m22.jpg" alt="" class="img-full"></a>
                    </div>
                  </div>
                </div>
              </div>   
            </div>
           </section>
          </section>
         <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
        </section>
      </section>
    </section>    
  </section>
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <!-- parsley -->
  <script src="js/parsley/parsley.min.js"></script>
  <script src="js/parsley/parsley.extend.js"></script>
  <!-- namecheck -->
  <script type="text/javascript" src="js/namecheck.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>  
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="js/masonry/tiles.min.js"></script>
  <script src="js/masonry/demo.js"></script>
  <script src="js/app.plugin.js"></script>
  <script type="text/javascript" src="js/jPlayer/jquery.jplayer.min.js"></script>
  <script type="text/javascript" src="js/jPlayer/add-on/jplayer.playlist.min.js"></script>
  <script type="text/javascript" src="js/jPlayer/demo.js"></script>
</body>
</html>