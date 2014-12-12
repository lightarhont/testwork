<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="/favicon.gif" type="image/vnd.microsoft.icon" />
<title><?PHP echo $this->_('test_work'); ?>::<?PHP echo $title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<base href="<?PHP echo $base; ?>">
<?PHP echo $css; ?>
<script type="text/javascript" src="/public/lib/jquery/jquery-1.8.2.min.js"> </script>
<?PHP
if(isset($jslib)):
    echo $jslib;
endif;
if(isset($jscustom)):
    echo '<script>';
    echo $jscustom;
    echo '</script>';
endif;
?>
</head>
<body>
<div class="lang"><a href="/en/<?PHP echo $httppath; ?>">ENG</a><a href="/ru/<?PHP echo $httppath; ?>">РУС</a></div>
 <? echo $content; ?>
</body>
</html>