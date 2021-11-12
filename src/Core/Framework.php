<?php

namespace Core;

use Config\AppPermissions;
use Config\RolePermissions;
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

        $globalFunc = new GlobalFunc();
        if (!$request->hasSession()) {
            $session = $globalFunc->beginSession();
            $request->setSession($session);
        }

        $idRole = $request->getSession()->get('idRole');
        $aliasRole = $request->getSession()->get('aliasRole');
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

            // dd($GLOBALS['userPermissions']);

            $hasPermissions = false;
            if (count($selectPermissions) > 0) {
                if (($GLOBALS['userPermissions'] != '*' && in_array($selectPermissions['aliasPermission'], $GLOBALS['userPermissions']))) {
                    $hasPermissions = true;
                } else if ($GLOBALS['userPermissions'] == '*') {
                    $hasPermissions = true;
                }
            }
            if (count($selectPermissions) == 0) {
                $selectedUrl = $urlTujuan;
            } else {
                if ($hasPermissions) {
                    $selectedUrl = $urlTujuan;
                } else {
                    $selectedUrl = '/';
                }
            }
        } else {
            if (count($selectPermissions) == 0) {
                $selectedUrl = $urlTujuan;
            } else {
                $selectedUrl = '/';
            }
        }

        try {
            // $request->attributes->add($this->matcher->match($request->getPathInfo()));
            $request->attributes->add($this->matcher->match($selectedUrl));

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
