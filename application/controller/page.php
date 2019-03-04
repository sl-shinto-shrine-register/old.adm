<?php
namespace SlsrAdm\Controller {
    class Page {
        public function test(\SlsrAdm\Models\Request $request) {
            $a = $request->getParameter('a', '');
            $b = $request->getParameter('b', '');
            $c = $request->getParameter('c', '');
            return new \SlsrAdm\Models\Response(200, 'Test:'.$a.':'.$b.':'.$c.'.');
        }
    }
}
