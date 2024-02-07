<?php

namespace App\DataFixtures;

// Entité concerné
use App\Entity\Task;
use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Hachage de mes passwords
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 2; $i++) {
            $users = new User();
            $users->setUsername('Simon'.$i);
            $users->setEmail('simoncestmoi@hotmail.fr'.$i);
            $users->setPassword('Admintest'.$i);
            $users->setRoles(['ROLES_USER']);
            $manager->persist($users);
            $this->setTasks($users, $manager);
        }
        $manager->flush();
    }

    private function setTasks(User $user, ObjectManager $manager) {
        for ($i = 1; $i <= 2; $i++) {
            $tasks = new Task();
            $tasks->setUser($user);
            $tasks->setTitle('Tache '.$i);
            $tasks->setContent('Contenu de la tache '.$i);
            $tasks->setIsDone(0);
            $tasks->setSlug(urlencode($tasks->getTitle()).$i);
            // Object DatetimeInterface et valeur par defaut definit en tant que CURRENT_TIMESTAMP dans mon entité
            $tasks->setCreatedAt(new \DateTime);
            $manager->persist($tasks);
        }
    }
}
