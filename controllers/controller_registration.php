<?PHP

include_once 'controllers/Common.php';

class Controller_Registration extends Common
{
    
    public function action_index()
    {
        
        require_once('libs/recaptchalib.php');
        $publickey = '6LdSB-oSAAAAABkv3O0-1C0Ifttb5WSueA93OvgT';
        $data = array('lang' => $this->lang,
                      'recaptcha' => recaptcha_get_html($publickey));
        $tpl = $this->view->generate("Registration.php", $data);
        $data = $this->data;
        $data += array('content' => $tpl,
                      'title' => $this->view->_('registration'),
                      'css' => $this->adcss('registration.css'));
        return $this->response($data);
    
    }
    
    public function action_submit()
    {
      $post = $this->post;
      
      include_once 'libs/validator.php';
      $v = new Validator();
      
      $v->set_rules('realname', '', array('required'                 => 'Поле обязательно для заполнения',
                                          'max_length[12]'           => 'Максимальная длинна не должна превышать 12 символов',
                                          'min_length[3]'            => 'Минимальная длинна не должна быть меньше 3 символов'));
                    
      $v->set_rules('username', '', array('required'                 => 'Поле обязательно для заполнения',
                                          'max_length[12]'           => 'Максимальная длинна не должна превышать 12 символов',
                                          'min_length[3]'            => 'Минимальная длинна не должна быть меньше 3 символов'));
      
      $v->set_rules('useremail', '', array('required'                => 'Поле обязательно для заполнения',
                                           'valid_email'             => 'Поле должно содержать правильный e-mail адрес'));
      
      $v->set_rules('password', '', array('required'                 => 'Поле обязательно для заполнения',
                                          'matches[passwordconfirm]' => 'Пароли не совпадают',
                                          'max_length[12]'           => 'Максимальная длинна не должна превышать 12 символов',
                                          'min_length[6]'            => 'Минимальная длинна не должна быть меньше 6 символов'));
      
      if($v->run()) {
        
       if($this->dbusersearch()) {
         
         $this->aduser();
         
        }
       else {
         
         $this->issetuser();
         
       }
       //echo var_dump($post);   
      }
      else {
        $this->errorpost($v->get_array_errors());
        //echo var_dump($v->get_array_errors());
      }
      
    }
    
    public function action_activation() {
        echo 'this';
    }
    
    private function errorpost($errors)
    {
     
        $error_realname  = '';
        $error_username  = '';
        $error_useremail = '';
        $error_password  = '';
        
    
        if(isset($errors['realname'])) {
            $error_realname = $this->errorspan($errors['realname']);
        }
        
        if(isset($errors['username'])) {
            $error_username = $this->errorspan($errors['username']);
        }
        
        if(isset($errors['useremail'])) {
            $error_useremail = $this->errorspan($errors['useremail']);
        }
        
        if(isset($errors['password'])) {
            $error_password = $this->errorspan($errors['password']);
        }      
        
        require_once('libs/recaptchalib.php');
        $publickey = '6LdSB-oSAAAAABkv3O0-1C0Ifttb5WSueA93OvgT';
        $data = array('lang' => $this->lang,
                      'recaptcha' => recaptcha_get_html($publickey),
                      'error_realname' => $error_realname,
                      'error_username' => $error_username,
                      'error_useremail' => $error_useremail,
                      'error_password' => $error_password);
        $tpl = $this->view->generate("Registrationerror.php", $data);
        $data = $this->data;
        $data += array('content' => $tpl,
                      'title' => $this->view->_('registration'),
                      'css' => $this->adcss('registration.css'));
        return $this->response($data);
     
    }
    
    private function dbusersearch()
    {
      
      $m = new Model;
      $result = R::getAll( 'select username, email from users where username= :username or email= :email', array('username' => $this->post['username'],
                                                                                                                 'email'    => $this->post['useremail']) );
      return (empty($result)) ? TRUE : FALSE;

    }
    
    private function issetuser()
    {
         
        $error_realname  = '';
        $error_username  = $this->errorspan('Такой пользователь или e-mail уже есть!');
        $error_useremail = $this->errorspan('Такой пользователь или e-mail уже есть!');
        $error_password  = '';     
        
        require_once('libs/recaptchalib.php');
        $publickey = '6LdSB-oSAAAAABkv3O0-1C0Ifttb5WSueA93OvgT';
        $data = array('lang' => $this->lang,
                      'recaptcha' => recaptcha_get_html($publickey),
                      'error_realname' => $error_realname,
                      'error_username' => $error_username,
                      'error_useremail' => $error_useremail,
                      'error_password' => $error_password);
        $tpl = $this->view->generate("Registrationerror.php", $data);
        $data = $this->data;
        $data += array('content' => $tpl,
                      'title' => $this->view->_('registration'),
                      'css' => $this->adcss('registration.css'));
        return $this->response($data); 
        
    }
    
    private function aduser()
    {
        
      $post = $this->post;
      
      $m = new Model;
      R::exec('insert into users (username, realname, email, password, active) values (:username, :realname, :email, :password, :active)',
              array('username' => $post['username'],
                    'realname' => $post['realname'],
                    'email'    => $post['useremail'],
                    'password' => $post['password'],
                    'active'   => '0'));
      
      require_once('libs/phpmailer/class.phpmailer.php');
      $mail = new PHPMailer();
      
      $mail->SetFrom($this->cfg('set_from_address', 'mail'), $this->cfg('set_from_name', 'mail'));
      $mail->AddAddress($post['useremail'], $post['realname']);
      $mail->Subject    = "Регистрация нового пользователя";
      
      require_once('libs/Encrypt.php');
      $encrypt = new Encryption();
      //$encrypt->setKey('6WXdXnv');
      
      $actlink = $this->base.'registration/activation/'.$encrypt->safe_b64encode($post['username']);
      echo $actlink;
      $data = array('realname' => $post['realname'],
                    'username' => $post['username'],
                    'password' => $post['password'],
                    'actlink'  => $actlink);
      $mail->MsgHTML($this->view->generate("Registrationmessage.php", $data));
      $mail->Send();
        
    }
    
    private function errorspan($str) {
        
      return '<span class="error">'.$str.'</span>';  
        
    }
    
}