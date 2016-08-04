<?php
ob_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php

require_once __DIR__ . '/../src/bootstrap.php';

function getForm($title = '', $body = '')
{
    ob_start();
    ?>
    <form action="" method="post">
        <p><input type="text" name="title" placeholder="Post Title" value="<?php echo $title; ?>"></p>
        <p><textarea name="body" id="" cols="30" rows="10" placeholder="Post content"><?php echo $body; ?></textarea></p>
        <p><button>Save</button></p>
    </form>
    <?php
    $form = ob_get_clean();

    return $form;
}

if (empty($_GET['p']) || $_GET['p'] === '') {
    $posts = $entityManager
        ->getRepository(\Blog\Entity\PostEntity::class)
        ->findAll();

    echo '<a href="/?p=add-post">Add post</a>';

    foreach ($posts as $post) {
        ?>
        <h1><?php echo htmlspecialchars($post->getTitle()); ?></h1>
        <p>Published: <?php echo $post->getPublicationDate()->format('Y-m-d H:i:s'); ?></p>
        <p>
            <a href="/?p=edit-post&id=<?php echo $post->getId(); ?>">Edit</a>
            <a href="/?p=delete-post&id=<?php echo $post->getId(); ?>">Delete</a>
        </p>
        <?php
    }
} elseif ($_GET['p'] === 'add-post') {
    if (!empty($_POST['title']) && !empty($_POST['body'])) {
        $post = new \Blog\Entity\PostEntity();
        $post->setBody($_POST['body']);
        $post->setTitle($_POST['title']);
        $post->setPublicationDate(new \DateTime());

        $entityManager->persist($post);
        $entityManager->flush();

        ob_end_clean();
        header('Location: /?p=edit-post&id=' . $post->getId());
        die;
    }
    echo getForm();
} elseif ($_GET['p'] === 'edit-post') {
    $idPost = (int) $_GET['id'];
    $post = $entityManager->getRepository(\Blog\Entity\PostEntity::class)
        ->find($idPost)
    ;
    if (!empty($_POST['title']) && !empty($_POST['body'])) {
        $post->setBody($_POST['body']);
        $post->setTitle($_POST['title']);
        $post->setPublicationDate(new \DateTime());

        $entityManager->persist($post);
        $entityManager->flush();

        ob_end_clean();
        header('Location: /?p=edit-post&id=' . $post->getId());
        die;
    }
    echo getForm($post->getTitle(), $post->getBody());
} elseif ($_GET['p'] === 'delete-post') {
    $idPost = (int) $_GET['id'];
    $post = $entityManager->getRepository(\Blog\Entity\PostEntity::class)
        ->find($idPost)
    ;

    $entityManager->remove($post);
    $entityManager->flush();

    ob_end_clean();
    header('Location: /');
    die;
} else {
    ?>
    <h1>Page not found</h1>
    <?php
}
if (!empty($_GET['p'])) {
    echo '<p><a href="/">Homepage</a></p>';
}
?>
</body>
</html>
