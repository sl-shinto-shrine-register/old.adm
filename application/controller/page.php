<?php
namespace SlsrAdm\Controller {
    class Page {
        public function test($a, $b, $c) {
            return new \SlsrAdm\Models\Response(200, 'Test:'.$a.':'.$b.':'.$c.'.');
        }
    }
}
