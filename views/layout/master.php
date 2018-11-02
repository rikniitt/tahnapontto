<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/assets/img/favicon.ico">

        <title>Tahnapönttö</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.13.1/build/styles/default.min.css">
        <link href="<?php echo $this->urlhelp->to('/assets/css/style.css'); ?>" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation" class=""><a href="<?php echo $this->urlhelp->to('/'); ?>">Etusivu</a></li>
                        <li role="presentation"><a href="<?php echo $this->urlhelp->to('/add'); ?>">Lisää</a></li>
                        <li role="presentation"><a href="<?php echo $this->urlhelp->to('/list'); ?>">Selaa</a></li>
                    </ul>
                </nav>
                <h3 class="text-muted">Tahnapönttö</h3>
            </div>

            <?php $this->yieldView(); ?>

            <footer class="footer">
                <p>&copy; <?php echo date('Y');?> Firma Ab.</p>
            </footer>

        </div> <!-- /container -->


        <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.13.1/build/highlight.min.js"></script>

        <script>
            hljs.initHighlightingOnLoad();
        </script>
    </body>
</html>
