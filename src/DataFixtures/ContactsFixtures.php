<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ContactsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $isFemale = (bool) mt_rand(0, 1); // True pour femme, False pour homme
            $type = $isFemale ? "women" : "men"; // Ajustement pour l'URL de l'avatar

            $contact = new Contact();
            $contact->setNom($faker->lastName())
                ->setPrenom($faker->firstName($isFemale ? 'female' : 'male'))
                ->setRue($faker->streetAddress())
                ->setCp($faker->postcode())
                ->setVille($faker->city())
                ->setMail($faker->email())
                ->setSexe($isFemale)  // Booléen directement utilisé ici
                ->setAvatar("https://randomuser.me/api/portraits/" . $type . "/" . $i . ".jpg");  // Correction de l'URL

            $manager->persist($contact);
        }

        $manager->flush();
    }
}
