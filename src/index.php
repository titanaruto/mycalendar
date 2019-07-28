<?php

include('views/includes/head.php'); ?>
</head>
<body>
<div class="wrapper" id="blog-item">
    <h1>blog</h1>
    <main id="main">
        <?php
        require 'BL/DataMapper.php';
        $DataMapper = new DataMapper();

        //        input validation
        $channelsID = filter_input(INPUT_GET, "channelsID");
        $tagsID = filter_input(INPUT_GET, "tagsID");

        if (isset($channelsID)) {
            $articleList = $DataMapper->getArticle("channelsID", $channelsID);
        } else if (isset($tagsID)) {
            $articleList = $DataMapper->getArticle("tagsID", $tagsID);
        } else {
            $articleList = $DataMapper->getAllArticle();
        }

        ?>
        <?php foreach ($articleList as $article): ?>

            <article class="article">
                <div class="image-block"><img src="<?= $article->image ?>" alt="image">
                </div>
                <div class="content-article">
                    <h2 class="title"><?= $article->title ?></h2>
                    <p><?= $article->description ?></p>
                    <span><?= date('d.m.Y', $article->publishDate); ?></span>
                    <buttonnclick="learnMore('#blog-item',<?= $article->ID ?> ); return false;">Learn More</button>
                </div>
            </article>
        <?php endforeach; ?>

    </main>
</div>

</body>
</html>
