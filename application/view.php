<?php
namespace SlsrAdm {
    /**
     * View class.
     *
     * Loads an template file and fill it with the given data to generate the final content.
     */
    class View {
        /**
         * @var string Template file.
         */
        protected $template = '';

        /**
         * @var array Data.
         */
        protected $data = [];

        /**
         * Magical method for conversion to string type.
         *
         * @return string Final content.
         */
        public function __toString() {
            return $this->getContent();
        }

        /**
         * Class constructor.
         *
         * @param string $template Template file.
         * @param array $data Assoziative array with data.
         */
        public function __construct(string $template, array $data) {
            $this->template = $template;
            $this->data = $data;
        }

        /**
         * Get the final content.
         *
         * @return string Final content.
         */
        public function getContent() {
            ob_start();
            extract($this->data, EXTR_SKIP);
            include($this->template);
            return ob_get_clean();
        }
    }
}
