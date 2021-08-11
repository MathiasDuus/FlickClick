
<div class="col-md">
    <div id="frontpage-bottom-header" class="row">
        <p> NEWS</p>
        <a href="news.php">See all</a>
    </div>

    <?php
    //------------------------------ NEWS --------------------------------

    include_once 'BLL/sort_news.php';

    $news = cut_news();
// loop to show at max 3 news
    for($i=0;$i<3 AND $i< count($news);$i++){
    ?>
    <div id="news" class="row">
        <p id="news-date"><?php echo $news[$i]["date"]; ?></p>

        <p id="news-title"><?php echo $news[$i]["title"]; ?></p>

        <p id="news-text"><?php echo $news[$i]["text_cut"]; ?></p>

        <a id="news-read_more" href="news.php?value=<?php echo $news[$i]["newsID"];?>">Read more</a>

    </div>




    <?php
    }
    ?>  
</div>


<div id="coming-soon" class="col-md">
    <div id="frontpage-bottom-header" class="row">
        <p> COMING SOON</p>
        <a href="filter.php?filter=coming_soon">See all</a>
    </div>

     <?php
     //-------------------------- COMING SOON ----------------------------
    include_once 'BLL/sort_movie.php';
    $coming_soon = coming_soon();
// loop to show at max 2 coming soon
    for($i=0;$i<2 AND $i< count($coming_soon);$i++){
    ?>
    <div class="row">
            <p id="coming-soon-date"><?php echo $coming_soon[$i]["release_date"]; ?></p>

            <p id="coming-soon-title"><?php echo $coming_soon[$i]["title"]; ?></p>
        <div class="row">
            <img id="coming-soon-poster" src="<?php echo $coming_soon[$i]["poster"]; ?>" alt="Movie poster">

            <div class="col-md">

                <p id="coming-soon-text"><?php echo $coming_soon[$i]["description_cut"]; ?></p>

                <a id="news-read_more" href="movie.php?movie=<?php echo $coming_soon[$i]["movieID"];?>">Read more</a>
            </div>
        </div>
    </div>




    <?php
    }
    ?>  



</div>