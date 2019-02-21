<?php
namespace SlsrAdm {
    class Page {
        public function test($a, $b, $c) {
            return new Response(200, 'Test:'.$a.':'.$b.':'.$c.'.');
        }
    }
}
