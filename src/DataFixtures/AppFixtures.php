<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // TASKS
        for ($i = 0; $i <= 10; $i++) {
            $task = new Task();
            $task->setTitle('Tâche ' . $i)
                ->setDescription('Blablabla')
                ->setStatus('à faire');

            $manager->persist($task);
            
        }

        $manager->flush();
    }
}
