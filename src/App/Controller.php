<?php 

namespace App;

use Symfony\Component\HttpFoundation\Response;

class Controller
{
    public function render_template($page, $data = [], $request = null)
    {
        if (!is_null($request)) {
            extract($request->attributes->all(), EXTR_SKIP);
        }
        extract($data, EXTR_SKIP);

        // ** fungsi panggil asset **
        $assets = function ($pathFile) {
            return $this->baseUrl.'assets/'.$pathFile;
        };

        ob_start();
        include sprintf(__DIR__.'/../../src/pages/%s.php', $page);

        return new Response(ob_get_clean());
    }
}
