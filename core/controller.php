<?php 

    /**
     * Controller
     * Abstract Class
     * Load data from a Model 
     * Redirect to a View
     */

    abstract class Controller 
    {
        /**
         * protected Member
         * model
         */
        protected $_model;

        /**
         * protected Member
         * view_file
         */
        protected string $_view_file;

        /**
         * protected function
         * use to load a model 
         * and extract the data from that model
         */
        protected function loadModel(string $model)
        {
            $modelClass = ucfirst($model) . '_Manager';

            $modelFile = $model . '_manager.php';

            require_once(ROOT . 'models/managers/' . $modelFile);

            $this->_model = new $modelClass();
        }

        /**
         * protected Function
         * use to render a view and its data
         * @param string,string,array
         */
        protected function render(string $view, string $view_file = '', array $data = array())
        {
            if(!empty($data))
            {
                extract($data);
            }

            require_once(ROOT . 'views/' . $view_file . '/' . $view . '_view.php');
        }

        /**
         * protected Function
         * use to render a form view 
         * with error
         * @param string,string,array,string
         */
        protected function renderForm(string $view, string $view_file = '',string $error)
        {
            $err = $error;
            require_once(ROOT . 'views/' . $view_file . '/' . $view . '_view.php');
        }

        /**
         * protected Function
         * use to clean data and treat them
         * trim() removes spaces at start and end of string
         * htmlspecialchars() converts special characters to HTML entities
         * stripslashes() removes backslashes from a string
         */
        protected function cleanData($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        /**
         * public Function
         * use to display error 404 page
         */
        public function error_404_display()
        {
            /**
             * Define page title
             */
            $title = 'Error 404 | Page Not Found';

            ob_start();


            /**
             * Render error 404 view
             */
            $this->render('error_404','error');

            /**
             * Store view in variable
             */
            $content = ob_get_clean();

            /**
             * Set default layout
             */
            require_once(ROOT . 'views/shared/default_layout.php');
        }

    }