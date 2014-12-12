<?PHP
//Mikhail::Дописать запрет прямого доступа!

switch($_GET['action'])
{ 
    case "about" :
        require_once("auth.php"); // страница "О Нас"
        break;
    case "contacts" :
        require_once("register.php"); // страница "Контакты"
        break;
    case "feedback" :
        require_once("ready.php"); // страница "Обратная связь"
        break;
    case "feedback" :
        require_once("error.php"); // страница "Обратная связь"
        break;
    default : 
        require_once("page404.php"); // страница "404"
    break;
}