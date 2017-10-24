<?php
/**
 * Created by PhpStorm.
 * User: deve_
 * Date: 14/09/2017
 * Time: 10:41
 */

namespace AppBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;
use AppBundle\Entity\Client;
use AppBundle\Entity\Package;

class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $objects = Fixtures::load(
            __DIR__.'/fixtures.yml',
            $manager,
            [
                'providers' => [$this]
            ]
        );
      /* $client = new Client();
       $client->setAddressLine1('sds');
       $client->setAddressLine2('sdss');
       $client->setAddressLine3('sdsss');
       $client->setBusinessNo('123');
       $client->setComment('sdsd');
       $client->setCompanyName('ABC');
       $client->setCountry('mru');
       $client->setIsPublished(1);
       $client->setDescription('sdsqd');

       $package = new Package();
       $package->setDateupdated(new \DateTime('now'));
       $package->setDescription('sage');
       $package->setPackageName('pk1');

       $client->setPackage($package);
       $manager->persist($client);
       $manager->persist($package);
       $manager->flush();*/

    }

    public function packages()
    {
        $genera = [
            'sage',
            'pastel',
            'microsoft',
            'linux',
            'apple',
            'Amphiprion',

        ];
        $key = array_rand($genera);

        return $genera[$key];
    }
}