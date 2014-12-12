<?PHP

class Controller {
    
    public $model;
    public $view;
    
    public function __construct()
    {
        $this->before();
        
        $this->view = new View();
    }
    
    public function __destruct()
    {
        
        $this->after();
    
    }
    
    public function action_index()
    {
    }
    
    public function before()
    {
    }
    
    public function after()
    {
    }
}