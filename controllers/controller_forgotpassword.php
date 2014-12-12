<?PHP

include_once "controllers/Common.php";

class Controller_Forgotpassword extends Common
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
    
}