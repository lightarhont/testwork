<?PHP

class View
{
    //public $template_view; // здесь можно указать общий вид по умолчанию.
    
    public function generate($content_view, $data = null)
    {
        
        ob_start();
        
        if(is_array($data)) {
            // преобразуем элементы массива в переменные
            extract($data);
        }
        
        
        include 'views/'.$content_view;
        
        return ob_get_clean();
        
    }
    
    public function _($key)
    {
	$c = 'langs_'.Route::$lang.'::'.strtoupper($key); // получаем имя класса и константы с переводом
	return defined($c) ? constant($c) : $key;
    }
}