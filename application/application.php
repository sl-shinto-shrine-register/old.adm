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
            return $this->route(
                new Models\Request($uri, $request, $files)
            );
        }

        /**
         * Routing.
         *
         * @param \SlsrAdm\Models\Request $request Request instance.
         * @return \SlsrAdm\Models\Response Response instance.
         */
        public function route(Models\Request $request) {
            $url = parse_url($request->getURI(), PHP_URL_PATH);
            if (!empty($url)) {
                list($controller, $action) = explode('/', trim($url, '/'));
                $controller = __NAMESPACE__.'\\Controller\\'.$controller;
                if (method_exists($controller, $action)) {
                    $reflection = new \ReflectionMethod($controller, $action);
                    foreach ($reflection->getParameters() as $argument) {
                        $parameters[] = $request->getParameter($argument->getName(), null);
                    }
                    return call_user_func_array([$controller, $action], $parameters);
                }
            }
            return new Models\Response(404, 'Not found.');
        }
    }
}
