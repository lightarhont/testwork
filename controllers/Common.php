<?PHP

abstract class Common extends Controller
{ 
  
  protected $base = 'http://test7.ru/';  
  protected $data = array();
  protected $lang = 'ru';
  protected $post = array();
  
  public function before()
  {
    
				session_start();
				
    if(sizeof($_POST) !== 0)
    {
     $this->post = $this->arrmap('trim', $_POST); 
    }
    
    $this->lang = Route::$lang;
    
    if (Route::$cont == 'main' && Route::$act == 'index') {
     $httppath = '';
    }
    else {
     $httppath = Route::$cont.'/'.Route::$act;
    }
    $data = array('base' => $this->base,
                  'httppath' => $httppath);
    $this->data = $data;
  }
  
  public function after()
  {
    
  }
  
  public function arrmap($callbacks, $array, $keys = NULL)
	{
		foreach ($array as $key => $val)
		{
			if (is_array($val))
			{
				$array[$key] = Arr::map($callbacks, $array[$key]);
			}
			elseif ( ! is_array($keys) OR in_array($key, $keys))
			{
				if (is_array($callbacks))
				{
					foreach ($callbacks as $cb)
					{
						$array[$key] = call_user_func($cb, $array[$key]);
					}
				}
				else
				{
					$array[$key] = call_user_func($callbacks, $array[$key]);
				}
			}
		}

    return $array;
  }
  
  public function cfg($key, $file) {
    
    require_once('configs/'.$file.'.php');
    $c = 'cfg_'.$file.'::'.strtoupper($key);
    return defined($c) ? constant($c) : $key;
    
  }
		
		public function model($name)
		{
				
				$model_file = $name.'.php';
				$model_path = "models/".$model_file;
				
				if(file_exists($model_path))
				{
						include $model_path;
						$model_class = 'Model_'.$name;
				}
				else {
						throw new Exception( 'No import model!' );
				}
				
				return $model_class;
		}
  
  public function response($data, $tpl='Template.php')
  {
    header('Content-Type: text/html; charset=utf-8');
    echo $this->view->generate($tpl, $data);
  }
  
  public function adcss($css) {
    return '<link rel="stylesheet" href="/public/'.$css.'" type="text/css" />';
  }
  
  public function adjslib($jslib) {
				return '<script type="text/javascript" src="/public/'.$jslib.'"> </script>';
  }
  
}
