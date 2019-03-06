<?php
namespace SlsrAdm\Controller {
    /**
     * Page controller.
     */
    class Page {
        public function test(\SlsrAdm\Models\Request $request) {
            return new \SlsrAdm\Models\Response(
                200,
                new \SlsrAdm\View(
                    $_SERVER['DOCUMENT_ROOT'].'/templates/browser.phtml',
                    [
                        'message' => 'Hello World.',
                        'name' => $request->getParameter('name', 'unknown')
                    ]
                )
            );
        }
    }
}
