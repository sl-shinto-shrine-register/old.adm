<?php
namespace SlsrAdm\Models {
    /**
     * Configuration class.
     *
     * @author Vivien Richter <vivien@slsr.org>
     */
    class Configuration {
        /**
         * @var array Loaded configuration data.
         */
        protected $data = [];

        /**
         * Class constructor.
         *
         * @param string $filename Configuration file.
         */
        public function __construct(string $filename) {
            $this->data = parse_ini_file($filename, true, INI_SCANNER_TYPED);
        }

        /**
         * Get configuration value by its key.
         *
         * @param string $key Configuration key name (For example "main.sub").
         * @param mixed $defaultValue Default return value, if no suitable key found.
         * @return mixed Returns the suitable key value.
         */
        public function get(string $key, $defaultValue) {
            $value = eval('return $this->data['.str_replace('.', '][', $key).'];');
            if (empty($value)) {
                return $defaultValue;
            }
            return $value;
        }
    }
}
