<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

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
