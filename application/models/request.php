<?php
namespace SlsrAdm {
    /**
     * Request class.
     *
     * @author Vivien Richter <vivien@slsr.org>
     */
    class Request {
        /**
         * @var array Parameters.
         */
        protected $parameters = [];

        /**
         * @var array Files.
         */
        protected $files = [];

        /**
         * @var array Route.
         */
        protected $route = [];

        /**
         * Class constructor.
         *
         * @param string $uri Requested URI.
         * @param array $request User request.
         * @param array $files User files.
         */
        public function __construct(string $uri, array $request, array $files) {
            $this->route = $this->parseRoute($uri);
            $this->parameters = $this->filterArray($request);
            $this->files = $files;
        }

        /**
         * Get route.
         *
         * @return array Route.
         */
        public function getRoute() {
            return $this->route;
        }

        /**
         * Get parameter value by its key name.
         *
         * @param string $key Parameter key name (For example "main.sub").
         * @param mixed $defaultValue Default return value, if no suitable parameter found.
         * @return mixed Returns the suitable parameter value.
         */
        public function getParameter(string $key, $defaultValue) {
            $value = eval('return $this->parameters['.str_replace('.', '][', $key).'];');
            if (empty($value)) {
                return $defaultValue;
            }
            return $value;
        }

        /**
         * Get file by its key name.
         *
         * @param string $key File key name (For example "main.sub").
         * @return mixed Returns the suitable file or an empty array, if not found.
         */
        public function getFile(string $key) {
            $value = eval('return $this->files['.str_replace('.', '][', $key).'];');
            if (empty($value)) {
                return [];
            }
            return $value;
        }

        /**
         * Parse route.
         *
         * @param string $uri URI.
         * @return array Route.
         */
        protected function parseRoute(string $uri) {
            $url = explode('/', explode('?', explode('#', $uri)[0])[0]);
            array_shift($url);
            if (empty($url)) {
                return [];
            }
            return $url;
        }

        /**
         * Filter an array.
         *
         * @param array $input Input array.
         * @return array Cleaned array.
         */
        protected function filterArray(array $input) {
            array_walk_recursive(
                $input,
                function(&$value, &$key) use (&$result) {
                    $result[$this->filter($key)] = $this->filter($value);
                }
            );
            if (empty($result)) {
                return [];
            }
            return $result;
        }

        /**
         * Filter a string.
         *
         * @param string $input Input string.
         * @return string Cleaned string.
         */
        private function filter(string $input) {
            return filter_var(urldecode($input), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
        }
    }
}
