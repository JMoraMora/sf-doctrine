<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Metadata;
use App\Entity\Product;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        $product->setName('Keyboard');
        $product->setSummary('A mechanical keyboard with RGB backlighting.');

        $metadata = new Metadata();
        $metadata->setCode(rand(100, 200));
        $metadata->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec auctor, nisl eget ultricies aliquam, nunc nisl aliquet nunc, quis aliquam nisl nunc sit amet nisl. Donec auctor, nisl eget ultricies aliquam, nunc nisl aliquet nunc, quis aliquam nisl nunc sit amet nisl.');

        $manager->persist($metadata);

        $product->setMetadata($metadata);

        $manager->persist($product);

        # Tag
        $tag_1 = new Tag();
        $tag_1->setName('Keyboard');
        $manager->persist($tag_1);

        $tag_2 = new Tag();
        $tag_2->setName('Mechanical');
        $manager->persist($tag_2);

        $product->addTag($tag_1);
        $product->addTag($tag_2);

        # Comments
        $comment_1 = new Comment();
        $comment_1->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec auctor, nisl eget ultricies aliquam, nunc nisl aliquet nunc, quis aliquam nisl nunc sit amet nisl.');
        $manager->persist($comment_1);

        $comment_2 = new Comment();
        $comment_2->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec auctor, nisl eget ultricies aliquam, nunc nisl aliquet nunc, quis aliquam nisl nunc sit amet nisl.');
        $manager->persist($comment_2);

        $product->addComment($comment_1);
        $product->addComment($comment_2);


        $manager->flush();
    }
}
