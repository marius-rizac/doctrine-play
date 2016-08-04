<?php


namespace Blog\DataFixtures;

use Blog\Entity\PostEntity;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPostData implements FixtureInterface
{
    const NUMBER_OF_POSTS = 5;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i<=self::NUMBER_OF_POSTS; $i++) {
            $post = new PostEntity();
            $post->setTitle(sprintf('Blog post no. %d', $i));
            $post->setBody(<<<EOT
    Lorem Ipsum Dolor ----
EOT
    );
            $post->setPublicationDate(new \DateTime(sprintf('-%d days', self::NUMBER_OF_POSTS - $i)));

            $manager->persist($post);
        }

        $manager->flush();
    }
}
