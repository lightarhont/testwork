<?PHP

include_once "controllers/Commonmanager.php";

class Controller_Manager extends Commonmanager
{
    
    private $sort = 'created';
    private $sortrule = 'desc';
    
    public function action_index()
    {
                
        $url = explode('/', $_SERVER['REQUEST_URI']);
        
        if(isset($url[4])):
            $sort = $url[4];
        else:
            $sort = $this->sort;
        endif;
        
        if(isset($url[5])):
            $sortrule = $url[5];
        else:
            $sortrule = $this->sort;
        endif;
        
        $urlsort = $this->base.$this->lang.'/manager/index/';
        
        $conn = Model::getInstance()->rb;
        $reviews = R::find('reviews', 'ORDER BY '.$sort.' '.$sortrule);
 
        $urledit = $this->base.$this->lang.'/manager/edit/';
        $data = array('lang' => $this->lang,
                      'rvs' => $reviews,
                      'urledit' => $urledit,
                      'sortrule' => $sortrule,
                      'sort' => $sort,
                      'urlsort' => $urlsort);
        $tpl = $this->view->generate("Manager_index.php", $data);
        $data = $this->data;
        
        $csslibs = $this->adcss('lib/bootstrap/css/bootstrap.css');
        
        $csslibs .= $this->adcss('css/manager.css');
        
        $jslibs = $this->adjslib('lib/bootstrap/js/bootstrap.js');
        
        $data += array(
                      'content' => $tpl,
                      'title' => 'Страница отзывов',
                      'css' => $csslibs,
                      'jslib' => $jslibs
                      );
        return $this->response($data); 
    }
    
    public function action_edit()
    {
        $id = explode('/', $_SERVER['REQUEST_URI'])[4];
        
        $conn = Model::getInstance()->rb;
        $review = R::load('reviews', $id);
        $review->read = 1;
        try
        {
            R::store($review);
        }
        catch (Exception $e)
        {
            header('Content-Type: text/html; charset=utf-8');
            exit("Не удалось сохранить!");
        }
        
        $data = array('lang' => $this->lang,
                      'review' => $review);
        
        $tpl = $this->view->generate("Manager_edit.php", $data);
        $data = $this->data;
        
        $csslibs = $this->adcss('lib/bootstrap/css/bootstrap.css');
        
        $csslibs .= $this->adcss('css/manager.css');
        
        $csslibs .= $this->adcss('lib/wysibb/theme/default/wbbtheme.css');
        
        $jslibs = $this->adjslib('lib/wysibb/jquery.wysibb.js');
        $jslibs .= $this->adjslib('lib/wysibb/lang/ru.js');
        
        $jslibs .= $this->adjslib('lib/bootstrap/js/bootstrap.js');
        
        $jscustom = '
        
        $(document).ready(function() {
        
            var wbbOpt = {
            lang : 	 "'.$this->lang.'",
            buttons: "bold,italic,strike,|,img,link,|,code"
            }
            $("#editor").wysibb(wbbOpt);
            $(".wysibb .modeSwitch").remove();
            
        });
        
        function presubmit() {
            var html = $("#editor").htmlcode();
            $("#editor").html(html);
        }
        
        ';
        
        $data += array('content' => $tpl,
                      'title' => 'Редактировать отзыв',
                      'css' => $csslibs,
                      'jslib' => $jslibs,
                      'jscustom' => $jscustom
                      );
        return $this->response($data); 
    }
    
    public function action_savepost()
    {
        if(!empty($this->post)):
            $id = $this->post['id'];
            $name = $this->post['name'];
            $email = $this->post['email'];
            $content = $this->post['content'];
            $edited = time();
        
            $conn = Model::getInstance()->rb;
            $review = R::load('reviews', $id);
            $review->name = $name;
            $review->email = $email;
            $review->content = $content;
            $review->edited = $edited;
            
            header('Content-Type: text/html; charset=utf-8');
            try
            {
                $id = R::store($review);
                echo "Ваш отзыв сохранён!";
            }
            catch (Exception $e)
            {
                exit("Не удалось сохранить!");
            }
            
            header( 'Location: '.$this->base.$this->lang.'/manager/index/created/desc');
        else:
            header( 'Location: '.$this->base.$this->lang.'/manager/index/created/desc');
        endif;
    }
}