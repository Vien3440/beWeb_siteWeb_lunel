<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdProjectContainerUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/c')) {
            // valideCandidat
            if ($pathinfo === '/candidatureValid') {
                return array (  '_controller' => 'AppBundle\\Controller\\AjaxController::candidatEnvois',  '_route' => 'valideCandidat',);
            }

            // valideContacte
            if ($pathinfo === '/contacteValid') {
                return array (  '_controller' => 'AppBundle\\Controller\\AjaxController::contacteEnvois',  '_route' => 'valideContacte',);
            }

        }

        // app_ajaxcontrolleradmin_suprmessage
        if (0 === strpos($pathinfo, '/admin/message/supr') && preg_match('#^/admin/message/supr/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_ajaxcontrolleradmin_suprmessage')), array (  '_controller' => 'AppBundle\\Controller\\AjaxControllerAdmin::SuprMessage',));
        }

        // home
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'home');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\ControleurCrud::getHome',  '_route' => 'home',);
        }

        if (0 === strpos($pathinfo, '/promo')) {
            // homePromo
            if ($pathinfo === '/promo') {
                return array (  '_controller' => 'AppBundle\\Controller\\ControleurCrud::getHomePromo',  '_route' => 'homePromo',);
            }

            // tronbiPromo
            if (0 === strpos($pathinfo, '/promo/tronbin') && preg_match('#^/promo/tronbin/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'tronbiPromo')), array (  '_controller' => 'AppBundle\\Controller\\ControleurCrud::getTronbiPromo',));
            }

        }

        if (0 === strpos($pathinfo, '/admin')) {
            // homeAdmin
            if ($pathinfo === '/admin') {
                return array (  '_controller' => 'AppBundle\\Controller\\ControleurCrudAdmin::getAdmin',  '_route' => 'homeAdmin',);
            }

            if (0 === strpos($pathinfo, '/admin/modif')) {
                // modifTexte
                if (0 === strpos($pathinfo, '/admin/modifTexte') && preg_match('#^/admin/modifTexte/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'modifTexte')), array (  '_controller' => 'AppBundle\\Controller\\ControleurCrudAdmin::modifSection',));
                }

                // updateSection
                if (0 === strpos($pathinfo, '/admin/modifSection/update') && preg_match('#^/admin/modifSection/update/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'updateSection')), array (  '_controller' => 'AppBundle\\Controller\\ControleurCrudAdmin::updateSection',));
                }

                if (0 === strpos($pathinfo, '/admin/modifP')) {
                    if (0 === strpos($pathinfo, '/admin/modifPartenaire')) {
                        // modifParte
                        if (rtrim($pathinfo, '/') === '/admin/modifPartenaire') {
                            if (substr($pathinfo, -1) !== '/') {
                                return $this->redirect($pathinfo.'/', 'modifParte');
                            }

                            return array (  '_controller' => 'AppBundle\\Controller\\ControleurCrudAdmin::formPartenaire',  '_route' => 'modifParte',);
                        }

                        // updateParte
                        if ($pathinfo === '/admin/modifPartenaire/update') {
                            return array (  '_controller' => 'AppBundle\\Controller\\ControleurCrudAdmin::updatePartenaire',  '_route' => 'updateParte',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/modifPromotion')) {
                        // createPromotion
                        if (rtrim($pathinfo, '/') === '/admin/modifPromotion') {
                            if (substr($pathinfo, -1) !== '/') {
                                return $this->redirect($pathinfo.'/', 'createPromotion');
                            }

                            return array (  '_controller' => 'AppBundle\\Controller\\ControleurCrudAdmin::formPromos',  '_route' => 'createPromotion',);
                        }

                        // updatePromos
                        if ($pathinfo === '/admin/modifPromotion/update') {
                            return array (  '_controller' => 'AppBundle\\Controller\\ControleurCrudAdmin::updatePromotion',  '_route' => 'updatePromos',);
                        }

                    }

                }

            }

            // listpromotion
            if ($pathinfo === '/admin/listpromotion') {
                return array (  '_controller' => 'AppBundle\\Controller\\ControleurCrudAdmin::getList',  '_route' => 'listpromotion',);
            }

            // getCandidat
            if ($pathinfo === '/admin/candidat') {
                return array (  '_controller' => 'AppBundle\\Controller\\ControleurCrudAdmin::getCandidat',  '_route' => 'getCandidat',);
            }

            if (0 === strpos($pathinfo, '/admin/message')) {
                // getMessage
                if ($pathinfo === '/admin/message') {
                    return array (  '_controller' => 'AppBundle\\Controller\\ControleurCrudAdmin::getMessage',  '_route' => 'getMessage',);
                }

                // detailMessage
                if (0 === strpos($pathinfo, '/admin/message/detail') && preg_match('#^/admin/message/detail/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'detailMessage')), array (  '_controller' => 'AppBundle\\Controller\\ControleurCrudAdmin::detailMessage',));
                }

                // repMessage
                if (0 === strpos($pathinfo, '/admin/message/rep') && preg_match('#^/admin/message/rep/(?P<mail>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'repMessage')), array (  '_controller' => 'AppBundle\\Controller\\ControleurCrudAdmin::repMessage',));
                }

            }

            if (0 === strpos($pathinfo, '/admin/creatNew')) {
                // formNew
                if ($pathinfo === '/admin/creatNew') {
                    return array (  '_controller' => 'AppBundle\\Controller\\ControleurCrudAdmin::CreateNew',  '_route' => 'formNew',);
                }

                // creatNews
                if ($pathinfo === '/admin/creatNew/validation') {
                    return array (  '_controller' => 'AppBundle\\Controller\\ControleurCrudAdmin::ValidCreateNew',  '_route' => 'creatNews',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/login')) {
            // login
            if ($pathinfo === '/login') {
                return array (  '_controller' => 'AppBundle\\Controller\\ControllerLogin::getLogin',  '_route' => 'login',);
            }

            // loginCheck
            if ($pathinfo === '/loginCheck') {
                return array (  '_controller' => 'AppBundle\\Controller\\ControllerLogin::check',  '_route' => 'loginCheck',);
            }

            // loginOut
            if ($pathinfo === '/loginOut') {
                return array (  '_controller' => 'AppBundle\\Controller\\ControllerLogin::logout',  '_route' => 'loginOut',);
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
