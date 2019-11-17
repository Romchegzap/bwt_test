<?php
namespace mvc;
use app\repositories\FeedbackRepository;
use app\repositories\UserRepository;
use mvc\view\View;
use mvc\utils\UserInputHandler;
/**
 * Handle all logic flow
 *
 * Obtained instances:
 *     Corresponding model
 *     View
 *     Post user input handler
 *     Get user input handler
 */
abstract class Controller
{
    /**
     * @var array  Route given by Router, if it mathces any route in '/routes.php'
     */
    public $route;
    public $view;
    protected $userRepository;
    protected $feedbackRepository;


    public function __construct($route)
    {
        $this->route = $route;
        $this->userRepository = new UserRepository();
        $this->feedbackRepository = new FeedbackRepository();
        $this->view = new View();

        if (!$this->userHasAccess()) {
            if ($_SESSION['user_group'] != 'autorized') {
                $this->view::redirectByName('login');
            } else {
                $this->view::redirectByName('homepage');
            }
        }
    }

    /**
     * Checks user rights for the passed URL
     *
     * @return bool
     */
    private function userHasAccess()
    {
        $required_perm = $this->route['perm'];
        $user_group = $_SESSION['user_group'];
        if ($required_perm == 'all') {
            return true;
        } elseif ($user_group == $required_perm) {
            return true;
        }
        return false;
    }
}