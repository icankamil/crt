<?php

use Symfony\Component\HttpFoundation\Response;

if (!function_exists('render_template')) {

    /**
     * Render template
     *
     * @param string $page
     * @param array $data
     * @param Request $request
     * @return Response
     */
    function render_template($page, $data = [], $request = null)
    {
        if (!is_null($request)) {
            extract($request->attributes->all(), EXTR_SKIP);
        }
        extract($data, EXTR_SKIP);

        ob_start();
        include sprintf(__DIR__ . '/../../../src/pages/%s.php', $page);

        return new Response(ob_get_clean());
    }
}

