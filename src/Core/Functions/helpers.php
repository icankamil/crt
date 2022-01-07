<?php

use Core\Classes\SessionData;
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

        $isPermited = function ($userpermissions = [], $permissions, $option = 'required-all') {
            $result = false;

            // jika memiliki semua akses
            if ($userpermissions == '*') {
                return true;
            }

            // option "required-all"
            if ($option == 'required-all') {
                $permissionAmount = count($permissions);
                foreach ($userpermissions as $key => $value) {
                    foreach ($permissions as $key1 => $value1) {
                        if ($value == $value1) {
                            $permissionAmount--;
                        }
                    }
                }
                $result = $permissionAmount == 0 ? true : false;
            } else {
                // option "required-one"
                foreach ($userpermissions as $key => $value) {
                    if (in_array($value, $permissions)) {
                        $result = true;
                        break;
                    }
                }
            }

            return $result;
        };

        extract($data, EXTR_SKIP);

        ob_start();
        include sprintf(__DIR__ . '/../../../src/pages/%s.php', $page);

        return new Response(ob_get_clean());
    }
}

if (!function_exists('env')) {

    /**
     * Get the value of an environment variable
     */
    function env($key, $default = '')
    {
        $value = '';
        if (isset($_ENV[$key])) {
            $value = $_ENV[$key];
        } else {
            $value = $default;
        }

        return $value;
    }
}

if (!function_exists('str_slug')) {

    /**
     * Generate a URL friendly "slug" from a given string.
     *
     * @param  string $string
     * @param  string $separator
     * @return string
     */
    function str_slug(string $string, string $separator = '-')
    {
        $lowercase_judul = strtolower($string);
        $replacespasi = str_replace(' ', $separator, $lowercase_judul);
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $replacespasi);

        return $slug;
    }
}

if (!function_exists('show')) {
    /**
     * Show value of variable
     *
     * @param mixed $var
     * @return void
     */
    function show($var)
    {
        return isset($var) ? $var : '';
    }
}

if (!function_exists('session')) {
    /**
     * Get session
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function session($key = null)
    {
        return $key == null ? SessionData::get()->all() : SessionData::get($key);
    }
}

if (!function_exists('arr_offset')) {
    /**
     * Get offset of array
     *
     * @return mixed
     */
    function arr_offset($array, $offset)
    {
        return $array && isset($array[$offset]) ? $array[$offset] : null;
    }
}

if (!function_exists('storage_path')) {
    /**
     * Get storage path
     *
     * @param string $path
     * @return string
     */
    function storage_path($path = '')
    {
        return __DIR__ . '/../../../web/assets/media/' . $path;
    }
}

if (!function_exists('fonts_path')) {
    /**
     * Get fonts path
     *
     * @param string $path
     * @return string
     */
    function fonts_path($path = '')
    {
        return __DIR__ . '/../../../web/assets/fonts/' . $path;
    }
}

if (!function_exists('component')) {
    /**
     * Get component
     *
     * @param string $path
     * @param array $datas
     * @return string
     */
    function component(string $path = '', array $datas)
    {
        $base_path = 'cms';
        $component_path = file_get_contents(__DIR__ . '/../../pages/public/' . $base_path . '/' . $path . '.php');

        extract($datas, EXTR_SKIP);

        $component_final = $component_path;
        foreach ($datas as $key => $value) {
            $component_final = str_replace('{' . $key . '}', $value, $component_final);
        }

        return html_entity_decode($component_final);
    }
}

if (!function_exists('str_limit')) {
    /**
     * Limit string
     *
     * @param string $string
     * @param int $limit
     * @param string $end
     * @return string
     */
    function str_limit($string, $limit, $end = '...')
    {
        return strlen($string) > $limit ? substr($string, 0, $limit) . $end : $string;
    }
}

if (!function_exists('what_date_is')) {
    /**
     * Find spesific date
     * 
     * @param array $option ['hour' => 0, 'day' => 0, 'week' => 0, 'month' => 0, 'year' => 0]
     * @param string $from (optional) format: 'yyyy-mm-dd'
     */
    function what_date_is(array $option)
    {
        $param = func_get_args();
        $hour = 3600;
        $day = $hour * 24;
        $week = $day * 7;
        $month = $week * 4;
        $year = $month * 12;
        $date_var = get_defined_vars();

        $total_time = 0;
        foreach ($option as $key => $value) {
            if (isset($date_var[$key])) {
                $total_time += $date_var[$key] * $value;
            }
        }

        $from = isset($param[1]) ? strtotime($param[1]) : strtotime(date('Y-m-d'));
        $date = $from + $total_time;

        return date('Y-m-d', $date);
    }
}

if (!function_exists('posted_at')) {
    /**
     * Find spesific date
     * 
     * @param string $created_at format: 'yyyy-mm-dd'
     * @param bool $complete_version
     */
    function posted_at()
    {
        $param = func_get_args();
        $created_at = $param[0];
        $precision = isset($param[1]) ? $param[1] : 1;
        $time = time() - strtotime($created_at);
        $a = array('Dekade' => 315576000, 'Tahun' => 31557600, 'Bulan' => 2629800, 'Minggu' => 604800, 'Hari' => 86400, 'Jam' => 3600, 'Menit' => 60, 'Detik' => 1);
        
        $i = 0;
        foreach ($a as $k => $v) {
            $$k = floor($time / $v);
            if ($$k) $i++;
            $time = $i >= $precision ? 0 : $time - $$k * $v;
            $$k = $$k ? $$k . ' ' . $k . ' ' : '';
            @$result .= $$k;
        }
        return $result;
    }
}

if (!function_exists('num')) {
    /**
     * Show integer data with default value
     * 
     * @param int $number
     */
    function num($number)
    {
        return $number > 0 ? $number : 0;
    }
}

if (!function_exists('template')) {
    /**
     * Get template
     * 
     * @param 
     * @param array $datas
     */
    function template(string $path = '', array $datas)
    {
        extract($datas, EXTR_SKIP);

        ob_start();
        include sprintf(__DIR__ . '/../../pages/%s.php', $path);

        $template = new Response(ob_get_clean());
        return $template->getContent();
    }
}

if (!function_exists('asset')) {
    /**
     * Get assets
     * 
     * @param string $path
     */
    function asset($path = '')
    {
        $app_url = $_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1' ? 'http://' . $_SERVER['HTTP_HOST'] : 'https://' . $_SERVER['HTTP_HOST'];

        return env('APP_MEDIA_URL', $app_url).'/assets/media/' . $path;
    }
}