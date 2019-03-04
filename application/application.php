<?php
namespace SlsrAdm {
    /**
     * Application class.
     *
     * @author Vivien Richter <vivien@slsr.org>
     */
    class Application {
        /**
         * @var \SlsrAdm\Models\Configuration Configuration instance.
         */
        protected $configuration = null;

        /**
         * Class constructor.
         *
         * @param string $configurationFile Configuration file.
         */
        public function __construct(string $configurationFile) {
            $this->configuration = new Models\Configuration($configurationFile);
        }

        /**
         * Processing.
         *
         * @param string $uri Requested URI.
         * @param array $request User request.
         * @param array $files User files.
         * @return \SlsrAdm\Models\Response Instance of Response.
         */
        public function process(string $uri, array $request, array $files) {
            $request = new Models\Request($uri, $request, $files);
            return $this->route(
                $this->parse($request),
                $request
            );
        }

        /**
         * Parse a request.
         *
         * @param \SlsrAdm\Models\Request $request Request instance.
         * @return \SlsrAdm\Models\Route Instance of Route.
         */
        public function parse(Models\Request $request) {
            $url = parse_url($request->getURI(), PHP_URL_PATH);
            if (empty($url) || $url == '/') {
                return new Models\Route();
            }
            list($controller, $action) = explode('/', trim($url, '/'));
            return new Models\Route($controller, $action);
        }

        /**
         * Routing.
         *
         * @param \SlsrAdm\Models\Route $route Request instance.
         * @param \SlsrAdm\Models\Request $request Instance of Request.
         * @return \SlsrAdm\Models\Response Instance of Response.
         */
        public function route(Models\Route $route, Models\Request $request) {
            $controller = __NAMESPACE__.'\\Controller\\'.$route->getController();
            $action = $route->getAction();
            if (method_exists($controller, $action)) {
                return (new $controller)->$action($request);
            }
            return new Models\Response(404, 'Not found.');
        }
    }
}
