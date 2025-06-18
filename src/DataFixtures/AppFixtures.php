<?php

namespace App\DataFixtures;

use App\Entity\Tasks;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // TASKS
        for ($i = 0; $i <= 10; $i++) {
            $task = new Tasks();
            $task->setTitle('Tâche ' . $i)
                ->setDescription('Blablabla')
                ->setStatus('à faire');

            $manager->persist($task);
            
        }

        $manager->flush();
    }
}
