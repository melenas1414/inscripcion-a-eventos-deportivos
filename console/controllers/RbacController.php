<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add "facturacion" permission
        $facturacion = $auth->createPermission('facturacion');
        $facturacion->description = 'Acceso a facturación';
        $auth->add($facturacion);
        // add "eventos" permission
        $evento = $auth->createPermission('eventos');
        $evento->description = 'Acceso a Eventos';
        $auth->add($evento);
        // add "general" permission
        $general = $auth->createPermission('general');
        $general->description = 'Acceso a general';
        $auth->add($general);

        // add "facturacion Role" role and give this role the "Facturacion" permission
        $facturacion_role = $auth->createRole(2);
        $auth->add($facturacion_role);
        $auth->addChild($facturacion_role, $facturacion);
        // add "evento" role and give this role the "evento" permission
        $evento_role = $auth->createRole(1);
        $auth->add($evento_role);
        $auth->addChild($evento_role, $evento);
        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole(9);
        $auth->add($admin);
        $auth->addChild($admin, $general);
        $auth->addChild($admin, $facturacion_role);
        $auth->addChild($admin, $evento_role);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($evento_role, 2);
        $auth->assign($admin, 1);
    }
}