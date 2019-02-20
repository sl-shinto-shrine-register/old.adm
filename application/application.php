<?php
namespace SlsrAdm {
    /**
     * Application class.
     *
     * @author Vivien Richter <vivien@slsr.org>
     */
    class Application {
        /**
         * @var Configuration Configuration instance.
         */
        protected $configuration = null;

        /**
         * Class constructor.
         *
         * @param string $configurationFile Configuration file.
         */
        public function __construct(string $configurationFile) {
            $this->configuration = new Configuration($configurationFile);
        }

        /**
         * Process.
         *
         * @param string $uri Requested URI.
         * @param array $request User request.
         * @param array $files User files.
         * @return Response Instance of Response.
         */
        public function process(string $uri, array $request, array $files) {
            $request = new Request($uri, $request, $files);
            return new Response(200, 'Test.');
        }
    }
}
