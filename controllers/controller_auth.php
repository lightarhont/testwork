<?PHP

include_once "controllers/Common.php";

class Controller_Auth extends Common
{
    
    public function action_index()
    {
        $data = array('lang' => $this->lang);
        $tpl = $this->view->generate("Login.php", $data);
        $data = $this->data;
        $data += array('content' => $tpl,
                      'title' => $this->view->_('authorization'),
                      'css' => $this->adcss('css/login.css'),
                      );
        return $this->response($data); 
    }
    
    public function action_postdata()
    {
        if(!empty($this->post)):
            $username = $this->post['username'];
            $password = $this->post['password'];
            
            $conn = Model::getInstance()->rb;
            $user = R::findOne('users', 'username = :username AND password = :password',
                               array(':username' => $username, ':password' => $password));
            if(!empty($user)):
                $_SESSION['userid'] = $user->id;
                setcookie("userid", $user->id, time()+60*60*24*10);
                if(isset($_SESSION['userid'])):
                    echo $_SESSION['userid'];
                    //header( 'Location: '.$this->base.$this->lang.'/manager');
                else:
                    $this->action_index();
                endif;
            else:
                $this->action_index();
            endif;
        else:
            $this->action_index();
        endif;
    }
    
    public function action_login()
    {
        
    }
    
}