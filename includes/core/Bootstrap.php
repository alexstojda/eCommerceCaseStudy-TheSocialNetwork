<?php

class Bootstrap
{

    private $_url = null;
    /**
     * @var Controller
     */
    private $_controller = null;

    private $_controllerPath = '../includes/controllers/'; // Always include trailing slash
    private $_modelPath = '../includes/models/'; // Always include trailing slash
    private $_defaultFile = 'index.php';

    /**
     * Starts the Bootstrap
     *
     * @return boolean
     */
    public function init()
    {
        // Sets the protected $_url
        $this->_getUrl();

        // Load the default controller if no URL is set
        // eg: Visit http://localhost it loads Default Controller
        if (empty($this->_url[0])) {
            $this->_loadDefaultController();
            return false;
        }

        if ($this->_loadExistingController() != false)
            $this->_callControllerMethod();

        return true;
    }

    /**
     * Fetches the $_GET from 'url'
     */
    private function _getUrl()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = ltrim($url, 'public');
        $url = trim($url, '/');

        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode('/', $url);
    }

    /**
     * This loads if there is no GET parameter passed
     */
    private function _loadDefaultController()
    {
        /** @noinspection PhpIncludeInspection */
        require $this->_controllerPath . $this->_defaultFile;
        $this->_controller = new Index();
        $this->_controller->index();
    }

    /**
     * Load an existing controller if there IS a GET parameter passed
     *
     * @return boolean|string
     */
    private function _loadExistingController()
    {
        $file = $this->_controllerPath . $this->_url[0] . '.php';

        if (file_exists($file)) {
            /** @noinspection PhpIncludeInspection */
            require_once $file;
            $this->_controller = new $this->_url[0];
            $this->_controller->loadModel(ucfirst($this->_url[0]), null, $this->_modelPath);
            return true;
        } else {
            $this->_loadDefaultController();
            return false;
        }
    }

    /**
     * If a method is passed in the GET url parameter
     *
     *  http://localhost/controller/method/(param)/(param)/(param)
     *  url[0] = Controller
     *  url[1] = Method
     *  url[2] = Param
     *  url[3] = Param
     *  url[4] = Param
     */
    private function _callControllerMethod()
    {
        $length = count($this->_url);
        // Make sure the method we are calling exists
        if ($length > 1) {
            if (!method_exists($this->_controller, $this->_url[1])) {
                $this->_controller->index();
                return false;
            }
        }

        // Determine what to load
        switch ($length) {
            case 5:
                //Controller->Method(Param1, Param2, Param3)
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
                break;

            case 4:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
                break;

            case 3:
                //Controller->Method(Param1)
                $this->_controller->{$this->_url[1]}($this->_url[2]);
                break;

            case 2:
                //Controller->Method()
                $this->_controller->{$this->_url[1]}();
                break;

            default:
                $this->_controller->index();
                break;
        }
        return true;
    }

}