<?php 

    /**
     * Absract class Router
     * execute a controller method depending on url
     * Main routing class
     */
    abstract class Router 
    {
        /**
         * Function that finds the controller
         * and excute one of its action
         * depending on the url
         */
        public static function routeRequest()
        {
            /**
             * Extract the url 
             * in the script
             */
            extract($_GET);

            if($url != null) /* S'il  y a des options ajoutées après l'url ... */
            {
                /**
                 * Separate url into parameters
                 * Format : controller/action/id
                 */
                $params = explode('/', $url);

                /**
                 * Define controller from the url
                 * first param
                 */
                $controller = $params[0];

                /**
                 * Define action from the url
                 * second param @if exists ...
                 * else ... default 'index'
                 */
                $action = (isset($params[1]) && $params[1] != null) ? $params[1] : 'index';

                /**
                 * Define id fromt the url
                 * third param @if exists ...
                 * else ... default null
                 */
                $id = (isset($params[2]) && $params[2] != null) ? $params[2] : 'null';

                /**
                 * Define the controller class
                 * ucfirst() capitalises the params typed
                 */
                $controllerClass = ucfirst($controller . '_Controller');

                /**
                 * Defining controller file
                 */
                $controllerFile = $controller . '_Controller.php';

                /**
                 * verify @if the controller exists
                 * checking if the controller file exists ...
                 * else ... display error 404
                 */
                if(file_exists(ROOT . 'controllers/' . $controllerFile)) 
                {   
                    /**
                     * Include controller to use it
                     */
                    require_once(ROOT . 'controllers/' . $controllerFile);
                    /**
                     * Create an instance of the controller
                     */
                    $newController = new $controllerClass();

                    /**
                     * Verify if the action exists in that controller
                     * @if action exists ... execute the action with id as parameter
                     * else ... display error 404
                     */
                    if(method_exists($newController,$action))
                    {
                        /**
                         * Execute the action with id as parameter 
                         */
                        $newController -> $action($id); 
                   }else{
                        /**
                         * Display error 404 
                         * using current controller
                         */
                        $newController -> error_404_display();
                   }
                }else{
                    /**
                     * Display error 404 
                     * using home controller
                     */
                    require_once(ROOT . 'controllers/main/home_Controller.php');

                    $newController = new Home_Controller();
                    $newController->error_404_Display();
                }
            }else{ 
                /**
                 * else ... use Home controller
                 * execute default index action
                 */

                require_once(ROOT . 'controllers/main/home_Controller.php');

                $newController = new Home_Controller();

                $newController->index();
            }
        }
    }