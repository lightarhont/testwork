<?PHP

class Model
{
    
    private $dbname = 'mytest';
    private $dbhost = 'localhost';
    private $dbuser = 'mytest';
    private $dbpass = 'speed1';
    
    private static $instance;
    
    public $rb;
    public $query;
    public $adapter;
    
    public function __construct()
    {
        $this->dbconnect();
        
    }
    
    public static function getInstance() {
        if ( empty(self::$instance) )
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function get_data()
    {
    }
    
    public function dbconnect()
    {
     require_once 'rb.php';
     $conn = R::setup('mysql:host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpass);
     $this->rb = $conn->getRedBean();
     $this->query = $conn->getWriter();
     $this->adapter = $conn->getDatabaseAdapter();
    }
}