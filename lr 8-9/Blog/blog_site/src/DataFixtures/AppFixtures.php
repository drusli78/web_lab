<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;


class AppFixtures extends Fixture
{
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setName("Andrey");
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'Andrey_krutoi'
        );
        $user->setApiToken(Uuid::v1()->toRfc4122());
        $user->setPassword($hashedPassword);
        $user->setPatronymic('Alexandrovich');
        $user->setEmail('Andrey_krutoi@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setSurname("Shatskih");
        $manager->persist($user);


        $blog = new Blog();
        $blog->setName("Это блог");
        $blog->setTopic("Создание блога");
        $blog->setAnnotation("Тут много блогов");
        $manager->persist($blog);
        $blog->setCreation(new \DateTime());
        for ($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post->setHeading('Заголовок № '. $i);
            $post->setAnnotation("Аннотация № ".$i);
            $post->setContent('Сделали задание № '.$i);
            $post->setBlog($blog);
            $post->setDate(new \DateTime());
            $post->setView(0);
            $manager->persist($post);
            $post->setPhoto('/img/blog-img/'.($i%7+1).'.jpg');
            if ($i%2 == 0){
                $post->setIspublication(false);
            }
            else
                $post->setIspublication(true);
        }
        $manager->flush();
    }
}
