<?PHP

class Route
{
    
    public static $lang = 'ru';
    public static $cont = 'main';
    public static $act  = 'index';
    
    public static function start()
    {
        // контроллер и действие по умолчанию
        $controller_name = self::$cont;
        $action_name     = self::$act;
        $lang_name       = self::$lang;
        
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        
        //exit(var_dump($routes));
        
        // получаем имя локали
        if ( !empty($routes[1]) )
        {
            $lang_name = $routes[1];
            self::$lang = $lang_name;
        }
        
        // получаем имя контроллера
        if ( !empty($routes[2]) )
        {	
            $controller_name = $routes[2];
            self::$cont = $controller_name;
        }
        

        
        // получаем имя экшена
        if ( !empty($routes[3]) )
        {
            $action_name = $routes[3];
            self::$act = $action_name;
        }

        // добавляем префиксы
        //$model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;

        // подцепляем файл с классом модели
        //$model_file = strtolower($model_name).'.php';
        //$model_path = "models/".$model_file;
        //if(file_exists($model_path))
        //{
        //    include "models/".$model_file;
        //}
        
        $lang_file = strtolower($lang_name).'.php';
        $langs_path = "langs/".$lang_file;
        if(file_exists($langs_path))
        {
            include "langs/".$lang_file;
        }
        

        // подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            include "controllers/".$controller_file;
        }
        else
        {
            /*
            правильно было бы кинуть здесь исключение,
            но для упрощения сразу сделаем редирект на страницу 404
            */
            Route::ErrorPage404();
        }
        
        // создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;
        
        if(method_exists($controller, $action))
        {
            // вызываем действие контроллера
            $controller->$action();
        }
        else
        {
            // здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404();
        }
    
    }
    
    public function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
    
}