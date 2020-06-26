<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use App\Response\Error;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Gate;

class ACLPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try
        {
            $routeTypeWeb = array_search("web", $request->route()->middleware());
            if($routeTypeWeb!==false)
            {
                $request["routeType"] = "web";
            }

            $routeTypeAPI = array_search("api", $request->route()->middleware());
            if($routeTypeAPI!==false)
            {
                $request["routeType"] = "api";
            }

            self::setupRoutes();

            // Is security in Permissions ACL
            $permission = $this->permissions($request);
            if($permission)
            {
                return $permission;
            }
            self::idNotExist($request);
        }
        catch (\Exception $e)
        {

        }

        return $next($request);
    }

    /**
     * @param Request $request
     * @return bool|void
     */
    public static function idNotExist(Request $request)
    {
        if(isset($request->model)&& empty($request->route()->parameter("id"))==false)
        {
            $model = $request->model::find($request->route()->parameter("id"));
            if($model==null)
            {
                return Error::generic("Item informado não existe", null, 403, 2001, $request);
            }
        }
    }

    /**
     * @param $request
     * @return bool|\Illuminate\Http\RedirectResponse|Mixed|Void
     */
    public function permissions(Request $request)
    {
        if
        (
            auth("api")->user()!=null &&
            auth("api")->user()->hasAnyRoles('Administrator')==false &&
            Gate::denies($request->route()->getName()) &&
            env("APP_DEBUG")==false
        )
        {
            return Error::generic("Não Autorizado", $request->route()->getName(), 301, 1001, $request);
        }
    }

    public static function setupRoutes()
    {
            $routesAll = self::exceptionRoutes();
            foreach ($routesAll as $routeArray)
            {
                $data = [];
                $data["name"]              = $routeArray->getName();
                $data["label"]             = $routeArray->wheres["label"];
                $data["group"]             = $routeArray->wheres["group"];
                $data["institution_id"]    = 1;
                $permissionExist = Permission::where("name", $routeArray->getName())->get()->first();
                if($permissionExist==null)
                {
                    $permission = Permission::create($data);
                }
                else
                {
                    $permissionExist->update($data);
                    $permission = $permissionExist;
                }
                if(isset($routeArray->wheres["roles_ids"]) && $routeArray->wheres["roles_ids"]!="null")
                {
                    $ids = explode(",", $routeArray->wheres["roles_ids"]);
                    $rolesIds = Role::whereIn("id", $ids)->get();
                }
                $permission->roles()->sync($rolesIds ?? [], true);
            }
    }

    /**
     * Retorna as rotas que estão dentro do Middleware Permissões
     * @return array
     */
    public static function exceptionRoutes()
    {
        $routesAll = Route::getRoutes()->getRoutes();
        foreach ($routesAll as $key => $route)
        {
            if(!isset($route->wheres["label"]) || !isset($route->wheres["group"]))
            {
                unset($routesAll[$key]);
            }
        }
        return $routesAll;
    }
}
