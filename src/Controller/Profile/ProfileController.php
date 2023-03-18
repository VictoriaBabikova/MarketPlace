<?php
namespace App\Controller\Profile;

use App\Form\ProfileChangeType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfileController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/profile", name="app_profile")
    */
    public function profilepage(
        Request $request,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $userPasswordHasher,
        SluggerInterface $slugger,
    ) {
        if (! isset($user)) {
            $user = $userRepository->findByPhone($request->getsession()->get('user_phone'));
        }
        $form = $this->createForm(ProfileChangeType::class, $user);
        $form->handleRequest($request);

        $message = '';

        if ($form->isSubmitted() && $form->isValid()) {
            $token = $request->get("token");
            if ($this->isCsrfTokenValid('upload', $token)) {
                if ($form->get('phone')->getData() && $form->get('email')->getData()) {
                    if ($user->getPhone() !== $form->get('phone')->getData()) {
                        $user
                            ->setPhone(htmlspecialchars(trim($form->get('phone')->getData())))
                        ;
                    }

                    if ($user->getEmail() !== $form->get('email')->getData()) {
                        $user
                            ->setEmail(htmlspecialchars(trim($form->get('email')->getData())))
                        ;
                    }

                    if ($user->getName() !== $form->get('name')->getData()) {
                        $user
                            ->setName($form->get('name')->getData())
                        ;
                    }

                    if (!empty($form->get('plainPassword')->getData()) && !empty($form->get('replyPassword')->getData())) {
                        if ($form->get('plainPassword')->getData() !== $form->get('replyPassword')->getData()) {
                            $message = 'Пароли не совпадают';
                        }
                        if ($form->get('plainPassword')->getData() === $form->get('replyPassword')->getData()) {
                            $user
                                ->setPassword(
                                    $userPasswordHasher->hashPassword(
                                        $user,
                                        $form->get('plainPassword')->getData()
                                    )
                                );
                        }
                    }
                    

                    if ($form->get('avatar')->getData()) {
                        /** @var UploadedFile|null $image */
                        $image = $form->get('avatar')->getData();
                        $filename = $slugger
                            ->slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME))
                            ->append('-'. uniqid())
                            ->append('.' . $image->guessExtension())
                            ->__toString()
                            ;
                        
                        $newFile =  $image->move($this->getParameter('uploads_dir'), $filename);

                        $user
                            ->setAvatar('uploads/avatars/'. $filename)
                        ;
                    }
                    $entityManager->flush();
                    $message = "Профиль успешно обнавлен";
                }
            }
        }
        return $this->render('profile/profile.html.twig', [
            'profileForm' => $form->createView(),
            'user' => $user,
            'message' => $message
        ]);
    }
    /**
     * @Route("/profile-avatar", name="app_profileAvatar")
    */
    public function profileAvatarpage()
    {
        return $this->render('profile/profileAvatar.html.twig');
    }
}
