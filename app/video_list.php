<div class="video-list-view">
    <div class="video-list">
<?php 
    $q = $pdo->query("select * from plan_video order by ORDER_NUM")->fetchAll();
    foreach ($q as $row) {
?>
    <a class="video-list-item" href="#">
        <img src="img/cams/<?php print($row['ID']); ?>.png">
    </a>
<?php
    }
?>
    </div>
</div>

<script>
    var videoViewW = 0;
    var videoItemW = 0;
    var videoItemW_2 = 0;
    var videoTimeOutForScroll = false;
    var videoLastScroll = false;
    
    $('document').ready(() => {
        $('.video-list').on('scroll', (e) => {
            videoViewRecalc();
        });
       
        $(window).on('resize', (e) => {
            videoViewW = $('.video-list-view').width();
            videoItemW = $('.video-list-item').width();
            videoItemW_2 = videoItemW / 2;
            videoViewRecalc();
        }).trigger('resize');
        
        $('.video-list').on('touchend', () => {
            videoViewCheckAutoscroll();
        });
        
        $('.video-list').on('touchstart', () => {
            console.log('TOUCHSTART');
            clearTimeout(videoTimeOutForScroll);
        });
        
        $('.video-list-item').on('click', (e) => {
            e.preventDefault();
        });
    });
   
    function videoViewRecalc() {      
        let scrollX = $('.video-list').scrollLeft();
        let cx = (videoViewW - videoItemW) / 2;
        let ls = $('.video-list-item');
       
        if (videoViewW >= 992) {
            $(ls).css('opacity', 1);
        } else {
            for (let i = 0; i < ls.length; i++) {
                let itemX = $(ls[i]).offset().left - cx;
                let o = 1 - Math.abs(itemX / videoItemW / 1.25);
                if (o < 0) {
                    o = 0;
                }
                $(ls[i]).css('opacity', o);
            }
        }
    }
    
    function videoViewCentringItem() {
        let scrollX = $('.video-list').scrollLeft();
        let cx = (videoViewW - videoItemW) / 2;
        let ls = $('.video-list-item');
        var prevX = 0;
        var prevO = 0;
       
        if (videoViewW >= 992) {
            //
        } else {
            for (let i = 0; i < ls.length; i++) {
                let itemX = $(ls[i]).offset().left - cx;
                let o = 1 - Math.abs(itemX / videoItemW);
                if (o < 0) {
                    o = 0;
                }
                if (o > prevO) {
                    prevX = itemX + cx;
                    prevO = o;
                }
            }
            
            if (prevO > 0) {
                let s = scrollX + prevX - cx;
                $('.video-list').stop().animate({scrollLeft: s}, 100);
            }
        }
    }
    
    function videoViewCheckAutoscroll() {
        videoTimeOutForScroll = setTimeout(() => {
            let s = $('.video-list').scrollLeft();
            if (s == videoLastScroll) {
                videoViewCentringItem();
            } else {
                videoLastScroll = s;
                videoViewCheckAutoscroll();
            }
        }, 50);
    }
   
</script>