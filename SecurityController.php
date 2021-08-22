<?php

namespace App\Controller;

use App\Entity\User;

use App\Service\UserService;
use App\Service\EmailService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Form\RegistrationFormType;
// use App\Helper\EmailHelper;
// use App\Helper\TokenHelper;
use App\Security\LoginFormAuthenticator;
use App\Service\TokenService;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class SecurityController extends BaseSiteController
{



    /**
     * @Route("/login", name="app_login", methods={"POST"})
     */
    public function login(
        Request $request,
    ): Response {

        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse([
                'status' => '',
                'code' => 400,
                'message' => "Podane hasło lub email są niepoprawne",
                'user' => $this->getUser() ? $this->getUser()->getId() : null,
                'content' => $request->getMethod()
            ]);
        }


        return new JsonResponse([
            'status' => 'OK',
            'code' => 200,
            'user' => $user->getId()
        ]);
  
    }
}
