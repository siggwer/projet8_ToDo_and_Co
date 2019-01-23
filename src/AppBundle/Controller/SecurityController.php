<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

/**
 * Class SecurityController
 * @package AppBundle\Controller
 */
class SecurityController
{

    /**
     * @Route(path="/login", name="login", methods={"GET"})
     * @param AuthenticationUtils $authenticationUtils
     * @param Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function login(AuthenticationUtils $authenticationUtils, Environment $twig): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return new Response($twig->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]), Response::HTTP_OK);
    }

}
