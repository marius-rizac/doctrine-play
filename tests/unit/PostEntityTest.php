<?php

namespace Test\Codeception;

use Blog\Entity\PostEntity;

class PostEntityTest extends \PHPUnit_Framework_TestCase
{
    // tests
    public function testPostTitle()
    {
        $p = new PostEntity();
        $p->setTitle('First post');

        self::assertSame('First post', $p->getTitle());
    }

    public function testPostBody()
    {
        $p = new PostEntity();
        $p->setBody('post body text');

        self::assertSame('post body text', $p->getBody());
    }

    public function testPublicationDate()
    {
        $date = new \DateTime('now');

        $p = new PostEntity();
        $p->setPublicationDate($date);

        self::assertSame(
            $date->format('Y-m-d G:i:s'),
            $p->getPublicationDate()->format('Y-m-d G:i:s')
        );
    }
}
