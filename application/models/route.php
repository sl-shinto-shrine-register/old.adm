<?php
namespace SlsrAdm\Models {
    /**
     * Routing destination.
     */
    class Route {
        /**
         * @var string Controller class name.
         */
        protected $controller = '';

        /**
         * @var string Action method name.
         */
        protected $action = '';

        /**
         * Get controller class name.
         *
         * @return string Controller class name.
         */
        public function getController() {
            return $this->controller;
        }

        /**
         * Get action method name.
         *
         * @return string Action method name.
         */
        public function getAction() {
            return $this->action;
        }

        /**
         * Class constructor.
         *
         * @param string $controller Controller class name (Default: empty).
         * @param string $action Action method name (Default: empty).
         */
        public function __construct(string $controller = '', string $action = '') {
            $this->controller = $controller;
            $this->action = $action;
        }
    }
}
