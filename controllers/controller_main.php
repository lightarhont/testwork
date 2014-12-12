<?PHP

include_once "controllers/Common.php";

class Controller_Main extends Common
{
    
    public function action_index()
    {
        
        //new Model;
        
        $conn = Model::getInstance()->rb;
        $reviews = $conn->find('reviews');
        $data = array('lang' => $this->lang);
        $tpl = $this->view->generate("Main.php", $data);
        $data = $this->data;
        
        $jslibs = $this->adjslib('lib/wysibb/jquery.wysibb.js');
        $jslibs .= $this->adjslib('lib/wysibb/lang/ru.js');
        
        $jslibs .= $this->adjslib('lib/jqueryui/jquery-ui-1.8.2.custom.min.js');
        $jslibs .= $this->adjslib('lib/pirobox/pirobox_extended_min.js');
        
        $csslibs = $this->adcss('css/login.css');
        
        $csslibs .= $this->adcss('lib/wysibb/theme/default/wbbtheme.css');
        
        $csslibs .= $this->adcss('lib/pirobox/style_2/style.css');
        
        $jscustom = '
        
        $(document).ready(function() {
        
            var wbbOpt = {
            lang : 	 "'.$this->lang.'",
            buttons: "bold,italic,strike,|,img,link,|,code"
            }
            $("#editor").wysibb(wbbOpt);
            $(".wysibb .modeSwitch").remove();
            
            $().piroBox_ext({
            piro_speed : 900,
            bg_alpha : 0.1,
            piro_scroll : true //pirobox always positioned at the center of the page
            });
            
            $("input.preview").click(function(){
             var html = $("#editor").htmlcode();

             $("#buffer .mf").html(html);
             $("#buffershow").click();
            });
            
        });
        
        function presubmit() {
            var html = $("#editor").htmlcode();
            $("#editor").html(html);
        }
        
        ';
        
        $data += array(
                      'content' => $tpl,
                      'title' => $this->view->_('add_a_review'),
                      'css' => $csslibs,
                      'jslib' => $jslibs,
                      'jscustom' => $jscustom
                      );
        return $this->response($data); 
    }
    
    public function action_postdata()
    {
        if(!empty($this->post)):
            $name = $this->post['name'];
            $email = $this->post['email'];
            $content = $this->post['content'];
        
            $conn = Model::getInstance()->rb;
            $reviews = $conn->dispense('reviews');
            $reviews->name = $name;
            $reviews->email = $email;
            $reviews->content = $content;
            $reviews->created = time();
            $reviews->read = 0;
        
            header('Content-Type: text/html; charset=utf-8');
            try
            {
                $id = $conn->store($reviews);
                echo "Ваш отзыв сохранён!";
            }
            catch (Exception $e)
            {
                echo "Не удалось сохранить!";
            }
        else:
            $this->action_index();
        endif;
    }
    
}