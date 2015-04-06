<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container-fluid">
    <div class="row-8">
        <?php $user = Sentry::getUser();?>
        @if($user)
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dokuz Eylül Ders Sistemi</a>
                </div>


                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        @if($user->hasAccess('admin'))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dersler <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>{{link_to('lecture/list/', 'Listele', $attributes = array(), $secure = null);}}</li>
                                <li>{{link_to('lecture/create/', 'Ekle', $attributes = array(), $secure = null);}}</li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Kat ve Sınıflar <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>{{link_to('classroom/list/', 'Listele', $attributes = array(), $secure = null);}}</li>
                                <li>{{link_to('classroom/create/', 'Ekle', $attributes = array(), $secure = null);}}</li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Öğrenci ve Öğretim Görevlileri <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>{{link_to('user/list/', 'Listele', $attributes = array(), $secure = null);}}</li>
                                <li>{{link_to('user/create/', 'Ekle', $attributes = array(), $secure = null);}}</li>
                            </ul>
                        </li>
                        @endif
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Kullanıcı işlemleri - çıkış<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>{{link_to('logout', 'Çıkış', $attributes = array(), $secure = null);}}</li>
                            </ul>
                        </li>


                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        @endif
        @yield('content')
    </div>
</div>
</body>
</html>