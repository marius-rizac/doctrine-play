<?php

namespace Test\Codeception;

use Blog\Entity\Post;

class PostEntityTest extends \PHPUnit_Framework_TestCase
{
    // tests
    public function testPostTitle()
    {
        $p = new Post();
        $p->setTitle('First post');

        self::assertSame('First post', $p->getTitle());
    }

    public function testPostBody()
    {
        $p = new Post();
        $p->setBody('post body text');

        self::assertSame('post body text', $p->getBody());
    }
}
