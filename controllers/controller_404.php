<?PHP

include_once "controllers/Common.php";

class Controller_404 extends Common
{
    
    public function action_index()
    {
        echo $this->view->generate("404.php"); 
    }
    
}