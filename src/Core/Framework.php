<?php

namespace Core;

use App\Akreditasi\Model\Akreditasi;
use App\Asosiasi\Model\Asosiasi;
use App\Banner\Model\Banner;
use App\CmsBackground\Model\CmsBackground;
use App\CmsFonts\Model\CmsFonts;
use App\CmsKategoriStyle\Model\CmsKategoriStyle;
use App\CmsTitle\Model\CmsTitle;
use App\Media\Model\Media;
use App\Menu\Model\Menu;
use App\SosialMedia\Model\SosialMedia;
use App\SubMenu\Model\SubMenu;
use App\Users\Model\Users;
use Config\AppPermissions;
use Config\RolePermissions;
use Core\Classes\SessionData;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\HttpKernel;

class Framework extends HttpKernel implements HttpKernelInterface
{
    private $matcher;
    private $controllerResolver;
    private $argumentResolver;

    public function __construct(UrlMatcher $matcher, ControllerResolver $controllerResolver, ArgumentResolver $argumentResolver)
    {
        $this->matcher = $matcher;
        $this->controllerResolver = $controllerResolver;
        $this->argumentResolver = $argumentResolver;
    }

    public function handle(
        Request $request,
        $type = HttpKernelInterface::MASTER_REQUEST,
        $catch = true
    ) {
        $this->matcher->getContext()->fromRequest($request);
        $pathInfo = $request->getPathInfo();

        // Start the session
        SessionData::start();

        // !!!! Overriding Core Framework !!!!

        // Get user id
        $id_user = SessionData::get('id_user');
        $nama_user = SessionData::get('nama_user');
        $id_role = SessionData::get('id_role');
        $alias_role = SessionData::get('alias_role');
        $GLOBALS['id_user'] = $id_user;
        $GLOBALS['nama_user'] = $nama_user;
        $GLOBALS['id_role'] = $id_role;
        $GLOBALS['alias_role'] = $alias_role;

        $this->users = new Users();
        $data_users = $this->users
            ->leftjoin('media', 'media.id_relation', '=', 'users.id_user')
            ->leftJoin('role', 'role.id_role', '=', 'users.id_role')
            ->where('id_user', $id_user)
            ->first();

        $GLOBALS['path_media'] = isset($data_users['path_media']) ? $data_users['path_media'] : '';


        // Get list of website main menu
        $menu_model = new Menu();
        function recursive_menu($parent_id, $menu_model)
        {
            $menus = [];
            $data_menu = $menu_model->where('parent_id', $parent_id)
                ->where('hide', '2')
                ->where(function ($query) {
                    $query->where('jenis_menu', '1')->orWhere('jenis_menu', '3');
                })
                ->get()->items;
            if (!empty($data_menu)) {
                foreach ($data_menu as $key => $value) {
                    $value['sub_menu'] = recursive_menu($value['id_cms_menu'], $menu_model);
                    $menus[] = $value;
                }
            }

            return $menus;
        }

        $menu_utama = recursive_menu('0', $menu_model);
        usort($menu_utama, function ($a, $b) {
            return $a['urutan'] - $b['urutan'];
        });
        $GLOBALS['web_menu'] = $menu_utama;

        $menu_footer = $menu_model->where('parent_id', '0')
            ->where('hide', '2')
            ->where(function ($query) {
                $query->where('jenis_menu', '2')->orWhere('jenis_menu', '3');
            })->get()->items;
        $GLOBALS['menu_footer'] = $menu_footer;

        // Get website logo and title
        $cms_title = new CmsTitle();
        $data_cms_title = $cms_title->first();

        $media = new Media();
        $data_media_title = $media->where('jenis_dokumen', 'cms-title')->first();

        /* ------------------------------- Akreditasi ------------------------------- */
        $akreditasi_model = new Akreditasi();
        $akreditasi = $akreditasi_model->leftJoin('media', 'media.id_relation', '=', 'akreditasi.id_akreditasi')->get();
        /* -------------------------------------------------------------------------- */

        /* -------------------------------- Asosiasi -------------------------------- */
        $asosiasi_model = new Asosiasi();
        $asosiasi = $asosiasi_model->leftJoin('media', 'media.id_relation', '=', 'asosiasi.id_asosiasi')->get();
        /* -------------------------------------------------------------------------- */

        /* ------------------------------ Sosial Media ------------------------------ */
        $sosial_media_model = new SosialMedia();
        $sosial_media = $sosial_media_model->leftJoin('media', 'media.id_relation', '=', 'sosial_media.id_sosial_media')->get();
        /* -------------------------------------------------------------------------- */

        /* ----------------------------------- Banner ---------------------------------- */
        $banner_model = new Banner();
        $current_menu = $menu_model->where('link_url', 'like', '%' . explode('/', $pathInfo)[1] . '%')->first();

        if ($current_menu) {
            $banner_potrait = $banner_model
                ->leftJoin('media', 'media.id_relation', '=', 'banner.id_banner')
                ->where('orientasi_banner', '1')
                ->where('ishide_banner', '2')
                ->where('lokasi_banner', $current_menu['id_cms_menu'])
                ->orderBy('urutan_banner', 'ASC')->get()->items;

            $banner_landscape = $banner_model
                ->leftJoin('media', 'media.id_relation', '=', 'banner.id_banner')
                ->where('orientasi_banner', '2')
                ->where('ishide_banner', '2')
                ->where('lokasi_banner', $current_menu['id_cms_menu'])
                ->orderBy('urutan_banner', 'ASC')->get()->items;

            $GLOBALS['banner_potrait'] = $banner_potrait;
            $GLOBALS['banner_landscape'] = $banner_landscape;
        }
        /* -------------------------------------------------------------------------- */

        $GLOBALS['web_logo'] = $data_media_title;
        $GLOBALS['web_title'] = $data_cms_title;
        $GLOBALS['akreditasi'] = $akreditasi;
        $GLOBALS['asosiasi'] = $asosiasi;
        $GLOBALS['sosial_media'] = $sosial_media;

        $urlTujuan = $request->getPathInfo();
        $explode_url = explode("/", $urlTujuan);
        $current_url = $explode_url[1];

        $GLOBALS['url'] = $urlTujuan;
        $GLOBALS['current_url'] = $current_url;

        /* ----------------------------- User Previleges ---------------------------- */
        $idRole = $id_role;
        $aliasRole = $alias_role;
        $urlTujuan = $request->getPathInfo();
        $GLOBALS['url'] = $urlTujuan;
        $GLOBALS['aliasRole'] = $aliasRole;


        $app_permissions_obj = new AppPermissions();
        $app_permissions = $app_permissions_obj->getPermissions();

        $selectPermissions = [];
        foreach ($app_permissions as $key => $value) {
            if ($value['url'] == $urlTujuan) {
                $selectPermissions = $value;
            }
        }

        if ($idRole != null) {
            $role_permissions_obj = new RolePermissions();
            $role_permissions = $role_permissions_obj->getAllRolePermissions();
            $GLOBALS['userPermissions'] = $role_permissions_obj->getRolePermissions($idRole);

            $hasPermissions = false;
            if (count($selectPermissions) > 0) {
                if (($GLOBALS['userPermissions'] != '*' && in_array($selectPermissions['aliasPermission'], $GLOBALS['userPermissions']))) {
                    $hasPermissions = true;
                } else if ($GLOBALS['userPermissions'] == '*') {
                    $hasPermissions = true;
                }
            }
            // dd($selectPermissions, $urlTujuan, $GLOBALS['userPermissions'], $hasPermissions);
            if (count($selectPermissions) == 0) {
                $selectedUrl = $urlTujuan;
                $pathInfo = $selectedUrl;
            } else {
                if ($hasPermissions) {
                    $selectedUrl = $urlTujuan;
                    $pathInfo = $selectedUrl;
                } else {
                    $selectedUrl = '/';
                    $pathInfo = $selectedUrl;
                }
            }
        } else {
            if (count($selectPermissions) == 0) {
                $selectedUrl = $urlTujuan;
                $pathInfo = $selectedUrl;
            } else {
                $selectedUrl = '/';
                $pathInfo = $selectedUrl;
            }
        }
        /* --------------------------- End User Previleges -------------------------- */

        try {
            $request->attributes->add($this->matcher->match($pathInfo));

            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            return call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $exception) {
            return new Response('Not Found', 404);
        } catch (\Exception $exception) {
            return new Response('' . $exception, 500);
        }
    }
}
